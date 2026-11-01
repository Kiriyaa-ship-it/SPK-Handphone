# Sistem Pendukung Keputusan Pemilihan Handphone

Aplikasi web berbasis PHP untuk membantu pengguna memilih handphone terbaik sesuai kebutuhan dan budget menggunakan metode **Simple Additive Weighting (SAW)**.

## Tech Stack

- **Backend:** PHP Native (8.x+)
- **Database:** MySQL/MariaDB
- **Frontend:** HTML5, CSS3, JavaScript
- **Database Access:** PDO (PHP Data Objects)
- **Server:** Apache (XAMPP)
- **Architecture:** MVC (Model-View-Controller)

## Fitur

### Fitur Pengguna
- Pencarian rekomendasi handphone berdasarkan budget dan profil kebutuhan
- Hasil ranking menggunakan metode SAW dengan transparansi perhitungan
- Tiga profil kebutuhan: Gaming, Fotografi, Penggunaan Harian
- Tampilan responsive (desktop & mobile)
- Gambar handphone dengan placeholder otomatis

### Fitur Admin
- Login dengan password hashing (bcrypt)
- Dashboard statistik
- Tambah handphone dengan upload gambar
- Edit data handphone
- Hapus handphone
- CSRF protection
- SQL injection prevention

## Instalasi

### 1. Persyaratan Sistem

- XAMPP (PHP 8.x, MySQL, Apache)
- Browser modern (Chrome, Firefox, Edge)

### 2. Setup Database

**A. Buat Database**

Buka phpMyAdmin (http://localhost/phpmyadmin):

```sql
CREATE DATABASE spk_handphone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**B. Import Migration**

Pilih database spk_handphone, lalu import file:

1. database/migrations/001_create_tables.sql
2. database/migrations/002_create_admins_table.sql

**C. Import Data Seed (Opsional)**

- database/seeds/001_seed_criterias.sql
- database/seeds/002_seed_profiles.sql
- database/seeds/003_seed_handphones.sql

### 3. Konfigurasi

Cek app/config/database.php:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'spk_handphone');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 4. Jalankan Aplikasi

1. Start XAMPP: Apache + MySQL
2. Buka: http://localhost/SPK-Handphone/public/

## Kredensial Default

### Admin Panel

- **URL:** http://localhost/SPK-Handphone/public/admin/login
- **Username:** admin
- **Password:** admin123

**PENTING:** Ganti password default setelah login pertama!

## Panduan Penggunaan

### Untuk Pengguna Biasa

1. Buka halaman utama
2. Klik "Mulai Cari Rekomendasi"
3. Masukkan budget (contoh: 5000000)
4. Pilih profil kebutuhan
5. Klik "Hitung Rekomendasi"
6. Lihat hasil ranking top 5

### Untuk Admin

**Tambah Handphone:**
1. Login ke admin panel
2. Klik "Data Handphone" → "Tambah Handphone"
3. Isi form lengkap
4. Upload gambar (JPG/PNG, max 2MB)
5. Klik "Simpan"

**Edit/Hapus:**
- Gunakan tombol Edit/Hapus di list handphone

## Struktur Project

```
SPK-Handphone/
├── app/
│   ├── config/          # Konfigurasi database
│   ├── controllers/     # Controller (MVC)
│   ├── models/          # Model (MVC)
│   ├── services/        # Business logic (SAW)
│   └── helpers/         # Helper functions
├── database/
│   ├── migrations/      # Schema database
│   └── seeds/           # Data awal
├── docs/                # Dokumentasi teknis
├── public/              # Web root
│   ├── css/            # Stylesheets
│   ├── images/         # Assets & uploads
│   └── index.php       # Entry point
└── views/               # View templates (MVC)
```

## Keamanan

- Password hashing dengan bcrypt
- CSRF token protection
- Prepared statements (SQL injection proof)
- Input sanitization
- File upload validation
- Session-based authentication

## Troubleshooting

### Error: "Can't connect to MySQL"
- Pastikan MySQL di XAMPP sudah running
- Cek kredensial di app/config/database.php

### Upload gambar gagal
- Cek folder public/images/handphones/ writable
- Pastikan ukuran < 2MB, format JPG/PNG

### Login admin gagal
- Password default: admin123 (case-sensitive)
- Cek tabel admins sudah ada

## Dokumentasi Lengkap

- docs/SAW_METHODOLOGY.md
- docs/DATABASE_DESIGN.md
- docs/PANDUAN_PENGGUNA.md

---

**Dibuat dengan PHP Native & Metode SAW**
