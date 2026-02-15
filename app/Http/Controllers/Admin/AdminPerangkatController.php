<?php

namespace App\Http\Controllers\Admin;

use App\Models\Perangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminPerangkatController extends Controller
{
    // Daftar perangkat
    public function index()
    {
        $perangkat = Perangkat::latest()->paginate(10);
        return view('admin.perangkat.index', ['perangkat' => $perangkat]);
    }

    // Form create
    public function create()
    {
        return view('admin.perangkat.create');
    }

    // Simpan perangkat baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'dusun' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255',
            'no_ktp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        Perangkat::create($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat berhasil ditambahkan');
    }

    // Form edit
    public function edit(Perangkat $perangkat)
    {
        return view('admin.perangkat.edit', ['perangkat' => $perangkat]);
    }

    // Update perangkat
    public function update(Request $request, Perangkat $perangkat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'dusun' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255',
            'no_ktp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('foto')) {
            // Delete old image
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat berhasil diupdate');
    }

    // Hapus perangkat
    public function destroy(Perangkat $perangkat)
    {
        // Delete image if exists
        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat berhasil dihapus');
    }
}
