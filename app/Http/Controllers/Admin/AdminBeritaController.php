<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

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
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage'), $filename);
            $validated['gambar'] = $filename;
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
            if ($berita->gambar && file_exists(public_path('storage/' . $berita->gambar))) {
                unlink(public_path('storage/' . $berita->gambar));
            }

            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage'), $filename);
            $validated['gambar'] = $filename;
        }

        $validated['dipublikasikan'] = $request->has('dipublikasikan') ? 1 : 0;

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
    }

    // Hapus berita
    public function destroy(Berita $berita)
    {
        // Delete image if exists
        if ($berita->gambar && file_exists(public_path('storage/' . $berita->gambar))) {
            unlink(public_path('storage/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
