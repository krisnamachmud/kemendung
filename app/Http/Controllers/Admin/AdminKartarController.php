<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kartar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKartarController extends Controller
{
    public function index()
    {
        $anggota = Kartar::orderBy('urutan')->orderBy('nama')->get();
        return view('admin.kartar.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.kartar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'ditampilkan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kartar', 'public');
        }

        $validated['ditampilkan'] = $request->has('ditampilkan');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        Kartar::create($validated);

        return redirect()->route('admin.kartar.index')
            ->with('success', 'Anggota Karang Taruna berhasil ditambahkan!');
    }

    public function edit(Kartar $kartar)
    {
        return view('admin.kartar.edit', compact('kartar'));
    }

    public function update(Request $request, Kartar $kartar)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'ditampilkan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($kartar->foto) {
                Storage::disk('public')->delete($kartar->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kartar', 'public');
        }

        $validated['ditampilkan'] = $request->has('ditampilkan');

        $kartar->update($validated);

        return redirect()->route('admin.kartar.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Kartar $kartar)
    {
        if ($kartar->foto) {
            Storage::disk('public')->delete($kartar->foto);
        }

        $kartar->delete();

        return redirect()->route('admin.kartar.index')
            ->with('success', 'Data anggota berhasil dihapus!');
    }
}
