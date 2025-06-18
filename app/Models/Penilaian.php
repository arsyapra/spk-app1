<?php

namespace App\Models;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians'; // Pastikan ini sesuai nama tabel kamu

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai'
    ];

    public function alternatif(){
        return $this->belongsTo(Alternatif::class);
    }
    public function kriteria(){
        return $this->belongsTo(Kriteria::class);
    }
    public function sub_kriteria(){
        return $this->belongsTo(Sub_kriteria::class);
    }
}
