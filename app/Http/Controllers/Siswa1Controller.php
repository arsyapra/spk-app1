<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Sub_kriteria;
use Barryvdh\DomPDF\Facade\Pdf;      // import facade
use Illuminate\Support\Str;           // import Str untuk slug
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai_akhir;


class Siswa1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $jumlah_Kriteria = Kriteria::count();
    $jumlah_Sub_kriteria = Sub_kriteria::count();
    $jumlahAlternatif = Alternatif::count();
    $jumlahSiswa = Siswa::count(); // jika ada
    // Ambil 10 teratas, atau semua
    $ranking = Nilai_akhir::with('alternatif')
        ->orderByDesc('nilai_akhir')
        ->limit(10)
        ->get();

    $labels = $ranking->pluck('alternatif.nama_alternatif');
    $skors  = $ranking->pluck('nilai_akhir');


    return view('siswa.dashboard', compact('jumlah_Kriteria', 'jumlah_Sub_kriteria','jumlahAlternatif','jumlahSiswa','labels','skors'));
    }

    public function listAlternatif(Request $request)
    {
        $keyword = $request->input('search');

        $query = Nilai_akhir::with('alternatif')->orderByDesc('nilai_akhir');

        if ($keyword) {
            $query->whereHas('alternatif', fn($q) =>
                $q->where('nama_alternatif', 'like', "%{$keyword}%")
            );
        }

        $nilaiAkhirAlternatif = $query->get();

        return view('siswa.listAlternatif', compact('nilaiAkhirAlternatif', 'keyword'));
    }


    public function showKriteria(Request $request)
    {
        $keyword = $request->input('search');

        $query = Kriteria::with('sub_kriteria');

        if ($keyword) {
            // filter nama kriteria atau nama sub-kriteria
            $query->where('nama_kriteria', 'like', "%{$keyword}%")
                ->orWhereHas('sub_kriteria', fn($q) =>
                    $q->where('nama_sub_kriteria', 'like', "%{$keyword}%")
                );
        }

        $kriterias = $query->get();

        return view('siswa.showkriteria', compact('kriterias', 'keyword'));
    }

        public function lihatSiswa()
    {
        // Ambil semua siswa beserta penilaian sub-kriteria
        $siswa = Siswa::with('penilaiansiswa.sub_kriteria')->get();

        // Ambil daftar kriteria untuk header kolom
        $kriterias = Kriteria::all();

        return view('siswa.lihatSiswa', compact('siswa', 'kriterias'));
    }

    /**
     * Untuk setiap siswa: panggil SMARTController::rekomendasiSMART
     * dan langsung return view hasilnya.
     */
    public function lihatHasil($siswa_id)
    {
        // Bisa juga inject SMARTController via konstruktor, ini cara cepat:
        $smart = app(SMARTController::class);
        return 
        $smart->rekomendasiSMART($siswa_id);
    }

  // alias dari barryvdh/laravel-dompdf


public function exportPdf($siswa_id)
{
    // 1. Ambil data rekomendasi lewat SMARTController
    $data = app(\App\Http\Controllers\SMARTController::class)
             ->rekomendasiSMART($siswa_id);

    // 2. Render view khusus PDF dengan data tsb.
    $pdf = Pdf::loadView('pdf.rekomendasi', [
        'siswa' => $data['siswa'],
        'hasil' => $data['hasil'],
    ]);

    // 3. Generate nama file dan download
    $filename = 'rekomendasi-'. Str::slug($data['siswa']->nama_siswa) .'.pdf';
    return $pdf->download($filename);
}



    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
