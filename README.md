# 🏘️ Website Desa Jatirejo - Dusun Kemendung

## Tentang Website

**Website Desa Jatirejo** adalah aplikasi web modern yang dirancang khusus untuk Desa Jatirejo, Kecamatan Tikung, Kabupaten Lamongan. Website ini berfokus pada Dusun Kemendung dan menyediakan informasi lengkap tentang desa, berita terkini, dan data perangkat desa.

---

## 🎯 Fitur Utama

### Website Publik
- ✅ **Homepage** - Statistik desa, berita terbaru, perangkat desa, transparansi anggaran
- ✅ **Berita** - Daftar lengkap berita dengan kategori dan pencarian
- ✅ **Detail Berita** - Membaca artikel lengkap dengan saran berita terkait
- ✅ **Perangkat Desa** - Direktori lengkap perangkat desa dengan foto dan jabatan
- ✅ **Statistik** - Data demografis dengan visualisasi chart interaktif
- ✅ **Layanan Surat-Menyurat** - Modal informasi layanan desa

### Admin Panel
- 🔐 **Login** - Autentikasi admin dengan session-based
- 📊 **Dashboard** - Ringkasan statistik berita dan perangkat
- 📰 **CRUD Berita** - Tambah, edit, hapus berita dengan upload gambar
- 👥 **CRUD Perangkat** - Kelola data perangkat dengan foto profil
- 📈 **Edit Statistik** - Update data demografis dengan live calculation
- 🔒 **Proteksi Admin** - Middleware untuk melindungi akses admin

---

## 🛠️ Teknologi

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 12.x | Framework Web |
| **PHP** | 8.2+ | Server-side Language |
| **MySQL** | 5.7+ | Database |
| **Bootstrap** | 5.3.0 | CSS Framework |
| **Chart.js** | 3.9.1 | Visualisasi Data |
| **Font Awesome** | 6.4.0 | Icon Library |

---

## 📁 Struktur Direktori

```
jatirejo-desa/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php          (Public pages)
│   │   │   └── Admin/
│   │   │       ├── AdminAuthController.php
│   │   │       ├── AdminDashboardController.php
│   │   │       ├── AdminBeritaController.php
│   │   │       ├── AdminPerangkatController.php
│   │   │       └── AdminStatistikController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── Berita.php
│       ├── Perangkat.php
│       └── Statistik.php
│
├── database/
│   ├── migrations/
│   │   ├── 2026_02_03_053616_create_beritas_table.php
│   │   ├── 2026_02_03_054949_create_perangkats_table.php
│   │   └── 2026_02_03_054958_create_statistiks_table.php
│   └── seeders/
│       └── DesaSeeder.php
│
├── resources/views/
│   ├── admin/
│   │   ├── login.blade.php
│   │   ├── layout.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── berita/ (index, create, edit)
│   │   ├── perangkat/ (index, create, edit)
│   │   └── statistik/ (edit)
│   ├── layouts/
│   │   └── app.blade.php
│   └── (public pages: index, berita, perangkat, statistik)
│
├── routes/
│   └── web.php
│
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── storage/
│       └── (gambar & foto)
│
├── Documentation/
│   ├── README.md (this file)
│   ├── ADMIN_PANEL_GUIDE.md
│   ├── ADMIN_QUICK_REFERENCE.md
│   ├── ADMIN_UPDATE_SUMMARY.md
│   ├── INSTALLATION_SUMMARY.md
│   ├── DATABASE_API_DOCS.md
│   └── QUICK_START.md
│
└── .env (environment configuration)
```

---

## 🚀 Instalasi & Setup

### Persyaratan
- PHP 8.2 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- XAMPP atau sejenisnya

### Langkah Instalasi

1. **Clone/Copy Project**
   ```bash
   cd c:\xampp\htdocs\kartar
   ```

2. **Install Dependencies**
   ```bash
   cd jatirejo-desa
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   # Edit .env sesuai konfigurasi database
   php artisan key:generate
   ```

4. **Database Setup**
   ```bash
   # Buat database MySQL
   mysql -u root -e "CREATE DATABASE jatirejo_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   
   # Jalankan migrations
   php artisan migrate
   
   # Jalankan seeding
   php artisan db:seed
   ```

5. **Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Server**
   ```bash
   php artisan serve --host=localhost --port=8000
   ```

---

## 📊 Database Schema

### Tabel: `beritas`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| judul | VARCHAR(255) | Judul berita |
| slug | VARCHAR(255) | URL slug (unique) |
| deskripsi | TEXT | Deskripsi singkat |
| konten | LONGTEXT | Konten lengkap |
| kategori | VARCHAR(255) | Kategori berita |
| gambar | VARCHAR(255) | Path gambar |
| penulis | VARCHAR(255) | Nama penulis |
| dipublikasikan | BOOLEAN | Status publikasi |
| timestamps | - | created_at, updated_at |

### Tabel: `perangkats`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| nama | VARCHAR(255) | Nama lengkap |
| jabatan | VARCHAR(255) | Jabatan/posisi |
| dusun | VARCHAR(255) | Dusun (nullable) |
| foto | VARCHAR(255) | Path foto (nullable) |
| nip | VARCHAR(255) | NIP (nullable) |
| no_ktp | VARCHAR(255) | No. KTP (nullable) |
| timestamps | - | created_at, updated_at |

