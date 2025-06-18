<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PenilaianSiswa extends Model
{
        use HasFactory;
        protected $table = 'penilaian_siswas'; // 
        protected $fillable = [
        'siswa_id',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai'
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
    public function kriteria(){
        return $this->belongsTo(Kriteria::class);
    }
    public function sub_kriteria(){
        return $this->belongsTo(Sub_kriteria::class);
    }
}
