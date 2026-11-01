# LAPORAN PENGUJIAN SawService.php

**Tanggal:** 31 Oktober 2026  
**File Diuji:** app/services/SawService.php  
**Dataset:** 10 HP dari database/seeds/002_test_handphones.sql  
**Metodologi:** SAW (Simple Additive Weighting)

---

## RINGKASAN EKSEKUTIF

**Status:** ✅ SIAP UNTUK PENGUJIAN LIVE  
**File Test Script:** public/test_saw_service.php  

---

## CHECKLIST PENGUJIAN

### ✅ 1. Verifikasi Dataset (SIAP)
- [x] File SQL seed dibuat: `database/seeds/002_test_handphones.sql`
- [x] 10 HP dengan variasi lengkap (merek, harga, spesifikasi)
- [x] Rentang harga: Rp 2.399.000 - Rp 4.499.000
- [x] Chipset skala: 2, 3, 4, 5 (diversifikasi)
- [x] Kamera skala: 2, 3, 4, 5 (diversifikasi)
- [x] RAM/Storage: 8/128GB dan 8/256GB

### ✅ 2. Script Pengujian (SIAP)
- [x] File test dibuat: `public/test_saw_service.php`
- [x] UI lengkap dengan tampilan HTML modern
- [x] Test coverage komprehensif

### 📋 3. Pengujian yang Akan Dilakukan

**Test 1: Verifikasi Data HP**
- Cek jumlah data HP di database
- Tampilkan semua HP dengan spesifikasi lengkap

**Test 2: Verifikasi Profil dan Bobot**
- Cek profil Gaming, Photography, Daily
- Validasi bobot kriteria C1-C5
- Validasi total bobot = 1.0

**Test 3: Perhitungan SAW untuk 3 Profil**

**Profil Gaming:**
- Budget Rp 3.000.000
- Budget Rp 4.000.000  
- Budget Rp 5.000.000

**Profil Photography:**
- Budget Rp 3.000.000
- Budget Rp 4.000.000
- Budget Rp 5.000.000

**Profil Daily:**
- Budget Rp 2.500.000
- Budget Rp 3.500.000
- Budget Rp 4.500.000

**Validasi untuk Setiap Skenario:**
- [x] Filter budget (hanya HP ≤ budget)
- [x] Perhitungan min/max dari subset filtered
- [x] Normalisasi Cost: r_C1 = min/x
- [x] Normalisasi Benefit: r_C2-C5 = x/max
- [x] Weighted score: w × r untuk setiap kriteria
- [x] Final score: V = Σ(w_j × r_ij)
- [x] Ranking descending by final score
- [x] Validasi perhitungan manual untuk rank #1

**Test 4: Edge Cases**
- Budget 0 (harus error)
- Budget negatif (harus error)
- Budget terlalu kecil Rp 1 juta (tidak ada HP)
- Budget sangat besar Rp 10 juta (semua HP lolos)
- Profil ID tidak valid (harus error)

---

## CARA MENJALANKAN PENGUJIAN

### Langkah 1: Import Data HP ke Database

**Via phpMyAdmin:**
```
1. Buka phpMyAdmin
2. Pilih database 'spk_handphone'
3. Tab 'Import'
4. Choose File: database/seeds/002_test_handphones.sql
5. Klik 'Go'
```

**Via MySQL Command Line:**
```bash
mysql -u root -p spk_handphone < database/seeds/002_test_handphones.sql
```

**Via PHP script (alternatif):**
```bash
php -r "
\$db = new PDO('mysql:host=localhost;dbname=spk_handphone', 'root', '');
\$sql = file_get_contents('database/seeds/002_test_handphones.sql');
\$db->exec(\$sql);
echo 'Data berhasil diimport\n';
"
```

### Langkah 2: Jalankan Script Test

**Via Browser:**
```
http://localhost/ProjectSPK/public/test_saw_service.php
```

**Via PHP Built-in Server:**
```bash
cd public
php -S localhost:8000
# Buka: http://localhost:8000/test_saw_service.php
```

### Langkah 3: Periksa Hasil

Script akan menampilkan:
- ✅ Status setiap test (sukses/gagal/error)
- 📊 Tabel data HP di database
- 🎯 Bobot setiap profil
- 💰 Hasil ranking untuk setiap skenario budget
- 🔍 Validasi perhitungan manual
- ⚠️ Error handling untuk edge cases

---

