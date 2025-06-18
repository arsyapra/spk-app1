<?php

namespace Database\Factories;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class KriteriaFactory extends Factory
{
    protected $model = Kriteria::class;

    public function definition()
    {
        return [
            'kode_kriteria'  => strtoupper($this->faker->unique()->lexify('??')).$this->faker->unique()->numerify('###'),
            'nama_kriteria'  => $this->faker->word,
            'bobot_kriteria' => $this->faker->numberBetween(1,100),
            'jenis_kriteria' => $this->faker->randomElement(['Benefit','Cost']),
        ];
    }
}
