<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Sub_kriteria;
use App\Exports\PenilaianExport;
use Maatwebsite\Excel\Facades\Excel;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Ambil semua alternatif dengan penilaiannya dan subkriteria
    $alternatif = Alternatif::with(['penilaian.sub_kriteria'])->get();

    // Ambil semua kriteria
    $kriteria = Kriteria::all();

    return view('penilaian.index', compact('alternatif', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            // Ambil semua alternatif
    $alternatif = Alternatif::all();

    // Ambil semua kriteria beserta sub-kriteria terkait
    $kriteria = Kriteria::with('sub_kriteria')->get();

    return view('penilaian.tambah', compact('alternatif', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $alternatif_id = $request->input('alternatif_id');
    $penilaian_data = $request->input('penilaian'); // [kriteria_id => sub_kriteria_id]
    
    foreach ($penilaian_data as $kriteria_id => $sub_kriteria_id) {
        $subKriteria = Sub_kriteria::find($sub_kriteria_id);
        $nilai = $subKriteria ? $subKriteria->bobot_sub_kriteria : 0;

        Penilaian::updateOrCreate(
            [
                'alternatif_id' => $alternatif_id,
                'kriteria_id' => $kriteria_id
            ],
            [
                'sub_kriteria_id' => $sub_kriteria_id,
                'nilai' => $nilai // <-- simpan nilai dari bobot_sub_kriteria!
            ]
        );
    }

    return redirect()->route('penilaian.index')->with('success', 'Penilaian disimpan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($alternatif_id)
    {
    $alternatif = Alternatif::findOrFail($alternatif_id);
    $kriteria = Kriteria::with('sub_kriteria')->get();

    // Ambil penilaian untuk alternatif ini
    $penilaian = Penilaian::where('alternatif_id', $alternatif_id)->get()->keyBy('kriteria_id');

    return view('penilaian.edit', compact('alternatif', 'kriteria', 'penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $alternatif_id)
{
    foreach ($request->penilaian as $kriteria_id => $sub_kriteria_id) {
        $subKriteria = Sub_kriteria::find($sub_kriteria_id);
        $nilai = $subKriteria ? $subKriteria->bobot_sub_kriteria : 0;

        Penilaian::updateOrCreate(
            [
                'alternatif_id' => $alternatif_id,
                'kriteria_id' => $kriteria_id
            ],
            [
                'sub_kriteria_id' => $sub_kriteria_id,
                'nilai' => $nilai // <-- simpan nilai dari bobot_sub_kriteria!
            ]
        );
    }

    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alternatif_id)
    {
    Penilaian::where('alternatif_id', $alternatif_id)->delete();
    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus!');
    }

    
    public function export()
    {
        return Excel::download(new PenilaianExport, 'penilaian.xlsx');
    }


}
