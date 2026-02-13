## 🚀 QUICK START GUIDE - Website Desa Jatirejo

### ⚡ Cara Cepat Mulai

#### 1️⃣ Pastikan MySQL Berjalan
- Buka XAMPP Control Panel
- Klik "Start" untuk **Apache** dan **MySQL**
- ✅ Pastikan keduanya berwarna hijau

#### 2️⃣ Buka Terminal/Command Prompt
```bash
# Navigasi ke folder project
cd c:\xampp\htdocs\kartar\jatirejo-desa
```

#### 3️⃣ Jalankan Development Server
```bash
php artisan serve --host=localhost --port=8000
```

#### 4️⃣ Buka Browser
```
http://localhost:8000
```

---

### 🎯 Halaman yang Tersedia

| Halaman | URL | Keterangan |
|---------|-----|-----------|
| 🏠 Beranda | http://localhost:8000 | Halaman utama |
| 📰 Berita | http://localhost:8000/berita | Daftar berita |
| 👥 Perangkat | http://localhost:8000/perangkat | Struktur organisasi |
| 📊 Statistik | http://localhost:8000/statistik | Data demografis |

---

### 📋 Content yang Sudah Ada

**6 Berita:**
1. Musrenbangdes Tahun 2026
2. Program PKK Kesehatan & Gizi
3. Karang Taruna Gotong Royong
4. Bantuan Dana Infrastruktur
5. Pelatihan Keterampilan Elektronik
6. Layanan Surat-Menyurat

**6 Perangkat Desa:**
1. Suwarto, S.E. (Kepala Desa)
2. Tri Budi Santoso (Sekretaris Desa)
3. Imam Santoso (Kepala Dusun Kemendung)
4. Bambang Wijaya (Kepala Dusun Karangtengah)
5. Sutrisno (Kepala Dusun Sumorejo)
6. Dwi Retno Sari (Bendahara Desa)

**Statistik Desa:**
- Penduduk: 2,530 (L: 1,250 | P: 1,280)
- Kepala Keluarga: 520
- Luas Wilayah: 8.75 km²
- Jumlah Dusun: 3

---

### 🔨 Konfigurasi Penting

**File: .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jatirejo_desa
DB_USERNAME=root
DB_PASSWORD=
```

**Warna Theme (public/css/style.css):**
```css
--primary-color: #1a5f4a
--secondary-color: #2d7d63
--accent-color: #f39c12
```

---

### 🛠️ Perintah Penting

```bash
# Database
php artisan migrate                # Jalankan migration
php artisan db:seed               # Seed data awal
php artisan migrate:fresh --seed  # Reset & seed ulang

# Cache
php artisan cache:clear           # Clear cache
php artisan config:clear          # Clear config
php artisan view:clear            # Clear views

# Development
php artisan serve                 # Run server (port 8000)
php artisan serve --port=3000     # Custom port

# Tinker (Interactive shell)
php artisan tinker                # Open tinker console
```

---

### 📁 Folder Penting

- `app/Http/Controllers/` - Logic aplikasi
- `resources/views/` - Template HTML
- `public/css/` - Styling CSS
- `public/js/` - JavaScript
- `database/seeders/` - Data awal

---

### 🐛 Jika Ada Error

1. **Server Error 500**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Database Connection Error**
   - Periksa MySQL di XAMPP
   - Periksa konfigurasi .env

3. **Asset tidak muncul**
   ```bash
   php artisan storage:link
   ```

---

### ✨ Fitur Utama

✅ Responsive Design (Desktop, Tablet, Mobile)
✅ Berita dengan pagination & kategori
✅ Perangkat desa dengan struktur organisasi
✅ Statistik desa dengan chart
✅ Transparansi anggaran (APBDes)
✅ Layanan surat-menyurat online
✅ Share ke media sosial
✅ Google Maps integration
✅ SEO optimized
✅ Security ready

---

### 📞 Informasi Desa

- 📧 Email: admin@jatirejo-desa.id
- 📱 Telepon: (0321) 123-4567
- 📍 Lokasi: Dsn. Kemendung, Ds. Jatirejo, Kec. Tikung, Kab. Lamongan
- ⏰ Jam Kerja: Senin-Jumat 08:00-15:00 WIB

---

**Server Status**: ✅ RUNNING ON http://localhost:8000
**Database**: ✅ jatirejo_desa (MySQL)
**Framework**: ✅ Laravel 11
**Ready to Use**: ✅ YES
