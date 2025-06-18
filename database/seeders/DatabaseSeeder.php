<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            
            'name' => 'Arsya Pramudita Hanggara',
            'role'=> 'admin',
            'email' => 'Arsya@gmail.com',
            'password'=> bcrypt('admin123')
        ]);


        Kriteria::create([
            
            'kode_kriteria' => 'K00001',
            'nama_kriteria' => 'Nilai Akademik',
            'bobot_kriteria' => 60,
            'jenis_kriteria' => 'Benefit',
        ]);

        Kriteria::create([
            
            'kode_kriteria' => 'K00002',
            'nama_kriteria' => 'Minat Bakat',
            'bobot_kriteria' => 25,
            'jenis_kriteria' => 'Benefit',
        ]);

        Kriteria::create([
            
            'kode_kriteria' => 'K00003',
            'nama_kriteria' => 'Psikotes',
            'bobot_kriteria' => 15,
            'jenis_kriteria' => 'Benefit',
        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0001',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai > 91',
            'bobot_sub_kriteria' => 100,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0002',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 81 - 90',
            'bobot_sub_kriteria' => 75,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0003',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 71 - 80',
            'bobot_sub_kriteria' => 50,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0004',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 61 - 70',
            'bobot_sub_kriteria' => 25,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0005',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai < 60',
            'bobot_sub_kriteria' => 0,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0001',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ > 110',
            'bobot_sub_kriteria' => 100,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0002',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 100 - 109',
            'bobot_sub_kriteria' => 75,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0003',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 90 - 99',
            'bobot_sub_kriteria' => 50,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0004',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 80 - 89',
            'bobot_sub_kriteria' => 25,

        ]);


        



    }
}
