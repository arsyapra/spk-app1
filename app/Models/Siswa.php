<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ← tam

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama_siswa', 'minat'];

    public function nilai_akhir_siswa()
    {
        return $this->hasMany(NilaiAkhirSiswa::class);
    }
    public function penilaiansiswa()
{
    return $this->hasMany(PenilaianSiswa::class);
}



}
