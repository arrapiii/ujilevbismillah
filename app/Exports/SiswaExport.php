<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromView
{
    use Exportable;

    public function view(): View{
        $data = Siswa::with('user')->get();
        return view('export.indexsiswa', compact('data'));
    }
}