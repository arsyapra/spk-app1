<?php

namespace App\Exports;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromCollection;

class PenilaianExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view(): View
    {
        $alternatif = Alternatif::with('penilaian.sub_kriteria')->get();
        $kriteria = Kriteria::all();

        return view('penilaian.exports', compact('alternatif', 'kriteria'));
    }
}
