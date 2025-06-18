<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use App\Http\Controllers\SMARTController;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use App\Models\Alternatif;
use App\Models\Penilaian;
use App\Models\PenilaianSiswa;

class SMARTLogicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function rekomendasiSMART_mengembalikan_view_dengan_data_terstruktur()
    {
        // 1. Setup dummy data
        $siswa = Siswa::factory()->create();

        $k1 = Kriteria::factory()->create([
            'bobot_kriteria' => 10,
            'jenis_kriteria' => 'Benefit'
        ]);

        $sub = Sub_kriteria::factory()->create([
            'kriteria_id'        => $k1->id,
            'bobot_sub_kriteria' => 100
        ]);

        $alt = Alternatif::factory()->create();
        Penilaian::factory()->create([
            'alternatif_id'   => $alt->id,
            'kriteria_id'     => $k1->id,
            'sub_kriteria_id' => $sub->id,
            'nilai'           => 100,
        ]);

        PenilaianSiswa::factory()->create([
            'siswa_id'         => $siswa->id,
            'kriteria_id'      => $k1->id,
            'sub_kriteria_id'  => $sub->id,
            'nilai'            => 100,
        ]);

        // 2. Panggil controller
        $ctrl = new SMARTController;
        $view = $ctrl->rekomendasiSMART($siswa->id);

        // 3. Pastikan return View
        $this->assertInstanceOf(View::class, $view);

        // 4. Ekstrak data dari View
        $data = $view->getData();
        $this->assertArrayHasKey('siswa', $data);
        $this->assertArrayHasKey('hasil', $data);

        // 5. 'hasil' harus array dan minimal 1 entry
        $this->assertIsArray($data['hasil']);
        $this->assertNotEmpty($data['hasil']);

        // 6. Periksa struktur entry pertama
        $first = $data['hasil'][0];
        $this->assertArrayHasKey('jurusan', $first);
        $this->assertArrayHasKey('total', $first);
        $this->assertArrayHasKey('detail', $first);
        $this->assertIsArray($first['detail']);
    }

    /** @test */
    public function utility_hitung_range_0_sampai_1()
    {
        // 1. Setup kriteria, subkriteria, alternatif, penilaian
        $k1 = Kriteria::factory()->create(['jenis_kriteria'=>'Benefit']);
        $sub1 = Sub_kriteria::factory()->create([
            'kriteria_id'        => $k1->id,
            'bobot_sub_kriteria' => 0
        ]);
        $sub2 = Sub_kriteria::factory()->create([
            'kriteria_id'        => $k1->id,
            'bobot_sub_kriteria' => 100
        ]);

        $alt1 = Alternatif::factory()->create();
        $alt2 = Alternatif::factory()->create();

        // dua penilaian alternatif
        Penilaian::factory()->create([
            'alternatif_id'   => $alt1->id,
            'kriteria_id'     => $k1->id,
            'sub_kriteria_id' => $sub1->id,
            'nilai'           => 0,
        ]);
        Penilaian::factory()->create([
            'alternatif_id'   => $alt2->id,
            'kriteria_id'     => $k1->id,
            'sub_kriteria_id' => $sub2->id,
            'nilai'           => 100,
        ]);

        // 2. Panggil controller
        $ctrl = new SMARTController;
        $view = $ctrl->hitungUtility();

        // 3. Pastikan return View
        $this->assertInstanceOf(View::class, $view);

        // 4. Ekstrak data
        $data = $view->getData();
        // Dalam view hsl utility, key 'alternatif' atau sesuai compact() di controller
        $this->assertArrayHasKey('alternatif', $data);

        $alternatifs = $data['alternatif'];
        $this->assertIsIterable($alternatifs);
        $this->assertCount(2, $alternatifs);

        // 5. Cek setiap nilai_utility dalam [0,1]
        foreach ($alternatifs as $a) {
            $this->assertGreaterThanOrEqual(0, $a->nilai_utility);
            $this->assertLessThanOrEqual(1,    $a->nilai_utility);
        }
    }
}
