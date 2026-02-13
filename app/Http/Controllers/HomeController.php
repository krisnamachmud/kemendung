<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Perangkat;
use App\Models\Statistik;
use App\Models\Kartar;

class HomeController extends Controller
{
    public function index()
    {
        $statistik = Statistik::first();
        $berita = Berita::where('dipublikasikan', true)
                    ->latest()
                    ->take(3)
                    ->get();
        $perangkat = Perangkat::all();

        return view('index', compact('statistik', 'berita', 'perangkat'));
    }

    public function berita()
    {
        $berita = Berita::where('dipublikasikan', true)
                    ->latest()
                    ->paginate(10);

        return view('berita', compact('berita'));
    }

    public function beritaDetail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaTerkait = Berita::where('kategori', $berita->kategori)
                            ->where('id', '!=', $berita->id)
                            ->take(3)
                            ->get();

        return view('berita-detail', compact('berita', 'beritaTerkait'));
    }

    public function perangkat()
    {
        $perangkat = Perangkat::all();
        $kartar = Kartar::orderByRaw("FIELD(jabatan, 'Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara') DESC")->get();

        return view('perangkat', compact('perangkat', 'kartar'));
    }

    public function statistik()
    {
        $statistik = Statistik::first();

        return view('statistik', compact('statistik'));
    }
}
