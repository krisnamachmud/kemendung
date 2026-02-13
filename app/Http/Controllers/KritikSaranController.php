<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function index()
    {
        return view('kritik-saran.index', [
            'title' => 'Kritik & Saran',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'jenis' => 'required|in:kritik,saran,masukan,pertanyaan',
            'pesan' => 'required|string|max:2000',
        ]);

        KritikSaran::create($validated);

        return redirect()->route('kritik-saran.index')
            ->with('success', 'Terima kasih! Kritik & saran Anda telah berhasil dikirim.');
    }
}
