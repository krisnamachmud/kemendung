# 🔐 Admin Panel Documentation

## Akses Admin Panel

**URL**: `http://localhost:8000/admin/login`

### Kredensial Default
- **Username**: `admin`
- **Password**: `admin123`

> **⚠️ Catatan Keamanan**: Untuk production, ganti password dan gunakan sistem authentication yang lebih aman seperti database auth atau multi-factor authentication.

---

## Fitur Admin Panel

### 1. Dashboard
**URL**: `/admin/dashboard`

Menampilkan ringkasan statistik:
- Total berita (published + draft)
- Jumlah berita yang dipublikasikan
- Jumlah berita draft
- Total perangkat desa
- Statistik demografis desa
- Informasi sistem

---

### 2. Kelola Berita (CRUD)

#### Daftar Berita
**URL**: `/admin/berita`

Fitur:
- ✅ Lihat semua berita dengan pagination (10 per halaman)
- ✅ Filter status: Dipublikasikan / Draft
- ✅ Lihat kategori, penulis, dan tanggal
- ✅ Edit atau hapus berita

#### Tambah Berita
**URL**: `/admin/berita/create`

Form fields:
- **Judul** (required)
- **Deskripsi Singkat** (required, preview text)
- **Konten Lengkap** (required, full article)
- **Kategori** (required, pilihan dropdown):
  - Pemerintahan
  - PKK
  - Karang Taruna
  - Pemberdayaan
  - Pelatihan
  - Informasi
  - Pengumuman
- **Penulis** (required, default: "Admin Desa")
- **Gambar** (optional, max 2MB)
- **Publikasikan** (checkbox, publikasi langsung atau simpan sebagai draft)

#### Edit Berita
**URL**: `/admin/berita/{id}/edit`

Fitur sama dengan tambah berita, plus:
- Preview gambar yang sudah ada
- Opsi untuk mengganti atau mempertahankan gambar lama

#### Hapus Berita
Aksi penghapusan dengan konfirmasi, otomatis menghapus file gambar jika ada.

---

### 3. Kelola Perangkat Desa (CRUD)

#### Daftar Perangkat
**URL**: `/admin/perangkat`

Fitur:
- ✅ Lihat semua perangkat dengan pagination
- ✅ Lihat foto profil thumbnail
- ✅ Edit atau hapus perangkat
- ✅ Filter berdasarkan jabatan

#### Tambah Perangkat
**URL**: `/admin/perangkat/create`

Form fields:
- **Nama Lengkap** (required)
- **Jabatan** (required, pilihan):
  - Kepala Desa
  - Sekretaris Desa
  - Kepala Dusun Kemendung
  - Bendahara Desa
  - Perangkat Desa Lainnya
- **Dusun** (optional, contoh: Kemendung)
- **NIP** (optional, Nomor Induk Pegawai)
- **No. KTP** (optional)
- **Foto Profil** (optional, max 2MB)

#### Edit Perangkat
**URL**: `/admin/perangkat/{id}/edit`

Sama dengan tambah, plus preview foto.

#### Hapus Perangkat
Penghapusan dengan konfirmasi, otomatis hapus file foto.

---

### 4. Kelola Statistik Desa

#### Edit Statistik
**URL**: `/admin/statistik`

Form fields:
- **Penduduk Laki-laki** (required, angka)
- **Penduduk Perempuan** (required, angka)
- **Kepala Keluarga (KK)** (required, angka)
- **Luas Wilayah** (required, km², decimal)
- **Jumlah Dusun** (required, angka)

Fitur tambahan:
- **Live Calculation**: 
  - Total Penduduk (auto-calculate)
  - Persentase Laki-laki (auto-calculate)
  - Persentase Perempuan (auto-calculate)
  - Rata-rata per KK (auto-calculate)
  - Kepadatan Penduduk per km² (auto-calculate)

> Nilai statistik ini akan ditampilkan di homepage dan halaman statistik website.

---

## Alur Penggunaan

