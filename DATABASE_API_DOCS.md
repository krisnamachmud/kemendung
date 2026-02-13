# 📚 Database & API Documentation

## 📊 Database Schema

### Database: `jatirejo_desa`
- **Engine**: InnoDB
- **Charset**: utf8mb4
- **Collation**: utf8mb4_unicode_ci

---

## 🗂️ Table Structures

### Table: `beritas`
Menyimpan data berita/artikel desa

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | NO | - | Primary key, auto increment |
| judul | VARCHAR(255) | NO | - | Judul berita |
| slug | VARCHAR(255) | NO | UNIQUE | URL-friendly slug |
| deskripsi | TEXT | YES | NULL | Deskripsi singkat |
| konten | LONGTEXT | NO | - | Konten lengkap |
| kategori | VARCHAR(255) | NO | 'Umum' | Kategori berita |
| gambar | VARCHAR(255) | YES | NULL | Path gambar |
| penulis | VARCHAR(255) | NO | 'Admin' | Nama penulis |
| dipublikasikan | TINYINT(1) | NO | 1 | Status publikasi |
| created_at | TIMESTAMP | YES | NULL | Tanggal dibuat |
| updated_at | TIMESTAMP | YES | NULL | Tanggal diupdate |

**Indexes:**
- PRIMARY KEY: id
- UNIQUE KEY: slug

**Kategori yang tersedia:**
- Pemerintahan
- PKK
- Karang Taruna
- Pemberdayaan
- Pelatihan
- Informasi
- Musrenbangdes

---

### Table: `perangkats`
Menyimpan data perangkat desa

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | NO | - | Primary key, auto increment |
| nama | VARCHAR(255) | NO | - | Nama lengkap |
| jabatan | VARCHAR(255) | NO | - | Jabatan/posisi |
| dusun | VARCHAR(255) | YES | NULL | Nama dusun |
| foto | VARCHAR(255) | YES | NULL | Path foto profil |
| nip | VARCHAR(255) | YES | NULL | Nomor Induk Pegawai |
| no_ktp | VARCHAR(255) | YES | NULL | Nomor KTP |
| created_at | TIMESTAMP | YES | NULL | Tanggal dibuat |
| updated_at | TIMESTAMP | YES | NULL | Tanggal diupdate |

**Indexes:**
- PRIMARY KEY: id

**Jabatan yang tersedia:**
- Kepala Desa
- Sekretaris Desa
- Kepala Dusun
- Bendahara Desa
- Perangkat Desa

**Dusun:**
- Kemendung
- Karangtengah
- Sumorejo

---

### Table: `statistiks`
Menyimpan data statistik demografis desa

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | NO | - | Primary key, auto increment |
| penduduk_laki | INT | NO | 0 | Jumlah penduduk laki-laki |
| penduduk_perempuan | INT | NO | 0 | Jumlah penduduk perempuan |
| kepala_keluarga | INT | NO | 0 | Jumlah kepala keluarga |
| luas_wilayah | DECIMAL(10,2) | NO | 0 | Luas wilayah dalam km² |
| jumlah_dusun | INT | NO | 0 | Jumlah dusun |
| created_at | TIMESTAMP | YES | NULL | Tanggal dibuat |
| updated_at | TIMESTAMP | YES | NULL | Tanggal diupdate |

**Indexes:**
- PRIMARY KEY: id

---

## 🔗 Relationships

### Berita Model
```php
// Tidak ada relasi langsung (Standalone)
```

### Perangkat Model
```php
// Tidak ada relasi langsung (Standalone)
```

### Statistik Model
```php
// Tidak ada relasi langsung (Standalone)
```

---

## 🚀 API Routes

### Berita Routes

#### GET /berita
Menampilkan daftar berita dengan pagination

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "judul": "Musrenbangdes Tahun 2026",
            "slug": "musrenbangdes-2026",
            "deskripsi": "...",
            "kategori": "Pemerintahan",
            "penulis": "Admin",
            "created_at": "2026-02-03T10:00:00Z"
        }
    ],
    "pagination": {
        "total": 6,
        "per_page": 10,
        "current_page": 1,
        "last_page": 1
    }
}
```

#### GET /berita/{slug}
Menampilkan detail berita dengan berita terkait

**Response:**
```json
{
    "berita": {
        "id": 1,
        "judul": "...",
        "konten": "...",
        "gambar": "...",
        "created_at": "..."
    },
    "berita_terkait": [...]
}
```

---

### Perangkat Routes

#### GET /perangkat
Menampilkan daftar perangkat desa

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "nama": "Suwarto, S.E.",
            "jabatan": "Kepala Desa",
            "dusun": "Kemendung",
            "nip": "19650315 198603 1 004",
            "no_ktp": "3507..."
        }
    ]
}
```

---

### Statistik Routes

#### GET /statistik
Menampilkan statistik desa lengkap

**Response:**
```json
{
    "statistik": {
        "penduduk_laki": 1250,
        "penduduk_perempuan": 1280,
        "kepala_keluarga": 520,
        "luas_wilayah": 8.75,
        "jumlah_dusun": 3,
        "total_penduduk": 2530
    }
}
```

