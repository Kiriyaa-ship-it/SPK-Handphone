# STRUKTUR PROJECT SPK-HANDPHONE

**Lokasi Project:** `E:\ProjectSPK\SPK-Handphone`  
**Tanggal Update:** 31 Oktober 2026, 20:08 WIB  
**Status:** ✅ STRUKTUR SUDAH DIRAPIKAN

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
│   │   └── 001_create_tables.sql  # Schema database lengkap
│   │
│   └── seeds/                      # Data seed untuk testing
│       ├── 001_seed_profiles.sql  # Data profil (Gaming, Photography, Daily)
│       └── 002_test_handphones.sql # Data 10 HP untuk testing
│
├── docs/                           # Dokumentasi project
│   ├── AGENTS.md                  # Dokumentasi AI agents
│   ├── DATABASE_DESIGN.md         # Desain database lengkap
│   ├── PROJECT_BRIEF.md           # Brief project
│   ├── SAW_METHODOLOGY.md         # Metodologi SAW lengkap
│   ├── TESTING_REPORT.md          # Panduan pengujian
│   ├── LAPORAN_HASIL_PERSIAPAN_PENGUJIAN.md # Laporan persiapan test
│   └── STRUKTUR_PROJECT.md        # File ini
│
├── public/                         # Public web files
│   ├── css/                       # Stylesheets
│   ├── images/                    # Images & assets
│   ├── js/                        # JavaScript files
│   ├── test_db.php                # Test koneksi database
│   ├── test_models.php            # Test models (Criteria, Profile, Handphone)
│   └── test_saw_service.php       # Test SawService lengkap dengan UI
│
├── tests/                          # Testing scripts
│   └── test_saw_cli.php           # Test CLI untuk SawService
│
└── views/                          # View templates (frontend)
```

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

- `database/seeds/001_seed_profiles.sql` - 3 profil:
  - Gaming (prioritas Chipset & RAM)
  - Photography (prioritas Kamera)
  - Daily (balanced)

- `database/seeds/002_test_handphones.sql` - 10 HP test data:
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
- [x] app/models/Handphone.php
- [x] app/models/Criteria.php
- [x] app/models/Profile.php
- [x] app/services/SawService.php (sudah diaudit & diperbaiki)
- [x] database/migrations/001_create_tables.sql
- [x] database/seeds/001_seed_profiles.sql
- [x] database/seeds/002_test_handphones.sql
- [x] public/test_db.php
- [x] public/test_models.php
- [x] public/test_saw_service.php
- [x] tests/test_saw_cli.php
- [x] docs/SAW_METHODOLOGY.md
- [x] docs/DATABASE_DESIGN.md
- [x] docs/TESTING_REPORT.md
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
✅ **Project siap dijalankan via XAMPP**

**Lokasi Project:** `E:\ProjectSPK\SPK-Handphone`  
**Git Repository:** Aktif di `.git/`  
**Status:** READY FOR TESTING

---

*Generated by Kiro AI - 31 Oktober 2026*
