<?php

namespace Database\Factories;

use App\Models\PenilaianSiswa;
use App\Models\Siswa;
use App\Models\Sub_kriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianSiswaFactory extends Factory
{
    protected $model = PenilaianSiswa::class;

    public function definition()
    {
        $sub = Sub_kriteria::factory()->create();

        return [
            'siswa_id'         => Siswa::factory(),
            'kriteria_id'      => $sub->kriteria_id,
            'sub_kriteria_id'  => $sub->id,
            'nilai'            => $sub->bobot_sub_kriteria,
        ];
    }
}
