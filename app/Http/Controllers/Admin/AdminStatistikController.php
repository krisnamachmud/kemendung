<?php

namespace App\Http\Controllers\Admin;

use App\Models\Statistik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminStatistikController extends Controller
{
    // Form edit statistik
    public function edit()
    {
        $statistik = Statistik::first() ?? new Statistik();
        return view('admin.statistik.edit', ['statistik' => $statistik]);
    }

    // Update statistik
    public function update(Request $request)
    {
        $validated = $request->validate([
            'penduduk_laki' => 'required|integer|min:0',
            'penduduk_perempuan' => 'required|integer|min:0',
            'kepala_keluarga' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'jumlah_dusun' => 'required|integer|min:0',
        ]);

        $statistik = Statistik::first();

        if ($statistik) {
            $statistik->update($validated);
        } else {
            Statistik::create($validated);
        }

        return redirect()->route('admin.statistik.edit')->with('success', 'Statistik berhasil diupdate');
    }
}
