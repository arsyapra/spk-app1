<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhirSiswa extends Model
{
    protected $table = 'nilai_akhir_siswas';

    protected $fillable = ['siswa_id', 'nilai_akhir'];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    // public function alternatif(){
    //     return $this->belongsTo(Alternatif::class);
    // }

}
