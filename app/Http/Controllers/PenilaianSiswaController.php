<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Siswa;
use App\Models\PenilaianSiswa;
use App\Models\Sub_kriteria;
use App\Models\NilaiAkhirSiswa;
use App\Models\Alternatif;
use App\Models\Penilaian;

class PenilaianSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua alternatif dengan penilaiannya dan subkriteria
        $siswa = Siswa::with(['penilaiansiswa.sub_kriteria'])->get();

        // Ambil semua kriteria
        $kriteria = Kriteria::all();

        return view('penilaiansiswa.index', compact('siswa', 'kriteria'));
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
        public function edit($siswa_id)
        {
            $siswa = Siswa::findOrFail($siswa_id);
            $kriteria = Kriteria::with('NormalisasiBobot')->get(); // Ambil kriteria dengan bobot
            $penilaiansiswa = PenilaianSiswa::where('siswa_id', $siswa_id)->get()->keyBy('kriteria_id');

            return view('penilaiansiswa.edit', compact('siswa', 'kriteria', 'penilaiansiswa'));
        }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);
    $kriterias = Kriteria::with('NormalisasiBobot')->get();

    $totalNilai = 0;
    foreach ($request->penilaiansiswa as $kriteria_id => $sub_kriteria_id) {
        $kriteria = Kriteria::findOrFail($kriteria_id);
        // Ambil bobot sub-kriteria (tanpa dikali bobot kriteria)
        $subKriteria = Sub_kriteria::find($sub_kriteria_id);
        $nilai = $subKriteria ? $subKriteria->bobot_sub_kriteria : 0;

        PenilaianSiswa::updateOrCreate(
            [
                'siswa_id' => $siswa_id,
                'kriteria_id' => $kriteria_id
            ],
            [
                'sub_kriteria_id' => $sub_kriteria_id,
                'nilai' => round($nilai, 4)
            ]
        );
        $totalNilai += $nilai;
    }
    NilaiAkhirSiswa::updateOrCreate(
        ['siswa_id' => $siswa_id],
        ['nilai_akhir' => round($totalNilai, 4)]
    );

    return redirect()->route('penilaiansiswa.index')->with('success', 'Penilaian siswa berhasil diperbarui!');
}


        /**
         * Remove the specified resource from storage.
         */
        public function destroy($siswa_id)
        {
        PenilaianSiswa::where('siswa_id', $siswa_id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Penilaian berhasil dihapus!');
        }

     public function hitungNilaiUtility($siswa_id)
        {
            $siswa = Siswa::findOrFail($siswa_id);
            $alternatifList = Alternatif::all(); // Ambil semua jurusan
            $kriterias = Kriteria::all();

            // Simpan skor awal jurusan
            $penilaianJurusan = [];

            foreach ($alternatifList as $alternatif) {
                $totalSkor = 0;

                foreach ($kriterias as $kriteria) {
                    $nilaiSiswa = PenilaianSiswa::where('siswa_id', $siswa->id)
                                                ->where('kriteria_id', $kriteria->id)
                                                ->value('nilai') ?? 0;

                    $nilaiJurusan = Penilaian::where('alternatif_id', $alternatif->id)
                                                    ->where('kriteria_id', $kriteria->id)
                                                    ->value('nilai') ?? 0;

                    // Hitung selisih untuk evaluasi
                    $totalSkor += abs($nilaiSiswa - $nilaiJurusan);
                }

                $penilaianJurusan[] = [
                    'alternatif_id' => $alternatif->id,
                    'totalSkor' => round($totalSkor, 2)
                ];
            }

            // Normalisasi nilai utility
            $minSkor = min(array_column($penilaianJurusan, 'totalSkor'));
            $maxSkor = max(array_column($penilaianJurusan, 'totalSkor'));

            foreach ($penilaianJurusan as &$pj) {
                $pj['utility'] = ($maxSkor - $pj['totalSkor']) / ($maxSkor - $minSkor);
            }

            return $penilaianJurusan;
        }

        }
