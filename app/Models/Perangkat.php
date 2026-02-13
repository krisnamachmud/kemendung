<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'dusun',
        'foto',
        'nip',
        'no_ktp',
    ];

    protected $table = 'perangkats';
}
