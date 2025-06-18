<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_kriteria;
use App\Models\NormalisasiBobot;


class Kriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot_kriteria',
        'jenis_kriteria',
    ];
     public function sub_kriteria()
    {
        return $this->hasMany(Sub_kriteria::class);
    }
    public function NormalisasiBobot(){
        return $this->hasOne(NormalisasiBobot::class);
    }
    public function utilities()
    {
    return $this->hasMany(Utility::class);
    }

    
}
