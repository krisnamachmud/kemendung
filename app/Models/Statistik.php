<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $fillable = [
        'penduduk_laki',
        'penduduk_perempuan',
        'kepala_keluarga',
        'luas_wilayah',
        'jumlah_dusun',
    ];

    protected $table = 'statistiks';
}