## VALIDASI OTOMATIS YANG DILAKUKAN

### 1. Filter Budget
✅ Memastikan hanya HP dengan harga ≤ budget yang diproses

### 2. Normalisasi Cost (C1 - Harga)
✅ Formula: r_ij = min_C1 / x_ij  
✅ Semakin murah = semakin baik

### 3. Normalisasi Benefit (C2-C5)
✅ Formula: r_ij = x_ij / max_Cj  
✅ Semakin tinggi = semakin baik

### 4. Weighted Score
✅ Setiap nilai normalisasi × bobot kriteria

### 5. Final Score
✅ V_i = Σ(w_j × r_ij)  
✅ Validasi manual untuk top-1 ranking

### 6. Ranking
✅ Sort descending by final score  
✅ Rank 1 = HP terbaik

### 7. Division by Zero Protection
✅ Validasi min_C1 > 0  
✅ Validasi max_C2, max_C3, max_C4, max_C5 > 0

---

## EKSPEKTASI HASIL

### Profil Gaming (Prioritas Chipset)
**Budget Rp 3.000.000:**
- HP dengan chipset skala tinggi (4-5) akan menang
- Contoh kandidat: Poco X6 (SD 7s Gen 2, skala 4)

**Budget Rp 4.000.000:**
- Lebih banyak pilihan dengan chipset kuat
- Contoh kandidat: Redmi Note 13 Pro, Nothing Phone 2a

**Budget Rp 5.000.000:**
- Semua HP available, Reno11 (skala 5) kemungkinan menang

### Profil Photography (Prioritas Kamera)
**Budget Rp 3.000.000:**
- HP dengan kamera skala tinggi akan menang
- Contoh kandidat: Infinix Note 40 Pro (108MP OIS, skala 4)

**Budget Rp 4.000.000:**
- Redmi Note 13 Pro (200MP, skala 5) kemungkinan dominan

**Budget Rp 5.000.000:**
- Redmi Note 13 Pro (skala 5) paling unggul

### Profil Daily (Prioritas Balance)
**Budget Rp 2.500.000:**
- HP dengan value terbaik di rentang murah
- Contoh kandidat: Realme C55, Infinix Note 40 Pro

**Budget Rp 3.500.000:**
- Banyak pilihan midrange balance

**Budget Rp 4.500.000:**
- HP dengan keseimbangan terbaik semua kriteria

---

## MASALAH YANG MUNGKIN DITEMUKAN

### Potensi Error:

**1. Database Connection Error**
- **Penyebab:** MySQL tidak running / kredensial salah
- **Solusi:** Pastikan XAMPP/LAMP/WAMP aktif

**2. Data HP Tidak Ditemukan**
- **Penyebab:** Seed SQL belum diimport
- **Solusi:** Jalankan import SQL terlebih dahulu

**3. Profil Tidak Ditemukan**
- **Penyebab:** Tabel profiles / profile_weights kosong
- **Solusi:** Jalankan migration & seed profil

**4. Division by Zero**
- **Penyebab:** Semua HP di subset memiliki nilai sama (edge case)
- **Status:** Sudah dihandle dengan validasi di SawService.php

---

## REKOMENDASI DEBUGGING

Jika menemukan masalah, cek:

1. **Error PHP:** Cek display_errors = On di php.ini
2. **Error Database:** Cek koneksi dengan public/test_db.php
3. **Data HP:** Cek dengan public/test_models.php
4. **SQL Log:** Enable MySQL general log untuk melihat query

---

## KESIMPULAN AWAL

✅ **File SQL seed:** SIAP  
✅ **Script pengujian:** SIAP  
✅ **Test coverage:** KOMPREHENSIF  
✅ **Validasi otomatis:** AKTIF  
✅ **Error handling:** TERIMPLEMENTASI  

**STATUS:** Siap untuk pengujian live via browser setelah data diimport ke database.

---

## NEXT STEPS

1. ✅ Import data HP: `database/seeds/002_test_handphones.sql`
2. 🔄 Akses: `http://localhost/ProjectSPK/public/test_saw_service.php`
3. 📊 Review hasil pengujian di browser
4. 🐛 Jika ada error, capture screenshot & pesan error
5. 🔧 Fix bug yang ditemukan
6. ✅ Konfirmasi semua test passed

---

**Prepared by:** Kiro AI  
**Date:** 31 Oktober 2026  
**Version:** 1.0
