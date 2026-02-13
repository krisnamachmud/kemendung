<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartarKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKartarKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = KartarKegiatan::orderBy('tanggal', 'desc')->get();
        return view('admin.kartar-kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kartar-kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ditampilkan' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['ditampilkan'] = $request->has('ditampilkan');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kartar-kegiatan', 'public');
        }

        KartarKegiatan::create($validated);

        return redirect()->route('admin.kartar-kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit(KartarKegiatan $kartar_kegiatan)
    {
        return view('admin.kartar-kegiatan.edit', ['kegiatan' => $kartar_kegiatan]);
    }

    public function update(Request $request, KartarKegiatan $kartar_kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ditampilkan' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['ditampilkan'] = $request->has('ditampilkan');

        if ($request->hasFile('foto')) {
            if ($kartar_kegiatan->foto) {
                Storage::disk('public')->delete($kartar_kegiatan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kartar-kegiatan', 'public');
        }

        $kartar_kegiatan->update($validated);

        return redirect()->route('admin.kartar-kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(KartarKegiatan $kartar_kegiatan)
    {
        if ($kartar_kegiatan->foto) {
            Storage::disk('public')->delete($kartar_kegiatan->foto);
        }

        $kartar_kegiatan->delete();

        return redirect()->route('admin.kartar-kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }
}
