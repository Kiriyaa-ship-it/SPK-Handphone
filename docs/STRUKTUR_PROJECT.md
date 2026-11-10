# STRUKTUR PROJECT SPK-HANDPHONE

**Lokasi Project:** `C:\xampp\htdocs\SPK-Handphone`  
**Tanggal Update:** 10 November 2026  
**Status:** ✅ STRUKTUR SUDAH DIRAPIKAN & VERIFIED

---

## STRUKTUR FOLDER

```
SPK-Handphone/
├── .git/                           # Git repository
├── .gitignore                      # Git ignore rules
├── README.md                       # Dokumentasi utama project
│
├── app/                            # Aplikasi backend
│   ├── config/                     # Konfigurasi aplikasi
│   │   └── database.php           # Koneksi database PDO
│   │
│   ├── controllers/                # Controllers (MVC pattern)
│   │
│   ├── helpers/                    # Helper functions
│   │
│   ├── models/                     # Models untuk database
│   │   ├── Criteria.php           # Model kriteria (C1-C5)
│   │   ├── Handphone.php          # Model handphone
│   │   └── Profile.php            # Model profil kebutuhan user
│   │
│   └── services/                   # Business logic layer
│       └── SawService.php         # Service perhitungan SAW
│
├── database/                       # Database schema & seeds
│   ├── migrations/                 # Database migrations
│   │   ├── 001_create_tables.sql  # Schema database lengkap
│   │   └── 002_create_admins_table.sql # Tabel admin
│   │
│   └── seeds/                      # Data seed untuk testing
│       ├── 001_initial_data.sql   # Data kriteria & profil
│       ├── 002_test_handphones.sql # Data 10 HP testing
│       └── 003_add_10_phones.sql  # Data 10 HP tambahan
│
├── docs/                           # Dokumentasi project
│   ├── AGENTS.md                  # Dokumentasi AI agents
│   ├── CHANGELOG.md               # Riwayat perubahan lengkap
│   ├── DATABASE_DESIGN.md         # Desain database lengkap
│   ├── FASE3_TESTING.md           # Testing admin panel
│   ├── FASE4A_REPORT.md           # Implementasi upload gambar
│   ├── FINALISASI_REPORT.md       # Laporan finalisasi
│   ├── LAPORAN_HASIL_PERSIAPAN_PENGUJIAN.md # Laporan persiapan test
│   ├── PANDUAN_PENGGUNA.md        # Panduan lengkap user & admin
│   ├── PROJECT_BRIEF.md           # Brief project
│   ├── REDESIGN_BLUE_ENHANCED.md  # Redesign blue v2.0
│   ├── REDESIGN_DARK_GAMING.md    # Redesign dark v1.0
│   ├── SAW_METHODOLOGY.md         # Metodologi SAW lengkap
│   ├── STRUKTUR_PROJECT.md        # File ini
│   ├── TESTING_REPORT.md          # Panduan pengujian
│   └── jobdesk_kelompok.md        # Pembagian tugas tim
│
├── public/                         # Public web files
│   ├── css/                       # Stylesheets
│   ├── images/                    # Images & assets
│   │   ├── handphones/            # Upload gambar HP (19 files)
│   │   ├── favicon.svg            # Favicon website
│   │   └── placeholder.svg        # Placeholder HP tanpa gambar
│   ├── js/                        # JavaScript files
│   ├── test_db.php                # Test koneksi database
│   ├── test_models.php            # Test models (Criteria, Profile, Handphone)
│   ├── test_password.php          # Test bcrypt password verification
│   └── test_saw_service.php       # Test SawService lengkap dengan UI
│
├── tests/                          # Testing scripts
│   └── test_saw_cli.php           # Test CLI untuk SawService
│
├── views/                          # View templates (frontend)
│
└── handphones_data.json            # Draft data HP (tidak digunakan)
```

---

## DOKUMENTASI

### File Dokumentasi Tersedia:

