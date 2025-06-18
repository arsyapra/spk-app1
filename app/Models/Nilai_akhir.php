<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai_akhir extends Model
{
    protected $fillable = ['alternatif_id','nilai_akhir'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
    //     public function siswa()
    // {
    //     return $this->belongsTo(Siswa::class);
    // }

    

}