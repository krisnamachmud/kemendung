# 🎯 Quick Reference - Admin Panel

## 🔐 Login

```
URL: http://localhost:8000/admin/login
Username: admin
Password: admin123
```

---

## 📍 Menu Admin

### 1. Dashboard
**Akses**: Klik menu "Home" atau http://localhost:8000/admin/dashboard
- Statistik total berita
- Status publikasi
- Total perangkat
- Data demografis desa

### 2. Berita
**Akses**: Klik menu "Berita"

#### Fitur:
- **Lihat Semua**: Tabel daftar berita dengan pagination
- **Tambah**: Tombol "+ Tambah Berita"
- **Edit**: Tombol edit (⚙️) di setiap row
- **Hapus**: Tombol hapus (🗑️) di setiap row

#### Form Berita:
```
Judul           → Text input (required)
Deskripsi       → Textarea (required)
Konten          → Textarea besar (required)
Kategori        → Dropdown (required)
Penulis         → Text input (required)
Gambar          → File upload (optional, max 2MB)
Publikasikan    → Checkbox (publish atau draft)
```

#### Kategori Tersedia:
- Pemerintahan
- PKK
- Karang Taruna
- Pemberdayaan
- Pelatihan
- Informasi
- Pengumuman

### 3. Perangkat
**Akses**: Klik menu "Perangkat"

#### Fitur:
- **Lihat Semua**: Tabel daftar perangkat dengan foto thumbnail
- **Tambah**: Tombol "+ Tambah Perangkat"
- **Edit**: Edit data dan foto
- **Hapus**: Hapus perangkat

#### Form Perangkat:
```
Nama Lengkap    → Text input (required)
Jabatan         → Dropdown (required)
Dusun           → Text input (optional)
NIP             → Text input (optional)
No. KTP         → Text input (optional)
Foto Profil     → File upload (optional, max 2MB)
```

#### Jabatan Tersedia:
- Kepala Desa
- Sekretaris Desa
- Kepala Dusun Kemendung
- Bendahara Desa
- Perangkat Desa Lainnya

### 4. Statistik
**Akses**: Klik menu "Statistik"

#### Form Statistik:
```
Penduduk Laki-laki      → Number input (required)
Penduduk Perempuan      → Number input (required)
Kepala Keluarga         → Number input (required)
Luas Wilayah (km²)      → Decimal input (required)
Jumlah Dusun            → Number input (required)
```

#### Live Calculation (Auto Update):
- Total Penduduk
- Persentase Laki-laki
- Persentase Perempuan
- Rata-rata per KK
- Kepadatan Penduduk per km²

---

## ⌨️ Shortcut Actions

| Aksi | Tombol | URL |
|------|--------|-----|
| Logout | Tombol "Logout" di top-right | `/admin/logout` |
| Kembali ke Website | Link "Kembali ke Website" | `/` |
| Tambah Berita | "+ Tambah Berita" | `/admin/berita/create` |
| Edit Berita | Icon ✏️ | `/admin/berita/{id}/edit` |
| Hapus Berita | Icon 🗑️ | POST DELETE |
| Tambah Perangkat | "+ Tambah Perangkat" | `/admin/perangkat/create` |
| Edit Perangkat | Icon ✏️ | `/admin/perangkat/{id}/edit` |
| Hapus Perangkat | Icon 🗑️ | POST DELETE |

---

## 📋 Checklist Penggunaan

### Menambah Berita Baru
- [ ] Login ke admin
- [ ] Klik menu "Berita"
- [ ] Klik "+ Tambah Berita"
- [ ] Isi judul, deskripsi, konten
- [ ] Pilih kategori dan penulis
- [ ] Upload gambar (optional)
- [ ] Centang "Publikasikan Sekarang" atau simpan draft
- [ ] Klik "Simpan"

### Menambah Perangkat Baru
- [ ] Login ke admin
- [ ] Klik menu "Perangkat"
- [ ] Klik "+ Tambah Perangkat"
- [ ] Isi nama, pilih jabatan
- [ ] Isi data lengkap (dusun, NIP, KTP)
- [ ] Upload foto (optional)
- [ ] Klik "Simpan"

### Update Statistik
- [ ] Login ke admin
- [ ] Klik menu "Statistik"
- [ ] Update nilai penduduk, KK, luas wilayah
- [ ] Verifikasi live calculation
- [ ] Klik "Simpan Perubahan"

---

## 🚨 Error & Solusi

| Error | Solusi |
|-------|--------|
| "Username atau password salah" | Periksa kembali: admin / admin123 |
| File tidak bisa diupload | Cek ukuran < 2MB dan format JPG/PNG |
| Session expired saat filling form | Ulang login, session 120 menit |
| Data tidak muncul di website publik | Pastikan status "Dipublikasikan" dicentang |
| Foto tidak muncul di website | Jalankan `php artisan storage:link` |

---

## 📱 Responsive

Admin panel responsive di:
- ✅ Desktop (1920px+)
- ✅ Laptop (1366px)
- ✅ Tablet (768px)
- ✅ Mobile (360px)

---

## 🔒 Keamanan

- ✅ Session-based login
- ✅ CSRF token di semua form
- ✅ File type validation
- ✅ File size limit (2MB)
- ✅ Input validation
- ✅ Automatic logout after 120 minutes

---

## 🆘 Butuh Bantuan?

Baca file dokumentasi lengkap:
- **ADMIN_PANEL_GUIDE.md** - Dokumentasi lengkap dengan penjelasan detail
- **ADMIN_UPDATE_SUMMARY.md** - Summary lengkap update yang dilakukan

---

**Last Updated**: 3 Februari 2026
**Version**: 1.0
