# 📊 ALGORITMA STRUKTUR WEB - Jatirejo Desa

## 🔄 Alur Umum Aplikasi

```
USER INPUT → ROUTING → CONTROLLER → MODEL → DATABASE
                ↓                              ↓
            MIDDLEWARE              BUSINESS LOGIC
                ↓
            VALIDASI
                ↓
            VIEW (Template)
                ↓
            HTML RESPONSE
```

---

## 📱 FLOWCHART SISTEM

### 1️⃣ PUBLIC SECTION (Halaman Umum)

```
PENGUNJUNG
    ↓
├─→ [HOME] (/)
│   ├─ Display: Artikel terbaru, statistik desa
│   └─ Controller: HomeController@index
│
├─→ [BERITA] (/berita)
│   ├─ Display: List semua berita
│   ├─ Pagination: 10 per halaman
│   └─ Controller: HomeController@berita
│   
├─→ [DETAIL BERITA] (/berita/{slug})
│   ├─ Display: Artikel lengkap + nama penulis + tanggal
│   ├─ Query: WHERE slug = {slug}
│   └─ Controller: HomeController@beritaDetail
│
├─→ [PERANGKAT] (/perangkat)
│   ├─ Display: List perangkat desa (kepala desa, aparatur)
│   └─ Controller: HomeController@perangkat
│
└─→ [STATISTIK] (/statistik)
    ├─ Display: Chart & tabel statistik desa
    └─ Controller: HomeController@statistik
```

---

### 2️⃣ ADMIN SECTION (Kelola Data)

```
ADMIN LOGIN
    ↓
[/admin/login] → POST /admin/login
    ↓
VALIDASI CREDENTIALS (Username + Password)
    ↓
├─ VALID → Set Session → Redirect /admin/dashboard
└─ INVALID → Tampilkan Error

    ↓

[PROTECTED ROUTES - Middleware 'admin']
    ↓
├─→ [DASHBOARD] (/admin/dashboard)
│   ├─ Display: Total berita, perangkat, statistik
│   └─ Controller: AdminDashboardController@index
│
├─→ [BERITA MANAGEMENT] (/admin/berita)
│   ├─ GET /admin/berita → LIST (DataTable)
│   ├─ GET /admin/berita/create → FORM CREATE
│   ├─ POST /admin/berita → SAVE to DB
│   ├─ GET /admin/berita/{id}/edit → FORM EDIT
│   ├─ PUT /admin/berita/{id} → UPDATE DB
│   └─ DELETE /admin/berita/{id} → DELETE from DB
│
├─→ [PERANGKAT MANAGEMENT] (/admin/perangkat)
│   ├─ GET /admin/perangkat → LIST
│   ├─ GET /admin/perangkat/create → FORM
│   ├─ POST /admin/perangkat → SAVE
│   ├─ GET /admin/perangkat/{id}/edit → FORM
│   ├─ PUT /admin/perangkat/{id} → UPDATE
│   └─ DELETE /admin/perangkat/{id} → DELETE
│
└─→ [STATISTIK MANAGEMENT] (/admin/statistik)
    ├─ GET /admin/statistik → FORM EDIT
    └─ PUT /admin/statistik → UPDATE

    ↓

LOGOUT (/admin/logout)
    → Destroy Session → Redirect Home
```

---

## 🗂️ STRUKTUR DATA (Models)

### Model Berita
```
ID (Primary Key)
├─ judul
├─ slug (untuk URL)
├─ content
├─ penulis
├─ tanggal_publish
├─ updated_at
└─ created_at
```

### Model Perangkat
```
ID (Primary Key)
├─ nama
├─ jabatan
├─ foto
├─ kontak
├─ alamat
└─ created_at
```

### Model Statistik
```
ID (Primary Key)
├─ kategori (contoh: "Penduduk", "Keluarga")
├─ jumlah
├─ tahun
└─ updated_at
```

### Model User
```
ID (Primary Key)
├─ name
├─ email (UNIQUE)
├─ password (HASHED)
├─ role (admin/user)
└─ created_at
```

---

## 🔐 MIDDLEWARE SECURITY

```
REQUEST
    ↓
[MIDDLEWARE 'admin']
    ↓
├─ Cek: Apakah user sudah login?
│   ├─ YA → Lanjut ke Controller
│   └─ TIDAK → Redirect ke /admin/login
│
├─ Cek: Apakah user adalah ADMIN?
│   ├─ YA → Lanjut ke Controller
│   └─ TIDAK → Tampilkan 403 (Unauthorized)
│
└─ Lanjut ke CONTROLLER
```

---

## 📊 ALGORITMA PROSES DATA

### A. Algoritma GET LIST (Berita)

```
FUNCTION getBeritaList()
    1. QUERY: SELECT * FROM beritas ORDER BY created_at DESC
    2. PAGINATE: ambil 10 data per halaman
    3. FOREACH data AS berita
       - Extract slug dari judul
       - Hitung hari sejak publikasi
       - Ambil nama penulis dari users table
    END FOREACH
    4. RETURN data + pagination info
END FUNCTION
```

### B. Algoritma SEARCH/FILTER

```
FUNCTION searchBerita(keyword)
    1. TRIM input ke huruf alfanumerik
    2. QUERY: SELECT * FROM beritas 
              WHERE judul LIKE "%keyword%"
              OR content LIKE "%keyword%"
    3. ORDER BY relevance (judul match dulu)
    4. RETURN hasil pencarian
END FUNCTION
```

### C. Algoritma CREATE DATA

