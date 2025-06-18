<?php

namespace Database\Factories;

use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class Sub_kriteriaFactory extends Factory
{
    protected $model = Sub_kriteria::class;

    public function definition()
    {
        return [
            'kode_sub_kriteria'  => strtoupper($this->faker->unique()->lexify('SB???')),
            'kriteria_id'        => Kriteria::factory(),
            'nama_sub_kriteria'  => $this->faker->sentence(2),
            'bobot_sub_kriteria' => $this->faker->numberBetween(0, 100),
        ];
    }
}
