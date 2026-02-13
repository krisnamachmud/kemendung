<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class AdminKritikSaranController extends Controller
{
    public function index(Request $request)
    {
        $query = KritikSaran::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $data = $query->get();
        $countBaru = KritikSaran::where('status', 'baru')->count();

        return view('admin.kritik-saran.index', compact('data', 'countBaru'));
    }

    public function show(KritikSaran $kritik_saran)
    {
        // Tandai sebagai dibaca jika masih baru
        if ($kritik_saran->status === 'baru') {
            $kritik_saran->update(['status' => 'dibaca']);
        }

        return view('admin.kritik-saran.show', ['item' => $kritik_saran]);
    }

    public function tanggapi(Request $request, KritikSaran $kritik_saran)
    {
        $request->validate([
            'tanggapan' => 'required|string|max:2000',
        ]);

        $kritik_saran->update([
            'tanggapan' => $request->tanggapan,
            'status' => 'ditanggapi',
            'ditanggapi_at' => now(),
        ]);

        return redirect()->route('admin.kritik-saran.index')
            ->with('success', 'Tanggapan berhasil disimpan!');
    }

    public function destroy(KritikSaran $kritik_saran)
    {
        $kritik_saran->delete();

        return redirect()->route('admin.kritik-saran.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
