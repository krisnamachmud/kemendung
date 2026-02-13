<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Perangkat;
use App\Models\Statistik;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder Statistik Desa - Dusun Kemendung Saja
        Statistik::create([
            'penduduk_laki' => 650,
            'penduduk_perempuan' => 720,
            'kepala_keluarga' => 280,
            'luas_wilayah' => 2.85,
            'jumlah_dusun' => 1,
        ]);

        // Seeder Perangkat Desa - Dusun Kemendung Saja
        Perangkat::create([
            'nama' => 'Suwarto, S.E.',
            'jabatan' => 'Kepala Desa',
            'dusun' => 'Kemendung',
            'nip' => '19650315 198603 1 004',
            'foto' => 'kades.jpg',
        ]);

        Perangkat::create([
            'nama' => 'Tri Budi Santoso',
            'jabatan' => 'Sekretaris Desa',
            'dusun' => 'Kemendung',
            'nip' => '19701220 199203 1 008',
            'foto' => 'sekdes.jpg',
        ]);

        Perangkat::create([
            'nama' => 'Imam Santoso',
            'jabatan' => 'Kepala Dusun Kemendung',
            'dusun' => 'Kemendung',
            'no_ktp' => '3507171234567890',
            'foto' => 'kasun-kemendung.jpg',
        ]);

        Perangkat::create([
            'nama' => 'Dwi Retno Sari',
            'jabatan' => 'Bendahara Desa',
            'dusun' => 'Kemendung',
            'nip' => '19680510 198903 2 002',
            'foto' => 'bendahara.jpg',
        ]);

        Perangkat::create([
            'nama' => 'Siti Nurhaliza',
            'jabatan' => 'Perangkat Desa Lainnya',
            'dusun' => 'Kemendung',
            'nip' => '19750825 199203 2 005',
            'foto' => 'perangkat1.jpg',
        ]);

        Perangkat::create([
            'nama' => 'Haris Suryanto',
            'jabatan' => 'Perangkat Desa Lainnya',
            'dusun' => 'Kemendung',
            'nip' => '19680412 198903 1 003',
            'foto' => 'perangkat2.jpg',
        ]);

        // Seeder Berita
        Berita::create([
            'judul' => 'Rapat Musyawarah Rencana Pembangunan Desa (Musrenbangdes) Tahun 2026',
            'slug' => 'musrenbangdes-2026',
            'deskripsi' => 'Desa Jatirejo mengadakan Musrenbangdes untuk merencanakan pembangunan tahun 2026 bersama stakeholder dan masyarakat.',
            'konten' => '<p>Pada hari Minggu, 1 Februari 2026, Desa Jatirejo menyelenggarakan Musyawarah Rencana Pembangunan Desa (Musrenbangdes) di Balai Desa Jatirejo. Kegiatan ini dihadiri oleh Kepala Desa, Perangkat Desa, Ketua RT/RW, Ketua PKK, Ketua Karang Taruna, dan perwakilan masyarakat dari setiap dusun.</p><p>Dalam musyawarah tersebut, masyarakat bersama perangkat desa membahas berbagai kebutuhan dan aspirasi untuk pembangunan desa di tahun 2026. Hasil musyawarah akan digunakan sebagai dasar penyusunan Anggaran Pendapatan dan Belanja Desa (APBDes) tahun 2026.</p>',
            'kategori' => 'Pemerintahan',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);

        Berita::create([
            'judul' => 'Program Pemberdayaan PKK Bidang Kesehatan dan Gizi Keluarga',
            'slug' => 'pkk-kesehatan-gizi',
            'deskripsi' => 'PKK Desa Jatirejo melaksanakan program pemberdayaan masyarakat di bidang kesehatan dan gizi keluarga untuk meningkatkan kualitas hidup.',
            'konten' => '<p>Tim PKK Desa Jatirejo telah meluncurkan program pemberdayaan masyarakat yang fokus pada peningkatan kesehatan dan gizi keluarga. Program ini meliputi:</p><ul><li>Pelatihan membuat makanan bergizi untuk balita</li><li>Penyuluhan kesehatan reproduksi dan gizi ibu hamil</li><li>Pendampingan pembentukan Pos Yandu di setiap dusun</li><li>Pemberian vitamin dan suplemen kesehatan kepada ibu hamil dan balita</li></ul><p>Dengan program ini, diharapkan dapat menurunkan angka stunting dan meningkatkan status gizi masyarakat Desa Jatirejo.</p>',
            'kategori' => 'Pemberdayaan',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);

        Berita::create([
            'judul' => 'Kegiatan Karang Taruna: Gotong Royong Pembersihan Lingkungan Desa',
            'slug' => 'karang-taruna-gotong-royong',
            'deskripsi' => 'Karang Taruna Desa Jatirejo mengadakan kegiatan gotong royong pembersihan lingkungan desa sebagai bagian dari menjaga kebersihan dan kesehatan lingkungan.',
            'konten' => '<p>Dalam rangka menjaga kebersihan dan kesehatan lingkungan, Karang Taruna Desa Jatirejo telah melaksanakan kegiatan gotong royong pembersihan lingkungan desa. Kegiatan ini melibatkan pemuda dari setiap dusun untuk membersihkan:</p><ul><li>Jalan-jalan desa dari sampah dan lumpur</li><li>Saluran irigasi dari kotoran</li><li>Area sekitar balai desa dan tempat-tempat umum</li></ul><p>Kegiatan gotong royong ini dilakukan secara rutin setiap bulan untuk menjaga lingkungan tetap bersih dan sehat.</p>',
            'kategori' => 'Kegiatan Masyarakat',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);

        Berita::create([
            'judul' => 'Bantuan Dana Desentralisasi untuk Pembangunan Infrastruktur Desa',
            'slug' => 'bantuan-dana-infrastruktur',
            'deskripsi' => 'Desa Jatirejo menerima bantuan dana desentralisasi dari pemerintah untuk pembangunan infrastruktur desa tahun 2026.',
            'konten' => '<p>Pemerintah Desa Jatirejo telah menerima bantuan dana desentralisasi sebesar Rp 800.000.000 (delapan ratus juta rupiah) untuk pembangunan infrastruktur desa tahun 2026. Dana ini akan dialokasikan untuk:</p><ul><li>Perbaikan jalan desa sepanjang 2 km</li><li>Pembangunan jembatan penghubung antar dusun</li><li>Perbaikan sistem saluran irigasi</li><li>Pembangunan sarana air bersih</li></ul><p>Penggunaan dana ini akan transparansi dan melibatkan partisipasi masyarakat dalam setiap tahap pelaksanaan.</p>',
            'kategori' => 'Pengumuman',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);

        Berita::create([
            'judul' => 'Pendaftaran Calon Peserta Pelatihan Keterampilan Elektronik',
            'slug' => 'pelatihan-elektronik',
            'deskripsi' => 'Desa Jatirejo membuka pendaftaran calon peserta pelatihan keterampilan elektronik untuk pemuda dan masyarakat umum.',
            'konten' => '<p>Dalam rangka meningkatkan keterampilan dan menciptakan lapangan kerja baru, Desa Jatirejo menyelenggarakan pelatihan keterampilan elektronik. Pendaftaran dibuka untuk:</p><p><strong>Target Peserta:</strong> Pemuda usia 18-40 tahun dan masyarakat umum yang berminat</p><p><strong>Materi Pelatihan:</strong></p><ul><li>Dasar-dasar elektronik</li><li>Perbaikan peralatan elektronik rumah tangga</li><li>Instalasi listrik</li></ul><p><strong>Jadwal:</strong> Dimulai tanggal 15 Februari 2026</p><p><strong>Tempat:</strong> Balai Desa Jatirejo</p><p>Calon peserta dapat mendaftar di kantor desa atau menghubungi nomor kontak yang tersedia. Peserta yang lulus akan mendapatkan sertifikat resmi dari desa.</p>',
            'kategori' => 'Pelatihan',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);

        Berita::create([
            'judul' => 'Layanan Surat-Menyurat Desa Jatirejo: Informasi Penting untuk Warga',
            'slug' => 'layanan-surat-menyurat',
            'deskripsi' => 'Informasi lengkap tentang layanan surat-menyurat yang tersedia di Desa Jatirejo beserta prosedur dan biaya administrasinya.',
            'konten' => '<p>Desa Jatirejo menyediakan berbagai layanan surat-menyurat untuk mendukung kebutuhan administrasi warga masyarakat. Layanan yang tersedia meliputi:</p><ul><li><strong>Surat Keterangan Domisili</strong> - Rp 0</li><li><strong>Surat Keterangan Usaha</strong> - Rp 0</li><li><strong>Surat Keterangan Tidak Mampu</strong> - Rp 0</li><li><strong>Surat Keterangan Kelahiran</strong> - Rp 0</li><li><strong>Surat Rekomendasi Usaha</strong> - Rp 0</li></ul><p><strong>Prosedur Pengajuan:</strong></p><ol><li>Datang ke kantor desa dengan membawa KTP dan kartu keluarga</li><li>Mengisi formulir permohonan</li><li>Menyerahkan dokumen yang diperlukan</li><li>Menunggu surat selesai (biasanya 1-2 hari kerja)</li></ol><p>Untuk informasi lebih lanjut, hubungi kantor desa pada jam kerja: Senin-Jumat, 08:00-15:00 WIB.</p>',
            'kategori' => 'Informasi',
            'penulis' => 'Admin Desa',
            'dipublikasikan' => true,
        ]);
    }
}
