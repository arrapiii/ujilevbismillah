<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Layanan_bk;
use App\Models\Konseling_bk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
     // view admin
     public function datasiswa(){
        $data = Siswa::with('kelas')->paginate();
        return view('siswa.indexsiswa', compact('data'));
    }

    public function tambahsiswa(){
        $data = Kelas::all();
        return view('siswa.tambahsiswa',compact('data'));
    }

    public function insertdatasiswa(Request $request){
        $data = [
            'name' => $request->input('namasiswa'),
            'email' => $request->input('email'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'siswa'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);

        $siswa = new Siswa();
        $siswa->user_id = $dataid;
        $siswa->namasiswa = $request->input('namasiswa');
        $siswa->foto = '';

        if($request->hasFile('foto')){
            $request->file('foto')->move('fotosiswa/', $request->file('foto')->getClientOriginalName());
            $siswa->foto = $request->file('foto')->getClientOriginalName();
        }

        $siswa->jeniskelamin = $request->input('jeniskelamin');
        $siswa->tempatlahir = $request->input('tempatlahir');
        $siswa->tanggallahir = $request->input('tanggallahir');
        $siswa->kelas_id = $request->input('kelas_id');
        $siswa->save();
        
        return redirect()->route('datasiswa');
    }


    public function deletedatasiswa($id){
        $data = Siswa::find($id);
    
        if ($data->foto) {
            $filePath = public_path('fotosiswa/' . $data->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        $user = User::find($data->user_id);
        if ($user) {
            $user->delete();
        }
    
        $data->delete();
    
        return redirect()->route('datasiswa');
    }
    

    public function tampilkandatasiswa($id){
        $data = Siswa::with('user')->find($id);
        $datakelas = kelas::all();
        // dd($data);
        return view('siswa.editdatasiswa', compact('data','datakelas'));
    }
    
    public function updatedatasiswa(Request $request, $id){
        $data = Siswa::find($id);
        $previousFoto = $data->foto;
        $data->namasiswa = $request->input('namasiswa');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->kelas_id = $request->input('kelas_id');
        $data->save();

        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotosiswa/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotosiswa/', $fotoName);
            $data->foto = $fotoName;
            $data->save();
        }

        $user = $data->user; 
        if ($user) {
            $user->name = $request->input('namasiswa');
            $user->email = $request->input('email');
            $user->save();
        }

        return redirect()->route('datasiswa');
    }

    // end view admin


    // view siswa
    public function profilsiswa(){
        $user = User::find(Auth::id());
        // dd($user);
        $user->load('siswa');
        return view('siswaview.profilsiswa', compact('user'));
    }

    public function updateprofilsiswa(Request $request, $id){
        $data = Siswa::find($id);
        $previousFoto = $data->foto; 

        $data->namasiswa = $request->input('namasiswa');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotosiswa/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotosiswa/', $fotoName);
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; 
        if ($user) {
            $user->name = $request->input('namasiswa');
            $user->email = $request->input('email');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }
    
        return redirect()->route('profilsiswa');
    }



    public function jadwal()
    {
        $user = User::with('siswa')->find(Auth::id());
        $namasiswa = $user->siswa->id;
        // Mendapatkan guru yang mengajar siswa yang sedang login
        $guru = $user->siswa->kelas->guru;
        $layanan = Layanan_bk::all();
        // Mendapatkan daftar siswa yang diajar oleh guru yang sama dengan siswa yang sedang login
        $siswa = Siswa::whereHas('kelas', function ($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();
    
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
            ->where('siswa_id', $user->siswa->id)
            ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
            ->latest('created_at')
            ->get();
    
        return view('siswaview.jadwal', compact('jadwalbk', 'namasiswa', 'layanan', 'user', 'siswa'));
    }
    
    

    public function siswatambahJadwal(Request $request)
    {
        if ($request->has('manysiswa')) {
            $siswa_ids = (array) $request->input('manysiswa');
        } else {
            $siswa_ids = Siswa::where('user_id', Auth::id())->pluck('id')->toArray();
        }

        foreach ($siswa_ids as $siswa_id) {
            $siswa = Siswa::with('kelas.guru', 'kelas.walikelas')->find($siswa_id);
            $guru_id = $siswa->kelas->guru->id;
            $walas_id = $siswa->kelas->walikelas->id;
    
            $input = $request->only('layanan_id', 'tanggal', 'waktu', 'tempat');
            $waktu = $input['tanggal'] . ' ' . $input['waktu'];
    
            $jadwalbk = new Konseling_bk();
            $jadwalbk->siswa_id = $siswa_id;
            $jadwalbk->layanan_id = $input['layanan_id'];
            $jadwalbk->guru_id = $guru_id;
            $jadwalbk->walas_id = $walas_id;
            $jadwalbk->tempat = $input['tempat'];
            $jadwalbk->waktu = $waktu;
            $jadwalbk->status = 'MENUNGGU..';
            $jadwalbk->save();
        }
    
        return redirect()->route('jadwal')->with('success', 'Data jadwal berhasil ditambahkan.');
    }
    
    

    public function histori(){    
        $user = User::with('siswa')->find(Auth::id());
        $id = $user->siswa->id; 
        // $kelas = Kelas::where('guru_id', $id)->get(); 
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('siswa_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('siswaview.histori', compact('jadwalbk','user'));
    }
    // end view siswa
}
