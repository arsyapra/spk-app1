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
            'password'=> bcrypt('admin123'),
            'nisn' => '2103015076'
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
            'nama_sub_kriteria' => 'Nilai 88 - 90',
            'bobot_sub_kriteria' => 90,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0003',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 85 - 87',
            'bobot_sub_kriteria' => 80,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0004',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 82 - 84',
            'bobot_sub_kriteria' => 75,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0005',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 79 - 81',
            'bobot_sub_kriteria' => 70,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0006',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 70 - 78',
            'bobot_sub_kriteria' => 55,

        ]);
        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0007',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai 60 - 69',
            'bobot_sub_kriteria' => 40,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'NA0008',
            'kriteria_id' => '1',
            'nama_sub_kriteria' => 'Nilai < 59',
            'bobot_sub_kriteria' => 25,

        ]);


        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0001',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Kesehatan & Kedokteran',
            'bobot_sub_kriteria' => 100,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0002',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Teknologi & Informatika',
            'bobot_sub_kriteria' => 85,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0003',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Teknik',
            'bobot_sub_kriteria' => 80,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0004',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Bisnis & Ekonomi',
            'bobot_sub_kriteria' => 75,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0005',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Psikologi & Ilmu Sosial',
            'bobot_sub_kriteria' => 70,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0006',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Hukum & Politik',
            'bobot_sub_kriteria' => 65,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0007',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Komunkasi & Media',
            'bobot_sub_kriteria' => 60,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0008',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Seni & Desain',
            'bobot_sub_kriteria' => 55,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0009',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Bahasa & Sastra',
            'bobot_sub_kriteria' => 50,

        ]);

            Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0010',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Pertanian',
            'bobot_sub_kriteria' => 45,

        ]);

            Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0011',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Pariwisata',
            'bobot_sub_kriteria' => 40,

        ]);

            Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'MB0012',
            'kriteria_id' => '2',
            'nama_sub_kriteria' => 'Olahraga',
            'bobot_sub_kriteria' => 35,

        ]);

        


        



        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0001',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ > 120',
            'bobot_sub_kriteria' => 100,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0002',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 110 - 119',
            'bobot_sub_kriteria' => 80,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0003',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 90 - 109',
            'bobot_sub_kriteria' => 60,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0004',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 80 - 89',
            'bobot_sub_kriteria' => 40,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0005',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ 70 - 79',
            'bobot_sub_kriteria' => 20,

        ]);

        Sub_kriteria::create([
            
            'kode_sub_kriteria' => 'PS0006',
            'kriteria_id' => '3',
            'nama_sub_kriteria' => 'IQ < 69',
            'bobot_sub_kriteria' => 0,

        ]);


        



    }
}