```
FUNCTION createBerita(input)
    1. VALIDASI:
       - judul: required, min 5 karakter
       - content: required, min 20 karakter
       - penulis: required
       - tanggal: required, format yyyy-mm-dd
    
    2. IF validasi GAGAL:
       - RETURN error messages
    END IF
    
    3. GENERATE slug:
       - slug = strtolower(judul)
       - slug = replace spasi dengan "-"
       - slug = remove special characters
    
    4. INSERT ke database:
       - $berita = Berita::create([
           'judul' => input['judul'],
           'slug' => slug,
           'content' => input['content'],
           'penulis' => input['penulis'],
           'tanggal_publish' => input['tanggal']
         ])
    
    5. IF insert SUCCESS:
       - RETURN berita + success message
    ELSE
       - RETURN error message
    END IF
END FUNCTION
```

### D. Algoritma UPDATE DATA

```
FUNCTION updateBerita(id, input)
    1. FIND: $berita = Berita::findOrFail(id)
    
    2. IF tidak ketemu:
       - RETURN 404 error
    END IF
    
    3. VALIDASI input (sama seperti CREATE)
    
    4. IF validasi GAGAL:
       - RETURN error messages
    END IF
    
    5. UPDATE:
       - $berita->update([...input])
    
    6. IF update SUCCESS:
       - RETURN berita + success message
    ELSE
       - RETURN error message
    END IF
END FUNCTION
```

### E. Algoritma DELETE DATA

```
FUNCTION deleteBerita(id)
    1. FIND: $berita = Berita::findOrFail(id)
    
    2. IF tidak ketemu:
       - RETURN 404 error
    END IF
    
    3. DELETE:
       - $berita->delete()
    
    4. IF delete SUCCESS:
       - RETURN success message
    ELSE
       - RETURN error message
    END IF
END FUNCTION
```

---

## 🔑 ALGORITMA LOGIN

```
FUNCTION adminLogin(email, password)
    1. TRIM email & password
    
    2. VALIDASI:
       - email: required, valid format
       - password: required, min 6 karakter
    
    3. IF validasi GAGAL:
       - RETURN error messages
    END IF
    
    4. QUERY: user = User::WHERE email = email AND role = 'admin'
    
    5. IF user tidak ketemu:
       - RETURN "Email atau password salah"
    END IF
    
    6. VERIFY password:
       - IF Hash::check(password, user.password) == FALSE:
         - RETURN "Email atau password salah"
       END IF
    
    7. SET SESSION:
       - Session['user_id'] = user.id
       - Session['username'] = user.name
       - Session['role'] = user.role
    
    8. REDIRECT ke /admin/dashboard
END FUNCTION
```

---

## 📈 ALGORITMA STATISTIK

```
FUNCTION getStatistik()
    1. QUERY: SELECT * FROM statistiks ORDER BY kategori ASC
    
    2. FOREACH data AS stat
       - Hitung persentase perubahan
       - Format angka dengan separator (1000 → 1.000)
       - Tentukan trend: naik/turun/stabil
    END FOREACH
    
    3. PREPARE chart data:
       - labels: [kategori1, kategori2, ...]
       - values: [jumlah1, jumlah2, ...]
    
    4. RETURN chart data + tabel data
END FUNCTION
```

---

## 🌐 RESPONSE STRUCTURE

### Success Response (GET)
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "judul": "Berita Terbaru",
    "slug": "berita-terbaru",
    "content": "...",
    "created_at": "2026-02-10"
  }
}
```

### Error Response
```json
{
  "status": "error",
  "message": "Validasi gagal",
  "errors": {
    "judul": ["Judul harus diisi"],
    "content": ["Konten minimal 20 karakter"]
  }
}
```

---

## 📋 PSEUDOCODE LENGKAP

```
START APPLICATION

LOOP:
  → REQUEST masuk
  → ROUTE matching
  → MIDDLEWARE check
  
  IF middleware valid:
    → CALL Controller method
    → VALIDASI input
    
    IF validasi sukses:
      → QUERY database
      → PROCESS data
      → RETURN response
    ELSE:
      → RETURN error response
    END IF
  ELSE:
    → RETURN 403/401 error
  END IF
  
  → RENDER view (blade template)
  → SEND HTTP response ke client
  
END LOOP

WHEN user logout:
  → DESTROY session
  → REDIRECT ke home

END APPLICATION
```

---

## 🎯 SUMMARY - Request Cycle

```
1. CLIENT mengirim REQUEST (GET/POST/PUT/DELETE)
2. LARAVEL ROUTING mencocokkan URL
3. MIDDLEWARE memvalidasi (security check)
4. CONTROLLER menerima request
5. VALIDASI data input
6. MODEL query database
7. PROCESSING data (filter, sort, calculate)
8. RETURN data ke CONTROLLER
9. CONTROLLER pass ke VIEW
10. VIEW render template (Blade)
11. HTML dikirim ke CLIENT
12. BROWSER display halaman
```

---

## 🛠️ TOOLS & TEKNOLOGI

| Layer | Tool | Teknologi |
|-------|------|-----------|
| **Frontend** | HTML/CSS/JS | Bootstrap 5, AOS Animation |
| **Backend** | PHP | Laravel 11 |
| **Database** | MySQL | SQL Queries |
| **Server** | Apache | XAMPP |
| **Assets** | Vite.js | CSS/JS compilation |

---

Algoritma di atas menggambarkan seluruh struktur dan alur data aplikasi Jatirejo Desa.
