<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kriteria;


class NormalisasiBobot extends Model
{
    protected $table = 'normalisasi_bobots';

    protected $fillable = [
        'kriteria_id',
        'normalisasi',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}