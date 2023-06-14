<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Exports\GuruExport;
use App\Exports\KelasExport;
use App\Exports\SiswaExport;
use App\Exports\WalasExport;
use Illuminate\Http\Request;
use App\Models\Petakerawanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function admin(){
        return view('admin.index');
    }

    public function kelas(){
        $data = Kelas::with('guru','walikelas')->paginate();
        return view('admin.kelas', compact('data'));
    }

    public function tambahkelas(){
        $dataguru = Guru::all();
        $datawalikelas = WaliKelas::all();
        return view('admin.tambahkelas', compact('dataguru','datawalikelas'));
    }

    public function insertdatakelas(Request $request){
        Kelas::create($request->all());
        return redirect()->route('kelas');
    }

    public function deletedatakelas($id){
        $data = Kelas::find($id);        
        $data->delete();
        
        return redirect()->route('kelas');
    }

    public function indexpetakerawanan(){
        $data = Petakerawanan::all();
        return view('admin.indexpetakerawanan', compact('data'));
    }

    public function tambahpelanggaran(){
        return view('admin.tambahpetakerawanan');
    }

    public function insertpetakerawanan(Request $request){
        $data = Petakerawanan::create($request->all());
        return redirect('/indexpetakerawanan');
    }
    public function deletepetakerawanan($id){
        $data = Petakerawanan::find($id);
        $data->delete();
        return redirect()->route('indexpetakerawanan')->with('sucess', 'data berhasil diapus');
    }

    public function exportToExcel(){
        return Excel::download(new SiswaExport, 'datasiswa.xlsx');
    }

}
