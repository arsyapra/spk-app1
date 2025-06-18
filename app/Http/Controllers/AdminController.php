<?php

namespace App\Http\Controllers;
use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use App\Models\Alternatif;
use App\Models\Siswa;
use App\Models\Nilai_akhir;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
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


    return view('admin.index', compact('jumlah_Kriteria', 'jumlah_Sub_kriteria','jumlahAlternatif','jumlahSiswa','labels','skors'));
    }
}

