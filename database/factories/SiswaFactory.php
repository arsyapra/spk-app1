<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'nama_siswa' => $this->faker->name,
            'minat'      => $this->faker->randomElement(['Eksakta','Sosial','Bahasa']),
            // jika ada kolom user_id, kamu bisa pakai:
            // 'user_id'    => User::factory(),
        ];
    }
}
