<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade'); // Hubungan dengan siswa
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade'); // Hubungan dengan kriteria
            $table->foreignId('sub_kriteria_id')->constrained()->onDelete('cascade'); // Hubungan dengan kriteria
            $table->float('nilai'); // Nilai siswa berdasarkan kriteria (nilai akademik, minat, psikotes)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_siswas');
    }
};
