<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sub_kriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_sub_kriteria',
        'kriteria_id',
        'nama_sub_kriteria',
        'bobot_sub_kriteria',
    ];
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
    public function penilaian(){
        return $this->hasMany(Penilaian::class);
    }
        public function penilaian_siswa(){
        return $this->hasMany(PenilaianSiswa::class);
    }

}