---

## 🔍 Query Examples

### SQL Queries

**Semua berita yang dipublikasikan:**
```sql
SELECT * FROM beritas 
WHERE dipublikasikan = 1 
ORDER BY created_at DESC;
```

**Berita per kategori:**
```sql
SELECT * FROM beritas 
WHERE kategori = 'Pemerintahan' 
AND dipublikasikan = 1;
```

**Perangkat berdasarkan jabatan:**
```sql
SELECT * FROM perangkats 
WHERE jabatan = 'Kepala Desa';
```

**Perangkat per dusun:**
```sql
SELECT * FROM perangkats 
WHERE dusun = 'Kemendung' 
ORDER BY jabatan;
```

**Statistik desa:**
```sql
SELECT 
    penduduk_laki + penduduk_perempuan as total_penduduk,
    ROUND((penduduk_laki / (penduduk_laki + penduduk_perempuan)) * 100, 2) as persen_laki,
    ROUND((penduduk_perempuan / (penduduk_laki + penduduk_perempuan)) * 100, 2) as persen_perempuan,
    ROUND((penduduk_laki + penduduk_perempuan) / kepala_keluarga, 2) as rata_rata_per_kk
FROM statistiks
WHERE id = 1;
```

---

## 🧰 Eloquent Examples

### Berita

```php
// Get all published berita
$berita = Berita::where('dipublikasikan', true)
                ->latest()
                ->get();

// Get berita by slug
$berita = Berita::where('slug', 'musrenbangdes-2026')
                ->firstOrFail();

// Get berita by kategori
$berita = Berita::where('kategori', 'Pemerintahan')
                ->where('dipublikasikan', true)
                ->paginate(10);

// Create berita
Berita::create([
    'judul' => 'Judul Berita',
    'slug' => 'slug-berita',
    'deskripsi' => 'Deskripsi',
    'konten' => 'Konten lengkap',
    'kategori' => 'Pemerintahan',
    'penulis' => 'Admin',
    'dipublikasikan' => true,
]);

// Update berita
$berita->update(['judul' => 'Judul Baru']);

// Delete berita
$berita->delete();
```

### Perangkat

```php
// Get all perangkat
$perangkat = Perangkat::all();

// Get perangkat by dusun
$perangkat = Perangkat::where('dusun', 'Kemendung')->get();

// Get kepala desa
$kepaladesa = Perangkat::where('jabatan', 'Kepala Desa')
                       ->first();

// Get perangkat per dusun dengan urutan jabatan
$perangkat = Perangkat::orderBy('dusun')
                      ->orderBy('jabatan')
                      ->get();
```

### Statistik

```php
// Get statistik
$stats = Statistik::first();

// Get total penduduk
$total = $stats->penduduk_laki + $stats->penduduk_perempuan;

// Get rasio L/P
$rasio_laki = ($stats->penduduk_laki / $total) * 100;

// Update statistik
$stats->update([
    'penduduk_laki' => 1300,
    'penduduk_perempuan' => 1300,
]);
```

---

## 📈 Data Backup

### Export Database

```bash
# Menggunakan mysqldump
mysqldump -u root jatirejo_desa > backup_jatirejo.sql

# Restore database
mysql -u root jatirejo_desa < backup_jatirejo.sql
```

### Backup via Laravel

```bash
# Backup database
php artisan db:backup

# Restore dari backup
php artisan db:restore
```

---

## 🔐 Data Validation

### Berita Validation Rules
```php
[
    'judul' => 'required|string|max:255',
    'slug' => 'required|string|unique:beritas|max:255',
    'deskripsi' => 'nullable|string',
    'konten' => 'required|string',
    'kategori' => 'required|string|max:255',
    'gambar' => 'nullable|image|max:2048',
    'penulis' => 'required|string|max:255',
    'dipublikasikan' => 'boolean',
]
```

### Perangkat Validation Rules
```php
[
    'nama' => 'required|string|max:255',
    'jabatan' => 'required|string|max:255',
    'dusun' => 'nullable|string|max:255',
    'foto' => 'nullable|image|max:2048',
    'nip' => 'nullable|string|max:255',
    'no_ktp' => 'nullable|string|max:255',
]
```

---

## 📝 Data Entry Templates

### Berita Template
```php
[
    'judul' => 'Judul Berita',
    'slug' => 'judul-berita',
    'deskripsi' => 'Deskripsi singkat untuk preview',
    'konten' => 'Konten lengkap artikel...',
    'kategori' => 'Pemerintahan', // atau kategori lain
    'gambar' => 'path/to/image.jpg', // optional
    'penulis' => 'Nama Penulis',
    'dipublikasikan' => true,
]
```

### Perangkat Template
```php
[
    'nama' => 'Nama Lengkap',
    'jabatan' => 'Jabatan',
    'dusun' => 'Nama Dusun',
    'nip' => '1965031519860301004',
    'no_ktp' => '3507171234567890',
    'foto' => 'path/to/photo.jpg', // optional
]
```

---

**Last Updated**: 3 Februari 2026
**Documentation Version**: 1.0
**Status**: ✅ Complete
