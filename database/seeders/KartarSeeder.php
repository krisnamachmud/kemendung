<?php

namespace Database\Seeders;

use App\Models\Kartar;
use App\Models\KartarKegiatan;
use Illuminate\Database\Seeder;

class KartarSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            ['nama' => 'Ahmad Fauzi', 'jabatan' => 'Ketua', 'no_hp' => '081234567890', 'urutan' => 1, 'ditampilkan' => true],
            ['nama' => 'Budi Santoso', 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567891', 'urutan' => 2, 'ditampilkan' => true],
            ['nama' => 'Siti Aisyah', 'jabatan' => 'Sekretaris', 'no_hp' => '081234567892', 'urutan' => 3, 'ditampilkan' => true],
            ['nama' => 'Dewi Lestari', 'jabatan' => 'Bendahara', 'no_hp' => '081234567893', 'urutan' => 4, 'ditampilkan' => true],
            ['nama' => 'Rudi Hartono', 'jabatan' => 'Koordinator', 'no_hp' => '081234567894', 'urutan' => 5, 'ditampilkan' => true],
            ['nama' => 'Rina Wati', 'jabatan' => 'Anggota', 'urutan' => 6, 'ditampilkan' => true],
            ['nama' => 'Agus Prasetyo', 'jabatan' => 'Anggota', 'urutan' => 7, 'ditampilkan' => true],
        ];

        foreach ($anggota as $data) {
            Kartar::firstOrCreate(['nama' => $data['nama']], $data);
        }

        $kegiatan = [
            [
                'judul' => 'Kerja Bakti Lingkungan',
                'slug' => 'kerja-bakti-lingkungan',
                'deskripsi' => 'Kegiatan bersih-bersih lingkungan dusun yang dilaksanakan secara rutin setiap bulan untuk menjaga kebersihan dan keindahan lingkungan.',
                'tanggal' => '2026-01-15',
                'lokasi' => 'Dusun Kemendung',
                'ditampilkan' => true,
            ],
            [
                'judul' => 'Turnamen Voli Antar RT',
                'slug' => 'turnamen-voli-antar-rt',
                'deskripsi' => 'Kompetisi bola voli antar RT untuk mempererat silaturahmi dan semangat olahraga warga dusun.',
                'tanggal' => '2026-01-28',
                'lokasi' => 'Lapangan Dusun Kemendung',
                'ditampilkan' => true,
            ],
            [
                'judul' => 'Pelatihan Kewirausahaan',
                'slug' => 'pelatihan-kewirausahaan',
                'deskripsi' => 'Workshop kewirausahaan untuk pemuda dusun agar mampu membangun usaha mandiri dan berdaya saing.',
                'tanggal' => '2026-02-05',
                'lokasi' => 'Balai Dusun Kemendung',
                'ditampilkan' => true,
            ],
        ];

        foreach ($kegiatan as $data) {
            KartarKegiatan::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
