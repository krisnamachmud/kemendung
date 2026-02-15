<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    // Daftar berita
    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        return view('admin.berita.index', ['berita' => $berita]);
    }

    // Form create
    public function create()
    {
        return view('admin.berita.create');
    }

    // Simpan berita baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'dipublikasikan' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['dipublikasikan'] = $request->has('dipublikasikan') ? 1 : 0;

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    // Form edit
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', ['berita' => $berita]);
    }

    // Update berita
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'dipublikasikan' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['judul']);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['dipublikasikan'] = $request->has('dipublikasikan') ? 1 : 0;

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
    }

    // Hapus berita
    public function destroy(Berita $berita)
    {
        // Delete image if exists
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
