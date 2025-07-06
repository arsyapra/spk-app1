<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhirSiswa extends Model
{
    protected $table = 'nilai_akhir_siswas';

    protected $fillable = ['user_id', 'nilai_akhir'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function alternatif(){
    //     return $this->belongsTo(Alternatif::class);
    // }

}
