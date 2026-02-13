<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'konten',
        'kategori',
        'gambar',
        'penulis',
        'dipublikasikan',
    ];

    protected $casts = [
        'dipublikasikan' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
