<?php

namespace Database\Factories;

use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlternatifFactory extends Factory
{
    protected $model = Alternatif::class;

    public function definition()
    {
        return [
            'kode_alternatif'  => strtoupper($this->faker->unique()->lexify('ALT??')),
            'nama_alternatif'  => $this->faker->companySuffix, 
            'kelompok_minat'   => $this->faker->randomElement(['Eksakta','Sosial','Bahasa']),
        ];
    }
}
