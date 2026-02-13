<?php

namespace App\Http\Controllers;

use App\Models\Kartar;
use App\Models\KartarKegiatan;

class KartarController extends Controller
{
    public function index()
    {
        $anggota = Kartar::where('ditampilkan', true)
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        $kegiatan = KartarKegiatan::where('ditampilkan', true)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('kartar.index', [
            'title' => 'Karang Taruna - Tunas Bangsa',
            'anggota' => $anggota,
            'kegiatan' => $kegiatan,
        ]);
    }
}
