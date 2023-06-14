<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\Konseling_bk;
use Illuminate\Http\Request;
use App\Models\Petakerawanan;
use App\Models\JenisPetaKerawanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{


    public function datawalikelas(){
        $data = WaliKelas::with('user')->paginate();
        return view('walas.indexwalas',compact('data'));
    }

    public function tambahwalikelas(){
        return view('walas.tambahwalikelas');
    }

    public function insertdatawalikelas(Request $request){
        // dd($request->all());
        $data = [
            'name' => $request->input('namagurukelas'),
            'email' => $request->input('email'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'wali_kelas'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);
        
        // Membuat objek walikelas dengan ID baru
        $walikelas = new WaliKelas();
        $walikelas->user_id = $dataid;
        $walikelas->namagurukelas = $request->input('namagurukelas');
        $walikelas->foto = '';
        
        // Mengunggah foto walikelas jika tersedia
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotowalikelas/', $request->file('foto')->getClientOriginalName());
            $walikelas->foto = $request->file('foto')->getClientOriginalName();
        }
        
        $walikelas->jeniskelamin = $request->input('jeniskelamin');
        $walikelas->tempatlahir = $request->input('tempatlahir');
        $walikelas->tanggallahir = $request->input('tanggallahir');
        $walikelas->save();
        
        return redirect()->route('datawalikelas');
        
    }

    public function tampilkadatawalikelas($id){
        $data = WaliKelas::with('user')->find($id);
        // dd($data);
        return view('walas.editdatawalikelas', compact('data'));
    }

    public function updateDatawalikelas(Request $request, $id){
        $data = WaliKelas::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data walikelas
        $data->namagurukelas = $request->input('namagurukelas');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotowalikelas/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotosiswa/', $fotoName);
    
            // Update foto walikelas
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namagurukelas');
            $user->email = $request->input('email');
            $user->save();
        }
    
        return redirect()->route('datawalikelas');
    }

    public function deletedatawalikelas($id){
        $walikelas = WaliKelas::find($id);
    
        // Menghapus foto jika ada
        if ($walikelas->foto) {
            $filePath = public_path('fotowalikelas/' . $walikelas->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        // Menghapus data di tabel User
        $user = User::find($walikelas->user_id);
        if ($user) {
            $user->delete();
        }
    
        // Menghapus data di tabel walikelas
        $walikelas->delete();
    
        return redirect()->route('datawalikelas');
    }
    ///////////////////////////////////////wali kelas end/////////////////////////////////////////

    
    ////////////////////////////////profil walikelas start////////////////////////////////
    public function profilwalas(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('walikelas'); // Muat relasi 'siswa' dari pengguna
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        $kelas = Kelas::where('walikelas_id', $id)->get();
        return view('walasview.profilwalas', compact('user', 'kelas'));
    }
    
    public function updateprofilwalikelas(Request $request, $id){
        $data = WaliKelas::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data guru
        $data->namagurukelas = $request->input('namagurukelas');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotowalikelas/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotowalikelas/', $fotoName);
    
            // Update foto guru
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namagurukelas');
            $user->email = $request->input('email');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }  
        return redirect()->route('profilwalas');
    }  
    ////////////////////////////////profil walikelas end//////////////////////////////////

    ////////////////////////////////jadwal panggilan start////////////////////////////////
    public function jadwalkonseling(){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('walas_id', $id)
        ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])//Hanya memanggil data yg statusnya berisi value 'MENUNGGU..', 'DITERIMA', 'DIUNDUR'
        ->latest('created_at')
        ->get();


        return view('walasview.jadwalkonseling', compact('jadwalbk','user'));
    }

    public function imputhasilbelajar(Request $request, $id){
        // Proses penyimpanan data jadwal yang di selesaikan
        $jadwal = Konseling_bk::find($id);
        $jadwal->hasil_konseling = $request->hasil_konseling;
        $jadwal->status = 'SELESAI';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back();
    }
    ////////////////////////////////jadwal panggilan end//////////////////////////////////

    ////////////////////////////////////archives start////////////////////////////////////
    public function hasilkonseling(){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('walas_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('walasview.hasilkonseling', compact('jadwalbk','user'));
    }
    ////////////////////////////////////archives end//////////////////////////////////////

    public function datakerawananwalas(){

        $user = User::with('walikelas')->find(Auth::id()); // Mengambil data user yang sedang login dan eager load relasi walikelas
        $walikelas = $user->walikelas->first(); // Mengambil walikelas pertama yang terkait dengan user
        
        $id = $walikelas->id ?? null; // Mengambil ID walikelas jika walikelas tersedia, jika tidak, nilainya menjadi null
        
        $kelas = $id ? Kelas::find($id) : null; // Mendapatkan objek kelas berdasarkan ID walikelas jika ID walikelas tersedia, jika tidak, nilainya menjadi null
        $jenispetakerawanan = Petakerawanan::all();
        $siswa = $kelas ? Siswa::where('kelas_id', $kelas->id)->get() : null; // Mengambil siswa-siswa yang memiliki kelas dengan ID yang sama jika kelas tersedia, jika tidak, nilainya menjadi null
    
        return view('walas.petakerawanan', compact('user','siswa'));
       }
    
       public function tambahpetakerawanan(){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        $peta = Petakerawanan::all();
        $siswa = Siswa::all();
        $jenispetakerawanan = Petakerawanan::all();
    
        // dd($jenispetakerawanan);
        return view('walas.tambahpeta', compact('siswa', 'jenispetakerawanan', 'user',));
    }
    
    public function storekerawanan(Request $request){
        $data = new JenisPetaKerawanan();
        $data->siswa_id = $request->siswa_id;
        $data->petakerawanan_id = $request->petakerawanan_id;
        // dd($data);
        $data->save();
        return redirect('/petakerawanan');
    
        // dd($jenispetakerawanan);
    }
    
    public function updatepeta(Request $request){
        // $siswa = Siswa::create($request->all());
        $peta = Petakerawanan::create($request->all());
        return redirect('/petakerawanan', compact('siswa', 'peta'));
    
        // $siswa = Siswa::find($id);
        // $peta = PetaKerawanan::find($id);
    
        // $siswa->namasiswa = $request->input('namasiswa');
        // $peta->jenispetakerawanan = $request->input('jenispetakerawanan');
    }
    
    public function jeniskerawanan($id){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        // $kerawanan = JenisPetaKerawanan::with('petakerawanan')->find($id);
        // dd($kerawanan);
        // return view('guru.isijeniskerawanan', compact('kerawanan', 'user'));
    
        $jenisKerawanan = JenisPetaKerawanan::with('petakerawanan')->whereHas('petakerawanan', function ($query) use ($id) {
            $query->where('siswa_id', $id);
        })->get();
        
    
        return view('walas.isijeniskerawanan', compact('jenisKerawanan', 'user'));
    }
    
    public function deletekerawanan($id){
            $data = JenisPetaKerawanan::find($id);
            $data->delete();
            return redirect()->back()->with('sucess', 'data berhasil diapus');
    }
   
}
