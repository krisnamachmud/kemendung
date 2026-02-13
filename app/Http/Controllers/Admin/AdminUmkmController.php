<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUmkmController extends Controller
{
    public function index(): View
    {
        $umkms = Umkm::orderBy('created_at', 'desc')->get();
        return view('admin.umkm.index', compact('umkms'));
    }

    public function create(): View
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'pemilik' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'jam_operasional' => 'nullable|string',
            'catatan' => 'nullable|string',
            'ditampilkan' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('umkm', 'public');
            $validated['logo'] = $path;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama']);

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function edit(Umkm $umkm): View
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'pemilik' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'jam_operasional' => 'nullable|string',
            'catatan' => 'nullable|string',
            'ditampilkan' => 'boolean',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('umkm', 'public');
            $validated['logo'] = $path;
        }

        // Generate slug if nama berubah
        if ($validated['nama'] !== $umkm->nama) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil diperbarui!');
    }

    public function destroy(Umkm $umkm): RedirectResponse
    {
        $umkm->delete();
        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus!');
    }
}
