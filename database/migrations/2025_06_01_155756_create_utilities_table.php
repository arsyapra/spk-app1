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
    Schema::create('utilities', function (Blueprint $table) {
    $table->id();
    $table->foreignId('alternatif_id')->constrained()->onDelete('cascade');
    $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
    $table->double('nilai_utility');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities');
    }
};
