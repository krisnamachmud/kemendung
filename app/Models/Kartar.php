<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kartar extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'no_hp',
        'alamat',
        'urutan',
        'ditampilkan',
    ];

    protected $casts = [
        'ditampilkan' => 'boolean',
    ];
}
