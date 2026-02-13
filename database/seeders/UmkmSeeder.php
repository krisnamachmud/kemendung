<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $umkms = [
            [
                'nama' => 'Kerajinan Batik Jatirejo',
                'slug' => 'kerajinan-batik-jatirejo',
                'deskripsi' => 'Memproduksi batik tulis berkualitas tinggi dengan desain tradisional dan modern.',
                'kategori' => 'Kerajinan',
                'pemilik' => 'Ibu Siti Nurhaliza',
                'kontak' => '+62851234567',
                'alamat' => 'Dsn. Kemendung, Jatirejo, Tikung, Lamongan',
            ],
            [
                'nama' => 'Toko Oleh-Oleh Lokal',
                'slug' => 'toko-oleh-oleh-lokal',
                'deskripsi' => 'Menjual berbagai produk lokal berkualitas dari Jatirejo dan sekitarnya.',
                'kategori' => 'Penjualan',
                'pemilik' => 'Bapak Ahmad Sudjianto',
                'kontak' => '+62852345678',
                'alamat' => 'Jln. Raya Jatirejo No. 25, Tikung, Lamongan',
            ],
            [
                'nama' => 'Pengrajin Mebel Kayu',
                'slug' => 'pengrajin-mebel-kayu',
                'deskripsi' => 'Memproduksi furniture berkualitas dengan bahan kayu pilihan.',
                'kategori' => 'Mebel',
                'pemilik' => 'Bapak Suryanto',
                'kontak' => '+62853456789',
                'alamat' => 'Jln. Kemendung No. 42, Jatirejo, Tikung, Lamongan',
            ],
            [
                'nama' => 'Warung Makan Tradisional',
                'slug' => 'warung-makan-tradisional',
                'deskripsi' => 'Menyajikan hidangan tradisional Jawa dengan cita rasa autentik.',
                'kategori' => 'Makanan & Minuman',
                'pemilik' => 'Ibu Rina Wijaya',
                'kontak' => '+62854567890',
                'alamat' => 'Dsn. Sumber Ketro, Jatirejo, Tikung, Lamongan',
            ],
            [
                'nama' => 'Tani Organik Jatirejo',
                'slug' => 'tani-organik-jatirejo',
                'deskripsi' => 'Menghasilkan sayuran dan buah-buahan organik tanpa pestisida berbahaya.',
                'kategori' => 'Pertanian',
                'pemilik' => 'Bapak Warsito',
                'kontak' => '+62855678901',
                'alamat' => 'Jln. Pertanian No. 10, Jatirejo, Tikung, Lamongan',
            ],
        ];

        foreach ($umkms as $umkm) {
            Umkm::firstOrCreate(
                ['slug' => $umkm['slug']],
                $umkm
            );
        }
    }
}
