<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Petakerawanan;
use App\Models\JenisKerawanan;
use App\Models\JenisPetaKerawanan;
use Illuminate\Support\Facades\Auth;

class PetakerawananController extends Controller
{
    public function petakerawanan(){
        $data = Petakerawanan::all();
        return view('admin.petakerawanan', compact('data'));
    }

    public function tambahpelanggaran(){
        return view('admin.tambahpetakerawanan');
    }

    public function insertpetakerawanann(Request $request){
        $data = Petakerawanan::create($request->all());
        return redirect('/petakerawanan');
    }
    public function deletepetakerawanann($id){
        $data = Petakerawanan::find($id);
        $data->delete();
        return redirect()->route('petakerawanan')->with('sucess', 'data berhasil diapus');
    }

    public function datapetakerawanann(){
        $user = User::with('guru')->find(Auth::id()); // Mengambil data user yang sedang login dan eager load relasi guru
        $guru = $user->guru->first(); // Mengambil guru pertama yang terkait dengan user
        $id = $guru->id ?? null; // Mengambil ID guru jika guru tersedia, jika tidak, nilainya menjadi null
        $kelas = $id ? Kelas::find($id) : null; // Mendapatkan objek kelas berdasarkan ID guru jika ID guru tersedia, jika tidak, nilainya menjadi null
        $siswa = $kelas ? Siswa::where('kelas_id', $kelas->id)->get() : null; // Mengambil siswa-siswa yang memiliki kelas dengan ID yang sama jika kelas tersedia, jika tidak, nilainya menjadi null
        
        

        return view('guru.petakerawanan', compact('user','siswa'));
    }

    public function tambahpetakerawanann(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login

        $siswa = Siswa::all();
        $jenispetakerawanan = PetaKerawanan::all();

        // dd($jenispetakerawanan);
        return view('guru.tambahpeta', compact('siswa', 'jenispetakerawanan', 'user',));
    }

    public function storekerawanann(Request $request){
        $data = new JenisPetaKerawanan();
        $data->siswa_id = $request->siswa_id;
        $data->petakerawanan_id = $request->petakerawanan_id;
        // dd($data);
        $data->save();
        return redirect('/petakerawananguru');

        // dd($jenispetakerawanan);
    }

    public function updatepeta(Request $request){
        // $siswa = Siswa::create($request->all());
        $peta = PetaKerawanan::create($request->all());
        return redirect('/petakerawanann', compact('siswa', 'peta'));

        // $siswa = Siswa::find($id);
        // $peta = PetaKerawanan::find($id);

        // $siswa->namasiswa = $request->input('namasiswa');
        // $peta->jenispetakerawanan = $request->input('jenispetakerawanan');
    }

    public function jeniskerawanann($id){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        // $kerawanan = JenisPetaKerawanan::with('petakerawanan')->find($id);
        // dd($kerawanan);
        // return view('guru.isijeniskerawanan', compact('kerawanan', 'user'));

        $jenisKerawanan = JenisPetaKerawanan::with('petakerawanan')->whereHas('petakerawanan', function ($query) use ($id) {
            $query->where('siswa_id', $id);
        })->get();
        
    
        return view('guru.isijeniskerawanan', compact('jenisKerawanan', 'user'));
    }

    public function deletekerawanann($id){
            $data = JenisPetaKerawanan::find($id);
            $data->delete();
            return redirect()->back()->with('sucess', 'data berhasil diapus');
    }
}