### Contoh: Menambah Berita Baru

1. Login ke admin panel: `http://localhost:8000/admin/login`
2. Masukkan username: `admin`, password: `admin123`
3. Klik menu "Berita" di sidebar
4. Klik tombol "+ Tambah Berita"
5. Isi form:
   - Judul: "Rapat Desa Rutin Bulan Februari"
   - Deskripsi: "Ringkasan rapat koordinasi..."
   - Konten: "Isi lengkap berita..."
   - Kategori: "Pemerintahan"
   - Penulis: "Sekretaris Desa"
   - Upload gambar (optional)
   - Centang "Publikasikan Sekarang"
6. Klik "Simpan"
7. Berita langsung muncul di halaman berita publik

### Contoh: Update Statistik

1. Login ke admin panel
2. Klik menu "Statistik" di sidebar
3. Update data (misal: penduduk laki bertambah 10 orang)
4. Lihat live calculation otomatis
5. Klik "Simpan Perubahan"
6. Data statistik di homepage akan update otomatis

---

## File Upload & Storage

### Lokasi Penyimpanan
- **Berita Gambar**: `public/storage/`
- **Perangkat Foto**: `public/storage/`

### Struktur Direktori
```
public/
├── storage/
│   ├── kades.jpg
│   ├── sekdes.jpg
│   ├── kasun-kemendung.jpg
│   ├── bendahara.jpg
│   └── berita-[timestamp].jpg
├── css/
│   └── style.css
├── js/
│   └── script.js
└── index.php
```

### Pembersihan File Lama
- File otomatis dihapus saat:
  1. Mengganti foto/gambar dengan upload baru
  2. Menghapus berita atau perangkat

---

## Fitur Keamanan

### Authentication
- Session-based authentication
- Redirect otomatis ke login jika session expired
- Logout dengan clear session

### Validasi Data
- Input validation pada semua form
- File type validation (hanya image files)
- File size limit (max 2MB per file)
- Max text length validation

### Proteksi CSRF
- Token CSRF otomatis di semua form
- Implementasi Laravel built-in CSRF protection

---

## Troubleshooting

### Problem: Tidak bisa upload file
**Solusi**:
1. Pastikan folder `public/storage` sudah ada dan writable
2. Jalankan: `php artisan storage:link`
3. Cek ukuran file (max 2MB)
4. Cek format file (JPG, PNG)

### Problem: Session expired
**Solusi**:
1. Login kembali dengan username dan password
2. Session akan refresh otomatis

### Problem: Berita/Perangkat tidak muncul di website
**Solusi**:
1. Pastikan status "Dipublikasikan" sudah dicentang
2. Cek di halaman berita/perangkat publik
3. Refresh halaman browser

---

## Best Practices

### Pengelolaan Berita
1. ✅ Gunakan judul yang deskriptif dan jelas
2. ✅ Berikan deskripsi singkat untuk preview
3. ✅ Gunakan format HTML atau plain text yang rapi di konten
4. ✅ Selalu kategorisasi berita dengan tepat
5. ✅ Upload gambar berkualitas (lebar min 800px)

### Pengelolaan Perangkat
1. ✅ Pastikan nama lengkap terisi dengan benar
2. ✅ Gunakan jabatan yang konsisten
3. ✅ Lengkapi NIP untuk aparatur sipil negara
4. ✅ Upload foto profesional/formal

### Pengelolaan Statistik
1. ✅ Update statistik secara berkala (minimal setiap 6 bulan)
2. ✅ Validasi data dengan data dari pemerintah kecamatan
3. ✅ Catat tanggal update terakhir

---

## Kontak & Support

Untuk pertanyaan atau masalah teknis terkait admin panel, hubungi:
- **Kantor Desa Jatirejo**: +62-xxx-xxx-xxxx
- **Email**: desa.jatirejo@gmail.com

---

**Terakhir diupdate**: 3 Februari 2026
**Versi**: 1.0
**Status**: ✅ Operasional