1. **README.md** (163 lines) - Instalasi & quick start
2. **CHANGELOG.md** - Riwayat perubahan lengkap (v1.0.0)
3. **AGENTS.md** - Aturan development
4. **PROJECT_BRIEF.md** - Tujuan & scope project
5. **DATABASE_DESIGN.md** - Schema & ERD
6. **SAW_METHODOLOGY.md** - Rumus & contoh perhitungan
7. **PANDUAN_PENGGUNA.md** (300+ lines) - User guide lengkap
8. **STRUKTUR_PROJECT.md** (file ini) - Folder structure
9. **TESTING_REPORT.md** - Panduan pengujian
10. **LAPORAN_HASIL_PERSIAPAN_PENGUJIAN.md** - Test prep
11. **FASE3_TESTING.md** - Admin panel testing
12. **FASE4A_REPORT.md** - Upload implementation
13. **FINALISASI_REPORT.md** - Production readiness
14. **REDESIGN_DARK_GAMING.md** - Dark theme v1.0
15. **REDESIGN_BLUE_ENHANCED.md** - Blue theme v2.0
16. **jobdesk_kelompok.md** - Team & timeline

---

## LOKASI PROJECT UNTUK XAMPP

### Path XAMPP htdocs:
```
C:\xampp\htdocs\SPK-Handphone\
```

### URL Akses via Browser:
```
http://localhost/SPK-Handphone/public/test_saw_service.php
http://localhost/SPK-Handphone/public/test_models.php
http://localhost/SPK-Handphone/public/test_db.php
```

### Jika Project di E:\ProjectSPK:
**Opsi 1: Symbolic Link**
```bash
# Windows CMD (Admin):
mklink /D C:\xampp\htdocs\SPK-Handphone E:\ProjectSPK\SPK-Handphone
```

**Opsi 2: Virtual Host**
Edit `C:\xampp\apache\conf\extra\httpd-vhost.conf`:
```apache
<VirtualHost *:80>
    DocumentRoot "E:/ProjectSPK/SPK-Handphone/public"
    ServerName spk.local
    <Directory "E:/ProjectSPK/SPK-Handphone/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Edit `C:\Windows\System32\drivers\etc\hosts`:
```
127.0.0.1 spk.local
```

Akses: `http://spk.local/test_saw_service.php`

---

## FILE PENTING

### Konfigurasi Database
- `app/config/database.php`
  - Host: localhost
  - Database: spk_handphone
  - User: root
  - Password: (kosong)

### Models
- `app/models/Handphone.php` - CRUD handphone + transformasi RAM/Storage
- `app/models/Criteria.php` - CRUD kriteria (C1-C5)
- `app/models/Profile.php` - CRUD profil dengan bobot

### Service SAW
- `app/services/SawService.php` - Perhitungan SAW lengkap:
  - Filter budget
  - Transformasi RAM/Storage ke skala 1-5
  - Normalisasi Cost/Benefit
  - Perhitungan weighted score
  - Ranking

### Database
- `database/migrations/001_create_tables.sql` - Schema 4 tabel:
  - handphones
  - criterias
  - profiles
  - profile_weights

- `database/seeds/001_initial_data.sql` - Kriteria & 3 profil:
  - Gaming (prioritas Chipset & RAM)
  - Photography (prioritas Kamera)
  - Daily (balanced)

- `database/seeds/002_test_handphones.sql` - 10 HP test data awal

- `database/seeds/003_add_10_phones.sql` - 10 HP tambahan:
  - Samsung Galaxy A35 5G, A54 5G
  - Xiaomi Redmi Note 13 Pro 5G
  - Poco X6 5G
  - Infinix Note 40 Pro 5G
  - Oppo Reno11 5G
  - Vivo V30e 5G
  - Nothing Phone (2a)
  - Motorola Edge 50 Fusion
  - Realme C55

### Testing
- `public/test_saw_service.php` - UI lengkap dengan:
  - Test 1: Verifikasi data HP
  - Test 2: Verifikasi profil & bobot
  - Test 3: Perhitungan SAW (9 skenario)
  - Test 4: Edge cases
  - Validasi perhitungan manual

- `tests/test_saw_cli.php` - Versi CLI dengan colored output

---

## CARA SETUP PROJECT

### 1. Database Setup
```bash
# Via MySQL CLI:
mysql -u root -p
CREATE DATABASE spk_handphone;
USE spk_handphone;
SOURCE E:/ProjectSPK/SPK-Handphone/database/migrations/001_create_tables.sql;
SOURCE E:/ProjectSPK/SPK-Handphone/database/seeds/001_seed_profiles.sql;
SOURCE E:/ProjectSPK/SPK-Handphone/database/seeds/002_test_handphones.sql;
```

