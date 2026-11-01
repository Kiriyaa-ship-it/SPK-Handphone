# FASE 3: Admin Panel - Testing Guide

## File yang Dibuat/Diubah

### Database
- database/migrations/002_create_admins_table.sql

### Models
- app/models/Admin.php

### Controllers
- app/controllers/AdminController.php

### Views
- views/admin/login.php
- views/admin/dashboard.php
- views/admin/partials/navbar.php
- views/admin/handphones/index.php
- views/admin/handphones/create.php
- views/admin/handphones/edit.php

### Assets
- public/css/admin.css

### Router
- public/index.php (ditambah routing admin)

## Cara Testing

### 1. Jalankan MySQL di XAMPP
- Buka XAMPP Control Panel
- Start Apache dan MySQL

### 2. Jalankan Migration Tabel Admin
```bash
C:/xampp/mysql/bin/mysql.exe -uroot -e "USE spk_handphone; SOURCE C:/xampp/htdocs/SPK-Handphone/database/migrations/002_create_admins_table.sql"
```

Atau via phpMyAdmin:
- Buka http://localhost/phpmyadmin
- Pilih database `spk_handphone`
- Import file `database/migrations/002_create_admins_table.sql`

### 3. Akses Admin Panel

**Login:**
- URL: http://localhost/SPK-Handphone/public/admin/login
- Username: admin
- Password: admin123

**Dashboard:**
- URL: http://localhost/SPK-Handphone/public/admin/dashboard

**Data Handphone:**
- URL: http://localhost/SPK-Handphone/public/admin/handphones

### 4. Test Fitur

#### A. Login & Logout
1. Akses /admin/login
2. Login dengan kredensial di atas
3. Harus redirect ke dashboard
4. Klik Logout
5. Harus kembali ke login

#### B. CRUD Handphone
1. Klik "Data Handphone" di navbar
2. Klik "Tambah Handphone"
3. Isi form:
   - Nama: Samsung Galaxy A54
   - Merk: Samsung
   - Harga: 5000000
   - Chipset: 4
   - RAM: 8
   - Storage: 128
   - Kamera: 4
   - Deskripsi: (opsional)
4. Klik Simpan
5. Data muncul di tabel
6. Klik Edit, ubah harga jadi 4500000
7. Klik Update
8. Cek perubahan tersimpan
9. Test hapus dengan konfirmasi

#### C. Proteksi Akses
1. Logout
2. Coba akses /admin/dashboard langsung
3. Harus redirect ke login

#### D. Integrasi SAW
1. Tambah 3-5 handphone via admin
2. Logout dari admin
3. Buka halaman publik /rekomendasi
4. Pilih profil dan budget
5. Hasil rekomendasi harus include HP yang baru ditambah

### 5. Validasi Keamanan

#### Password Hashing
```sql
SELECT password FROM admins WHERE username = 'admin';
```
Harus hash bcrypt, bukan plaintext.

#### CSRF Token
- View source form tambah/edit
- Harus ada input hidden csrf_token

#### Prepared Statements
- Semua query di AdminController pakai PDO prepare()
- Tidak ada SQL injection risk

## Fitur yang Diimplementasikan

✅ Login admin dengan password hashing (bcrypt)
✅ Session management
✅ Dashboard dengan statistik
✅ CRUD Handphone lengkap (Create, Read, Update, Delete)
✅ Validasi input server-side
✅ CSRF protection
✅ Prepared statements (SQL injection protection)
✅ Flash messages untuk feedback
✅ Proteksi akses requireLogin()
✅ Logout dengan session destroy
✅ Responsive admin UI

## Limitasi Saat Ini

- Belum ada upload gambar HP (kolom gambar masih NULL)
- Belum ada pagination untuk list HP
- Belum ada search/filter
- Belum ada CRUD kriteria/profil (konfigurasi SAW tetap)
- Single admin (belum multi-user)

## Catatan Penting

- Data HP yang ditambah/diedit otomatis digunakan SAW
- SawService tidak diubah sama sekali
- Bobot dan rumus SAW tetap seperti FASE 1 & 2
- Design visual konsisten dengan halaman publik
- POST method untuk semua operasi mutasi
- Password admin default: admin123 (ganti di production!)