### Tabel: `statistiks`
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT | Primary key |
| penduduk_laki | INT | Jumlah laki-laki |
| penduduk_perempuan | INT | Jumlah perempuan |
| kepala_keluarga | INT | Jumlah KK |
| luas_wilayah | DECIMAL(10,2) | Luas dalam km² |
| jumlah_dusun | INT | Jumlah dusun |
| timestamps | - | created_at, updated_at |

---

## 🔐 Admin Panel

### Akses Admin
```
URL: http://localhost:8000/admin
Username: admin@jatirejo.desa.id
Password: admin123
```

## 🔐 Kartar Panel

### Akses Admin
```
URL: http://localhost:8000/admin
Username: kartar@jatirejo.desa.id
Password: kartar123
```

### Fitur Admin
1. **Dashboard** - Statistik overview
2. **Berita Management** - Create, Read, Update, Delete
3. **Perangkat Management** - Create, Read, Update, Delete
4. **Statistik Management** - Edit demografis desa

Baca **ADMIN_PANEL_GUIDE.md** untuk dokumentasi lengkap.

### Fitur Kartar
1. **Kartar Anggota** - Manajemen Anggota Karang Taruna
2. **Kartar Kegiatan** - Publish & Edit Kegiatan Karang Taruna

---

## 📄 Data Saat Ini

### Statistik Desa
- **Total Penduduk**: 1,370 orang
  - Laki-laki: 650 orang
  - Perempuan: 720 orang
- **Kepala Keluarga**: 280 KK
- **Luas Wilayah**: 2.85 km²
- **Jumlah Dusun**: 1 (Kemendung)

### Perangkat Desa (6 orang)
1. Suwarto, S.E. - Kepala Desa
2. Tri Budi Santoso - Sekretaris Desa
3. Imam Santoso - Kepala Dusun Kemendung
4. Dwi Retno Sari - Bendahara Desa
5. Siti Nurhaliza - Perangkat Desa
6. Haris Suryanto - Perangkat Desa

### Berita (6 artikel)
- Musrenbangdes Tahun 2026
- Program Pemberdayaan PKK
- Gotong Royong Karang Taruna
- Bantuan Dana Infrastruktur
- Pelatihan Elektronik
- Layanan Surat-Menyurat

---

## 🌐 Akses Website

### Halaman Publik
- Homepage: `http://localhost:8000`
- Berita: `http://localhost:8000/berita`
- Perangkat: `http://localhost:8000/perangkat`
- Statistik: `http://localhost:8000/statistik`

### Admin Panel
- Login: `http://localhost:8000/admin/login`
- Dashboard: `http://localhost:8000/admin/dashboard`
- Berita: `http://localhost:8000/admin/berita`
- Perangkat: `http://localhost:8000/admin/perangkat`
- Statistik: `http://localhost:8000/admin/statistik`

---

## 📚 Dokumentasi

| File | Konten |
|------|--------|
| **ADMIN_PANEL_GUIDE.md** | Panduan lengkap admin panel |
| **ADMIN_QUICK_REFERENCE.md** | Quick reference admin |
| **ADMIN_UPDATE_SUMMARY.md** | Summary update terbaru |
| **DATABASE_API_DOCS.md** | Schema database dan query |
| **INSTALLATION_SUMMARY.md** | Ringkasan instalasi |
| **QUICK_START.md** | Panduan quick start |

---

## ✅ Checklist

- [x] Project structure setup
- [x] Database design & migration
- [x] Models (Berita, Perangkat, Statistik)
- [x] Controllers (HomeController, AdminControllers)
- [x] Routes (public + admin)
- [x] Views (public pages + admin panels)
- [x] Admin authentication
- [x] CRUD operations
- [x] File upload handling
- [x] Input validation
- [x] CSRF protection
- [x] Database seeding
- [x] CSS styling & responsiveness
- [x] Documentation

---

## 🔒 Keamanan

- ✅ Session-based authentication
- ✅ CSRF token protection
- ✅ File type validation
- ✅ File size limits
- ✅ Input validation & sanitization
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ Responsive middleware protection

---

## 🐛 Troubleshooting

### Server tidak jalan
```bash
# Pastikan di folder project
cd c:\xampp\htdocs\kartar\jatirejo-desa
php artisan serve --host=localhost --port=8000
```

### File tidak bisa diupload
```bash
# Jalankan storage link
php artisan storage:link

# Atau buat folder manual
mkdir public\storage
```

### Database error
```bash
# Reset database
php artisan migrate:fresh --force
php artisan db:seed --force
```

---

## 📞 Kontak & Support

- **Email**: desa.jatirejo@gmail.com
- **Telepon**: +62-xxx-xxx-xxxx
- **Alamat**: Dsn. Kemendung, Ds. Jatirejo, Kec. Tikung, Kab. Lamongan

---

## 📄 Lisensi

Aplikasi ini dikembangkan khusus untuk Desa Jatirejo.

---

**Last Updated**: 3 Februari 2026
**Version**: 2.0 (dengan Admin Panel)
**Status**: ✅ Production Ready
**Framework**: Laravel 11.x


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
