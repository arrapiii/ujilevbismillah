<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

class GuruController extends Controller
{
    
    public function indexguru(){
        $data = Guru::with('user')->paginate();
        return view('guru.indexguru', compact('data'));
    }
    
    public function tambahdataguru(){
        return view('guru.tambahakunguru');
    }

    public function insertdataguru(Request $request){
        $data = [
            'name' => $request->input('namaguru'),
            'email' => $request->input('email'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'guru'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);
        
      
        $guru = new Guru();
        $guru->user_id = $dataid;
        $guru->namaguru = $request->input('namaguru');
        $guru->foto = '';
        
       
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotoguru/', $request->file('foto')->getClientOriginalName());
            $guru->foto = $request->file('foto')->getClientOriginalName();
        }
        
        $guru->jeniskelamin = $request->input('jeniskelamin');
        $guru->tempatlahir = $request->input('tempatlahir');
        $guru->tanggallahir = $request->input('tanggallahir');
        $guru->save();
        
        return redirect()->route('indexguru');
        
    }

    public function tampilkandataguru($id){
        $data = Guru::with('user')->find($id);
        // dd($data);
        return view('guru.editakunguru', compact('data'));
    }

    public function updateDataGuru(Request $request, $id)
    {
        $data = Guru::find($id);
        $previousFoto = $data->foto;
    
        $data->namaguru = $request->input('namaguru');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotoguru/' . $previousFoto);
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
            $user->name = $request->input('namaguru');
            $user->email = $request->input('email');
            $user->save();
        }
    
        return redirect()->route('indexguru');
    }
    

    public function deletedataguru($id)
    {
        $guru = Guru::find($id);
        if ($guru->foto) {
            $filePath = public_path('fotoguru/' . $guru->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        $user = User::find($guru->user_id);
        if ($user) {
            $user->delete();
        }
        $guru->delete();
    
        return redirect()->route('indexguru');
    }

    
    public function guru(){
        $user = User::find(Auth::id()); 
        $user->load('guru'); 
        return view('guruview.profilGuru', compact('user'));
    }

    public function updateprofilguru(Request $request, $id){
        $data = Guru::find($id);
        $previousFoto = $data->foto; 
        // Update guru
        $data->namaguru = $request->input('namaguru');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotoguru/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotoguru/', $fotoName);
    
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // get asosiatif dari table user
        if ($user) {
            $user->name = $request->input('namaguru');
            $user->email = $request->input('email');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }
    
        return redirect()->route('guru');
    }

    public function akunSiswa(){
        $user = User::with('guru')->find(Auth::id()); 
        $id = $user->guru->id;
        $kelas = Kelas::where('guru_id', $id)->get(); 
        
        return view('guruview.akunSiswa', compact('kelas','user'));
    }

    public function menampikanmurid($kelasId){
        $user = User::find(Auth::id());
        $user->load('guru');

        $kelasguru = Kelas::find($kelasId); //membawa data kelas sesuai id
        $siswa = Siswa::where('kelas_id', $kelasId)->get();
        return view('guruview.siswa', compact('siswa','kelasguru','user'));
    }
   
    public function buatJadwal(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang ada di kelas
        $siswa = Siswa::whereIn('kelas_id', $kelas->pluck('id'))->get(); // Mengambil siswa yang diajar oleh guru
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
        ->where('guru_id', $id)
        ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
        ->latest('created_at')
        ->get();
        //memnaggil jadwal konseling beserta relasinya
        $layanan = Layanan_bk::whereIn('id', [1, 2, 4])->get();

        return view('guruview.buatJadwal', compact('kelas','layanan', 'jadwalbk','user','siswa'));
    }

    public function getSiswaByKelas(Request $request){
        $kelasId = $request->input('kelasId');
        $siswaList = Siswa::where('kelas_id', $kelasId)->get();
        return response()->json($siswaList);
    }

    public function tambahjadwal(Request $request)
    {
        // Menentukan siswa_id yang akan digunakan
        if ($request->has('manysiswa_id')) {
            $siswa_ids = (array) $request->input('manysiswa_id');
        } else {
            $siswa_ids = [$request->input('siswa_id')];
        }
        foreach ($siswa_ids as $siswa_id) {
            // Mendapatkan guru_id dan walas_id dari kelas terkait
            $siswa = Siswa::with('kelas')->find($siswa_id);
            $guru_id = $siswa->kelas->guru->id;
            $walas_id = $siswa->kelas->walikelas->id;
            // Menggabungkan tanggal dan waktu menjadi satu field datetime
            $tanggalWaktu = $request->tanggal . ' ' . $request->waktu;
        
            $jadwal = new Konseling_bk();
            $jadwal->guru_id = $guru_id;
            $jadwal->walas_id = $walas_id;
            $jadwal->siswa_id = $siswa_id;
            $jadwal->layanan_id = $request->layanan_id;
            $jadwal->waktu = $tanggalWaktu;
            $jadwal->tempat = $request->tempat;
            $jadwal->status = "DITERIMA";
            $jadwal->save();
        }
    
        return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan.');
    }    
    

    public function terimajadwal(Request $request, $id){
        $jadwal = Konseling_bk::find($id);
        
        $nilaiBaru = $request->input('tempat');
        $nilaiLama = $jadwal->tempat;
        
        if ($nilaiBaru !== $nilaiLama) {
            // Nilai baru berbeda dengan nilai lama, tambahkan "(DI GANTI)"
            $hasil = $nilaiBaru . ' (Di ubah oleh guru)';
        } else {
            // Nilai baru sama dengan nilai lama, tidak perlu menambahkan "(DI GANTI)"
            $hasil = $nilaiBaru;
        }
        
        $jadwal->tempat = $hasil;
        $jadwal->status = 'DITERIMA';
        $jadwal->save();
        
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
        
        
    }
    

    public function mundurkanJadwal(Request $request, $id){
    
        // Menggabungkan tanggal dan jam menjadi tipe data datetime
        $waktu = Carbon::parse($request->tanggal . ' ' . $request->jam);
    
        // Proses penyimpanan data jadwal yang diundur
        $jadwal = Konseling_bk::find($id);
        $jadwal->waktu = $waktu;
        $jadwal->status = 'DIUNDUR';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
    }


    public function selesaikanjadwal(Request $request, $id){
        // Proses penyimpanan data jadwal yang di selesaikan
        $jadwal = Konseling_bk::find($id);
        $jadwal->hasil_konseling = $request->hasil_konseling;
        $jadwal->status = 'SELESAI';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
    }
    ////////////////////////////////profil kelas siswa end//////////////////////////////////


    ////////////////////////////////History Start////////////////////////////////
    public function history(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('guru_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('guruview.history', compact('kelas', 'jadwalbk','user'));
    }
    ////////////////////////////////History End//////////////////////////////////

}
