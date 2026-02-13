<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'kategori',
        'pemilik',
        'kontak',
        'email',
        'logo',
        'alamat',
        'latitude',
        'longitude',
        'jam_operasional',
        'catatan',
        'ditampilkan',
    ];

    protected $casts = [
        'ditampilkan' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
