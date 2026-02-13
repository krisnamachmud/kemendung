<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KartarKegiatan extends Model
{
    protected $table = 'kartar_kegiatan';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tanggal',
        'lokasi',
        'foto',
        'ditampilkan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'ditampilkan' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->judul);
            }
        });
    }
}
