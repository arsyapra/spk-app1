<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Nilai_akhir;
use App\Models\Utility;
use App\Models\NilaiAkhirSiswa;
use App\Models\Siswa;
use App\Models\PenilaianSiswa;
use App\Models\NormalisasiBobot;

class SMARTController extends Controller
{
    // 1. Normalisasi bobot kriteria
    public function normalisasiBobot()
    {
        $kriteria = Kriteria::all();
        $total_bobot = $kriteria->sum('bobot_kriteria');
        if ($total_bobot == 0) {
            return redirect()->back()->with('error', 'Total bobot tidak boleh nol');
        }
        foreach ($kriteria as $item) {
            $normal = $item->bobot_kriteria / $total_bobot;
            NormalisasiBobot::updateOrCreate(
                ['kriteria_id' => $item->id],
                ['normalisasi' => $normal]
            );
        }
        $kriteria_normalisasi = NormalisasiBobot::with('kriteria')->get();
        return view('hasil.normalisasi', compact('kriteria_normalisasi'));
    }

    // 2. Hitung utility untuk masing-masing jurusan
    public function hitungUtility()
    {
        $kriterias = Kriteria::all();
        $alternatif = Alternatif::with('utilities')->get();

        foreach ($kriterias as $kriteria) {
            $penilaians = Penilaian::where('kriteria_id', $kriteria->id)->with('sub_kriteria')->get();
            $nilaiList = $penilaians->pluck('sub_kriteria.bobot_sub_kriteria')->toArray();

            $min = min($nilaiList);
            $max = max($nilaiList);

            foreach ($penilaians as $penilaian) {
                $nilai = $penilaian->sub_kriteria->bobot_sub_kriteria;
                $jenis = $penilaian->kriteria->jenis_kriteria;
                $utility = 0;

                if ($max == $min) {
                    $utility = 1;
                } else {
                    if ($jenis == 'Benefit') {
                        $utility = ($nilai - $min) / ($max - $min);
                    } elseif ($jenis == 'Cost') {
                        $utility = ($max - $nilai) / ($max - $min);
                    }
                }

                Utility::updateOrCreate(
                    [
                        'alternatif_id' => $penilaian->alternatif_id,
                        'kriteria_id' => $kriteria->id
                    ],
                    ['nilai_utility' => $utility]
                );
            }
        }

        $kriteria = $kriterias;
        $alternatif = Alternatif::with('utilities')->get();
        return view('hasil.utility', compact('kriteria', 'alternatif'));
    }

    // 3. Hitung nilai akhir untuk tiap jurusan (umum)
    public function hitungNilaiAkhir()
    {
        $alternatifs = Alternatif::with('utilities')->get();
        $kriterias = Kriteria::with('NormalisasiBobot')->get();
        $hasil_akhir = [];

        foreach ($alternatifs as $alternatif) {
            $total = 0;
            foreach ($kriterias as $kriteria) {
                $utility = $alternatif->utilities->where('kriteria_id', $kriteria->id)->first();
                $bobot = $kriteria->NormalisasiBobot->normalisasi ?? 0;
                if ($utility) {
                    $total += $utility->nilai_utility * $bobot * 100;
                }
            }
            // Simpan ke database
            Nilai_akhir::updateOrCreate(
                ['alternatif_id' => $alternatif->id],
                ['nilai_akhir' => round($total, 4)]
            );
            $hasil_akhir[] = (object)[
                'alternatif' => $alternatif->nama_alternatif,
                'nilai_akhir' => round($total, 4)
            ];
        }
        // Urutkan berdasarkan nilai akhir descending
        usort($hasil_akhir, fn($a, $b) => $b->nilai_akhir <=> $a->nilai_akhir);
        return view('hasil.nilai_akhir', compact('hasil_akhir'));
    }

