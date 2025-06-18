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
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sub_kriteria',6)->unique();
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->string('nama_sub_kriteria');      // contoh: Matematika, Bahasa, Logika
            $table->integer('bobot_sub_kriteria');    // nilai bobot lokal atau skoring
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kriterias');
    }
};