### 2. Verifikasi Koneksi
```
http://localhost/SPK-Handphone/public/test_db.php
```

### 3. Test Models
```
http://localhost/SPK-Handphone/public/test_models.php
```

### 4. Test SawService
```
http://localhost/SPK-Handphone/public/test_saw_service.php
```

---

## STATUS FILE

### ✅ File Sudah Ada dan Valid
- [x] app/config/database.php
- [x] app/models/Handphone.php, Criteria.php, Profile.php, Admin.php
- [x] app/controllers/HomeController.php, RecommendationController.php, AdminController.php, BaseController.php
- [x] app/services/SawService.php (sudah diaudit & diperbaiki)
- [x] app/helpers/auth.php, functions.php, security.php
- [x] database/migrations/001_create_tables.sql, 002_create_admins_table.sql
- [x] database/seeds/001_initial_data.sql, 002_test_handphones.sql, 003_add_10_phones.sql
- [x] public/css/style.css, admin.css (Dark Gaming Blue Enhanced)
- [x] public/images/favicon.svg, placeholder.svg
- [x] public/images/handphones/ (19 gambar HP uploaded)
- [x] public/test_db.php, test_models.php, test_password.php, test_saw_service.php
- [x] tests/test_saw_cli.php
- [x] views/ (11 file view lengkap)
- [x] docs/ (14 file dokumentasi)
- [x] .gitignore
- [x] README.md

---

## PERUBAHAN STRUKTUR

### Sebelumnya (SALAH):
```
E:\ProjectSPK\
├── SPK-Handphone/
│   ├── app/
│   ├── database/
│   ├── docs/          (lama)
│   ├── public/        (lama)
│   ├── tests/         (kosong)
│   └── views/
├── docs/              (file baru, LUAR folder)
├── public/            (file baru, LUAR folder)
├── tests/             (file baru, LUAR folder)
└── .gitignore         (LUAR folder)
```

### Setelah Dirapikan (BENAR):
```
E:\ProjectSPK\
└── SPK-Handphone/
    ├── .git/
    ├── .gitignore     ✅ DIPINDAHKAN
    ├── README.md
    ├── app/
    ├── database/
    ├── docs/          ✅ FILE BARU DIGABUNG
    ├── public/        ✅ FILE BARU DIGABUNG
    ├── tests/         ✅ FILE BARU DITAMBAHKAN
    └── views/
```

---

## OPERASI YANG DILAKUKAN

```bash
# 1. Pindahkan file public
mv public/test_saw_service.php SPK-Handphone/public/

# 2. Pindahkan file tests
mv tests/test_saw_cli.php SPK-Handphone/tests/

# 3. Pindahkan file docs
mv docs/LAPORAN_HASIL_PERSIAPAN_PENGUJIAN.md SPK-Handphone/docs/
mv docs/TESTING_REPORT.md SPK-Handphone/docs/

# 4. Pindahkan .gitignore
mv .gitignore SPK-Handphone/

# 5. Hapus folder kosong
rmdir docs/ public/ tests/
```

---

## VERIFIKASI

### Cek Struktur:
```bash
cd E:\ProjectSPK
ls -la                    # Hanya ada folder SPK-Handphone
cd SPK-Handphone
ls -la                    # Semua file lengkap
```

### Cek File Terimport:
```bash
ls docs/                  # 6 file documentation
ls public/                # 3 file test + css/images/js
ls tests/                 # 1 file test CLI
```

---

## KESIMPULAN

✅ **Struktur folder SUDAH DIRAPIKAN**  
✅ **Semua file dalam folder SPK-Handphone**  
✅ **Tidak ada folder bersarang**  
✅ **File konfigurasi & kode tetap utuh**  
✅ **Testing manual selesai (upload gambar, CRUD, SAW)**  
✅ **19 gambar HP berhasil diupload**  
✅ **Project production-ready**

**Lokasi Project:** `C:\xampp\htdocs\SPK-Handphone`  
**Git Repository:** Aktif di `.git/`  
**Status:** PRODUCTION READY - TESTED

---

*Generated by Kiro AI - 31 Oktober 2026*  
*Updated by Liv - 10 November 2026*
