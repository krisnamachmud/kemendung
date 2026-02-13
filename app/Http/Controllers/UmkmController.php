<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index(): View
    {
        $umkms = Umkm::where('ditampilkan', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('umkm.index', [
            'umkms' => $umkms,
            'title' => 'UMKM Dusun Kemendung'
        ]);
    }

    public function show(Umkm $umkm): View
    {
        // Jika UMKM tidak ditampilkan, redirect ke halaman UMKM
        if (!$umkm->ditampilkan) {
            return redirect()->route('umkm.index');
        }

        // Ambil UMKM lainnya untuk rekomendasi
        $otherUmkms = Umkm::where('ditampilkan', true)
            ->where('id', '!=', $umkm->id)
            ->limit(3)
            ->get();

        return view('umkm.show', [
            'umkm' => $umkm,
            'otherUmkms' => $otherUmkms,
            'title' => $umkm->nama
        ]);
    }
}
