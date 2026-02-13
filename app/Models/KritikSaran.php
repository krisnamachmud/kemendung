<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    protected $table = 'kritik_saran';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jenis',
        'pesan',
        'status',
        'tanggapan',
        'ditanggapi_at',
    ];

    protected $casts = [
        'ditanggapi_at' => 'datetime',
    ];
}