    // 4. Hitung rekomendasi jurusan khusus untuk siswa tertentu
public function hitungRekomendasiJurusan($siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();

    // Ambil nilai siswa per kriteria
    $nilai_siswa = [];
    foreach ($kriterias as $kriteria) {
        $nilai = PenilaianSiswa::where('siswa_id', $siswa->id)
            ->where('kriteria_id', $kriteria->id)
            ->value('nilai') ?? 0;
        $nilai_siswa[$kriteria->id] = $nilai;
    }

    // Ambil nilai ideal tiap jurusan per kriteria
    $profil_jurusan = [];
    foreach ($alternatifs as $alternatif) {
        foreach ($kriterias as $kriteria) {
            $nilai = Penilaian::where('alternatif_id', $alternatif->id)
                ->where('kriteria_id', $kriteria->id)
                ->value('nilai') ?? 0;
            $profil_jurusan[$alternatif->id][$kriteria->id] = $nilai;
        }
    }

    // Hitung semua selisih untuk normalisasi
    $all_selisih = [];
    foreach ($alternatifs as $alternatif) {
        foreach ($kriterias as $kriteria) {
            $all_selisih[] = abs($nilai_siswa[$kriteria->id] - $profil_jurusan[$alternatif->id][$kriteria->id]);
        }
    }
    $max_selisih = max($all_selisih) ?: 1; // Hindari pembagian nol

    // HITUNG SKOR AKHIR SMART untuk setiap jurusan
    $hasilAkhir = [];
    foreach ($alternatifs as $alternatif) {
        $totalSkor = 0;
        foreach ($kriterias as $kriteria) {
            $bobot = $kriteria->bobot_kriteria; // Langsung dari DB (bukan normalisasiBobot jika belum ada)
            $selisih = abs($nilai_siswa[$kriteria->id] - $profil_jurusan[$alternatif->id][$kriteria->id]);
            $utility = 1 - ($selisih / $max_selisih);
            $totalSkor += $utility * $bobot;
        }
        NilaiAkhirSiswa::updateOrCreate(
            ['alternatif_id' => $alternatif->id, 'siswa_id' => $siswa->id],
            ['nilai_akhir' => round($totalSkor, 4)]
        );
        $hasilAkhir[] = (object)[
            'nama_alternatif' => $alternatif->nama_alternatif,
            'nilai_akhir' => round($totalSkor, 4)
        ];
    }
    // Urutkan berdasarkan skor tertinggi
    usort($hasilAkhir, fn($a, $b) => $b->nilai_akhir <=> $a->nilai_akhir);

    return view('hasil.rekomendasi', [
        'hasilAkhir' => $hasilAkhir,
        'siswa' => $siswa,
        'alternatifs' => $alternatifs,
    ]);
}
public function rekomendasiSMART($siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);
    $kriterias = Kriteria::with('NormalisasiBobot')->get();
    $alternatifs = Alternatif::all();

    // 1. Ambil nilai siswa per kriteria
    $nilai_siswa = [];
    foreach ($kriterias as $kriteria) {
        $nilai_siswa[$kriteria->id] = PenilaianSiswa::where('siswa_id', $siswa->id)
            ->where('kriteria_id', $kriteria->id)
            ->value('nilai') ?? 0;
    }

    // 2. Ambil nilai ideal tiap jurusan per kriteria
    $nilai_jurusan = [];
    foreach ($alternatifs as $alternatif) {
        foreach ($kriterias as $kriteria) {
            $nilai_jurusan[$alternatif->id][$kriteria->id] = Penilaian::where('alternatif_id', $alternatif->id)
                ->where('kriteria_id', $kriteria->id)
                ->value('nilai') ?? 0;
        }
    }

    // 3. Hitung max selisih untuk normalisasi
    $all_selisih = [];
    foreach ($alternatifs as $alternatif) {
        foreach ($kriterias as $kriteria) {
            $all_selisih[] = abs($nilai_siswa[$kriteria->id] - $nilai_jurusan[$alternatif->id][$kriteria->id]);
        }
    }
    $max_selisih = max($all_selisih) ?: 1;

    // 4. Hitung utility dan nilai akhir untuk setiap jurusan
    $hasil = [];
    foreach ($alternatifs as $alternatif) {
        $total = 0;
        $rincian = [];
        foreach ($kriterias as $kriteria) {
            // Pakai bobot normalisasi dari tabel normalisasi_bobots
            $bobot = $kriteria->NormalisasiBobot->normalisasi ?? 0;

            $selisih = abs($nilai_siswa[$kriteria->id] - $nilai_jurusan[$alternatif->id][$kriteria->id]);
            $utility = 1 - ($selisih / $max_selisih);

            $skor = $utility * $bobot;
            $total += $skor;

            // Untuk penjelasan detail per kriteria (optional)
            $rincian[] = [
                'kriteria' => $kriteria->nama_kriteria,
                'nilai_siswa' => $nilai_siswa[$kriteria->id],
                'nilai_ideal' => $nilai_jurusan[$alternatif->id][$kriteria->id],
                'selisih' => $selisih,
                'utility' => round($utility, 4),
                'bobot_normalisasi' => $bobot,
                'skor' => round($skor, 4)
            ];
        }
        $hasil[] = [
            'jurusan' => $alternatif->nama_alternatif,
            'total' => round($total, 4),
            'detail' => $rincian
        ];
    }

    // 5. Urutkan hasil dari skor terbesar ke terkecil dan ambil 4 teratas
    usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);
    $hasil = array_slice($hasil, 0, 4);

    return view('hasil.rekomendasi', compact('hasil', 'siswa', 'kriterias'));
}


}
