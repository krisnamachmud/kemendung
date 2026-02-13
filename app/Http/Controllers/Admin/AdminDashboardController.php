<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use App\Models\Perangkat;
use App\Models\Statistik;
use App\Models\User;
use App\Models\Kartar;
use App\Models\KartarKegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = User::find(session('admin_id'));
        
        $data = [];

        // Data untuk Administrator
        if ($user && $user->isAdministrator()) {
            $data['total_berita'] = Berita::count();
            $data['total_perangkat'] = Perangkat::count();
            $data['berita_published'] = Berita::where('dipublikasikan', true)->count();
            $data['berita_draft'] = Berita::where('dipublikasikan', false)->count();
            $data['statistik'] = Statistik::first();
        }

        // Data untuk Kartar
        if ($user && $user->isKartar()) {
            $data['total_kegiatan'] = KartarKegiatan::count();
            $data['total_anggota'] = Kartar::count();
            $data['kegiatan_bulan_ini'] = KartarKegiatan::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count();
            $data['kegiatan_terbaru'] = KartarKegiatan::orderBy('tanggal', 'desc')
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', $data);
    }
}
