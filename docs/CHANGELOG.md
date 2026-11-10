# CHANGELOG - SPK Handphone

Dokumentasi perubahan sistem dari development hingga production-ready.

---

## [1.0.0] - 10 November 2026

### ✅ Status Akhir
**Production Ready (95%)** - Semua fitur core selesai dan tested.

### 📊 Statistik Project
- **Total Files:** 73 files
- **Database Tables:** 5 tables (handphones, criterias, profiles, profile_weights, admins)
- **Data HP:** 20+ handphones dengan gambar
- **Gambar Uploaded:** 19 files di `public/images/handphones/`
- **Documentation:** 14 files lengkap
- **Test Coverage:** Manual testing selesai

---

## Testing & Validation (10 November 2026)

### ✅ Upload Gambar Tested
- Test upload: 19 files berhasil
- Replace gambar: Old deleted, new saved
- MIME validation: Working
- File size limit: Enforced (2MB)
- Placeholder fallback: Berfungsi
- Cascade delete: Image deleted with data

### ✅ Admin Panel Tested
- Login/Logout: Working
- CRUD Handphone: All operations functional
- CSRF Protection: Active
- Session management: Secure
- Flash messages: Displayed correctly

### ✅ SAW Algorithm Tested
- Pre-filtering budget: Correct
- Normalization: Cost/Benefit accurate
- Weighted scoring: Validated manual
- Ranking: Correct order
- Edge cases: Handled properly

---

## Fase 4A - Core Finalisasi (1 November 2024)

### Added
- Upload gambar handphone dengan validasi lengkap
  - Extension whitelist: JPG, JPEG, PNG
  - MIME type validation (finfo)
  - Size limit: 2MB
  - Unique filename generation
  - .htaccess protection
- Placeholder image (placeholder.svg)
- Favicon website (favicon.svg)
- README.md lengkap (163 lines)
- PANDUAN_PENGGUNA.md (300+ lines)
- public/test_password.php

### Modified
- AdminController.php: handleImageUpload(), deleteImage()
- views/admin/handphones/create.php: file input + enctype
- views/admin/handphones/edit.php: file input + preview
- views/recommendation/result.php: gambar HP display
- public/css/admin.css: file upload styling

### Security
- .htaccess block PHP execution di upload folder
- Rollback image on DB insert fail
- Auto-delete old image on replace
- Delete image on data delete

---

## Redesign UI - Blue Enhanced v2.0 (1 November 2024)

### Changed
- Dominasi warna: Blue 55% / Red 45% (dari 40/60)
- Login page: Complete redesign dark gaming theme
- Background: Blue gradient opacity 0.12 (dari 0.05)
- Hero section: Blue-dominant gradient
- Cards: Alternating blue-navy-red borders
- Navbar: Blue accents dan glow effects
- Stats cards: Blue values pada odd cards
- Buttons: Blue-navy-red gradient

### Visual Enhancements
- Blue glow effects lebih kuat (opacity 0.3-0.5)
- Gradient text: Blue → Navy → Red
- Focus states: Strong blue glow
- Hover effects: Blue-dominant transitions

### Files Modified
- views/admin/login.php: Inline CSS redesign
- public/css/style.css: +90 lines blue enhancement
- public/css/admin.css: +80 lines blue enhancement

---

## Fase 3 - Admin Panel (1 November 2024)

### Added
- database/migrations/002_create_admins_table.sql
- app/models/Admin.php
- app/controllers/AdminController.php
- views/admin/ (6 files: login, dashboard, navbar, 3 handphone views)
- public/css/admin.css (Dark Gaming theme)
- app/helpers/auth.php (requireLogin, isLoggedIn)

### Features
- Login dengan bcrypt password hashing
- Session management
- Dashboard dengan statistik
- CRUD Handphone lengkap
- Validasi input server-side
- CSRF protection semua form
- Flash messages (success/error)
- Logout dengan session destroy

### Security
- Password bcrypt cost=10
- Prepared statements semua query
- Input sanitization (sanitize helper)
- requireLogin() protection
- CSRF token validation

### Default Credentials
- Username: admin
- Password: admin123

---

## Fase 2 - SAW Implementation & UI Public (Oktober 2026)

### Added
- app/services/SawService.php (metode SAW lengkap)
- app/controllers/RecommendationController.php
- views/recommendation/ (index.php, result.php)
- views/home.php (hero section + features)
- views/layout/ (header.php, footer.php)
- public/css/style.css (Dark Gaming/Cyberpunk theme)
- public/js/script.js

### Features
- Pre-filtering berdasarkan budget
- Normalisasi Cost/Benefit
- Weighted scoring (3 profil)
- Ranking Top 5 handphone
- Badge "Rekomendasi Terbaik"
- Progress bar skor SAW
- Transparansi bobot kriteria
- Responsive mobile/tablet/desktop

### Algorithm
- Kriteria: C1 (Harga-Cost), C2-C5 (Benefit)
- Profil: Gaming, Fotografi, Harian
- Rumus normalisasi sesuai SAW methodology
- Division by zero protection
- Error handling lengkap

---

## Fase 1 - Database & Backend Core (Oktober 2026)

### Added
- database/migrations/001_create_tables.sql
  - handphones (alternatif)
  - criterias (5 kriteria)
  - profiles (3 profil)
  - profile_weights (bobot kriteria per profil)
