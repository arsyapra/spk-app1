<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Alternatif extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
        'kelompok_minat'
    ];

    public function penilaian() {

    return $this->hasMany(Penilaian::class);
    }
    public function utilities()
{
    return $this->hasMany(Utility::class);
}
public function nilaiAkhir()
{
    return $this->hasOne(Nilai_akhir::class);
}
public function nilaiakhirsiswa()
{
    return $this->hasOne(NilaiAkhirSiswa::class);
}


}
