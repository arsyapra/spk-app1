<?php

namespace Database\Factories;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianFactory extends Factory
{
    protected $model = Penilaian::class;

    public function definition()
    {
        // Pastikan ada minimal satu Sub_kriteria per Kriteria
        $sub = Sub_kriteria::factory()->create();

        return [
            'alternatif_id'    => Alternatif::factory(),
            'kriteria_id'      => $sub->kriteria_id,
            'sub_kriteria_id'  => $sub->id,
            // kita ulangi nilai sesuai bobot sub
            'nilai'            => $sub->bobot_sub_kriteria,
        ];
    }
}