- database/seeds/001_initial_data.sql
- database/seeds/002_test_handphones.sql
- database/seeds/003_add_10_phones.sql
- app/config/database.php (PDO connection)
- app/models/ (Handphone.php, Criteria.php, Profile.php)
- app/controllers/BaseController.php
- app/helpers/ (functions.php, security.php)

### Database Design
- 4 tabel normalized (many-to-many profile_weights)
- RAM/Storage skala otomatis (tidak disimpan redundant)
- Chipset/Kamera skala manual admin
- Total bobot per profil = 1.00

### Data Seeds
- 5 kriteria SAW
- 3 profil dengan bobot berbeda
- 20+ handphone test data dari GSMArena
- Rentang harga: Rp 2.3jt - Rp 5.5jt

---

## Testing & Documentation

### Test Files
- public/test_db.php - Koneksi database
- public/test_models.php - CRUD models
- public/test_password.php - Bcrypt verification
- public/test_saw_service.php - SAW calculation (9 scenarios)
- tests/test_saw_cli.php - CLI version

### Documentation Files
1. AGENTS.md - Development rules
2. DATABASE_DESIGN.md - Schema & ERD
3. SAW_METHODOLOGY.md - Rumus & contoh perhitungan
4. PANDUAN_PENGGUNA.md - User guide (pengguna & admin)
5. README.md - Instalasi & troubleshooting
6. STRUKTUR_PROJECT.md - Folder structure
7. TESTING_REPORT.md - Testing guide
8. LAPORAN_HASIL_PERSIAPAN_PENGUJIAN.md - Test prep report
9. FASE3_TESTING.md - Admin panel testing
10. FASE4A_REPORT.md - Upload implementation
11. FINALISASI_REPORT.md - Production readiness
12. REDESIGN_DARK_GAMING.md - Dark theme v1.0
13. REDESIGN_BLUE_ENHANCED.md - Blue theme v2.0
14. jobdesk_kelompok.md - Team & timeline
15. CHANGELOG.md - This file

---

## Known Issues & Limitations

### Non-Critical
1. Tidak ada pagination list HP admin (OK untuk ~20 HP)
2. Tidak ada search/filter di admin
3. Single admin account (no multi-user)
4. Bobot SAW fixed (tidak bisa diubah via UI)
5. Top 5 only (by design)
6. Single image per HP (no gallery)

### By Design
- Kriteria & profil tidak editable via UI (konsistensi)
- Chipset & Kamera dinilai manual (subjektif)
- RAM & Storage skala otomatis (objective)

---

## Tech Stack

### Backend
- PHP 8.x Native (no framework)
- PDO (prepared statements)
- MVC architecture
- Bcrypt password hashing
- Session-based auth

### Frontend
- HTML5 semantic
- CSS3 (variables, grid, flexbox)
- JavaScript ES6+
- Responsive design

### Database
- MySQL/MariaDB
- 5 tables normalized
- PDO connections

### Server
- Apache 2.4+
- XAMPP (development)
- .htaccess routing

---

## Security Features

✅ Password Hashing (bcrypt cost=10)  
✅ CSRF Protection (all forms)  
✅ SQL Injection Prevention (prepared statements)  
✅ XSS Prevention (htmlspecialchars output)  
✅ File Upload Validation (MIME + extension + size)  
✅ Session Security (requireLogin protection)  
✅ Input Sanitization (sanitize helper)  
✅ .htaccess Upload Protection (block script execution)

---

## File Structure Summary

```
SPK-Handphone/
├── app/ (13 files PHP)
│   ├── config/ (database.php)
│   ├── controllers/ (4 controllers)
│   ├── models/ (4 models)
│   ├── services/ (SawService.php)
│   └── helpers/ (3 helpers)
├── database/ (5 SQL files)
│   ├── migrations/ (2 files)
│   └── seeds/ (3 files)
├── docs/ (15 files markdown)
├── public/ (CSS, JS, images, tests)
│   ├── images/handphones/ (19 uploaded)
│   ├── css/ (style.css, admin.css + backups)
│   └── js/ (script.js)
├── tests/ (test_saw_cli.php)
├── views/ (11 files PHP)
│   ├── admin/ (6 files)
│   ├── layout/ (3 files)
│   └── recommendation/ (2 files)
├── .gitignore
├── README.md
└── handphones_data.json (draft, unused)
```

---

## Credits

**Development Team:**
- Yosi: Backend & Database Lead
- Moklas: System Analyst & UI/UX Designer
- Getar: Frontend Developer
- Vito: QA Tester & Documentation

**AI Assistant:**
- Kiro / Liv: Development assistance & code review

**Metodologi:** Simple Additive Weighting (SAW)  
**Mata Kuliah:** Teamwork Building  
**Semester:** 1 (16 minggu)

---

## Timeline

- **Minggu 1-4:** Inisiasi, analisis, perancangan
- **Minggu 5-8:** Development core & desain visual
- **Minggu 9-12:** Implementasi SAW & integrasi frontend
- **Minggu 13-16:** Testing, evaluasi, dokumentasi
- **1 November 2024:** Finalisasi fitur
- **10 November 2026:** Production ready - tested

---

## License

Educational project untuk mata kuliah Teamwork Building.  
Tidak untuk distribusi komersial.

---

**Status:** Production Ready (95%)  
**Last Updated:** 10 November 2026  
**Version:** 1.0.0
