# Panduan Pengguna - Sistem Pendukung Keputusan Pemilihan Handphone

Dokumen ini menjelaskan cara menggunakan Sistem Pendukung Keputusan Pemilihan Handphone untuk pengguna biasa dan administrator.

## Daftar Isi

1. [Untuk Pengguna Biasa](#untuk-pengguna-biasa)
2. [Untuk Administrator](#untuk-administrator)
3. [Tips Penggunaan](#tips-penggunaan)
4. [FAQ](#faq)

---

## Untuk Pengguna Biasa

### Mencari Rekomendasi Handphone

#### Langkah 1: Buka Aplikasi

1. Buka browser (Chrome, Firefox, atau Edge)
2. Ketik di address bar: `http://localhost/SPK-Handphone/public/`
3. Anda akan melihat halaman utama dengan tombol **"Mulai Cari Rekomendasi"**

#### Langkah 2: Masukkan Budget

1. Klik tombol **"Mulai Cari Rekomendasi"**
2. Anda akan diarahkan ke form pencarian
3. Di kolom **"Anggaran Maksimal"**, masukkan budget Anda dalam rupiah
   - Contoh: `5000000` untuk budget 5 juta rupiah
   - Jangan gunakan titik atau koma, hanya angka saja
   - Minimal budget: 1.000.000 (1 juta)

#### Langkah 3: Pilih Profil Kebutuhan

Pilih salah satu profil sesuai kebutuhan Anda:

**1. Gaming**
- Prioritas: Performa chipset dan RAM tinggi
- Cocok untuk: Main game berat, multitasking
- Bobot kriteria:
  - Harga: 15%
  - Chipset: 35%
  - RAM: 30%
  - Storage: 10%
  - Kamera: 10%

**2. Fotografi**
- Prioritas: Kualitas kamera tinggi
- Cocok untuk: Fotografi, videografi, konten creator
- Bobot kriteria:
  - Harga: 15%
  - Chipset: 10%
  - RAM: 15%
  - Storage: 20%
  - Kamera: 40%

**3. Penggunaan Harian**
- Prioritas: Seimbang untuk semua kebutuhan
- Cocok untuk: Penggunaan umum, sosmed, browsing
- Bobot kriteria:
  - Harga: 25%
  - Chipset: 20%
  - RAM: 20%
  - Storage: 20%
  - Kamera: 15%

#### Langkah 4: Hitung Rekomendasi

1. Setelah memilih profil, klik tombol **"Hitung Rekomendasi"**
2. Sistem akan memproses data menggunakan metode SAW
3. Tunggu beberapa detik hingga hasil muncul

#### Langkah 5: Lihat Hasil

Hasil rekomendasi akan menampilkan **Top 5 Handphone Terbaik** dengan informasi:

- **Ranking:** Urutan terbaik berdasarkan skor SAW
- **Gambar:** Foto handphone (jika tersedia)
- **Nama & Merk:** Nama lengkap dan brand handphone
- **Harga:** Harga dalam rupiah
- **Spesifikasi:**
  - Chipset (skala 1-5)
  - RAM (dalam GB)
  - Storage (dalam GB)
  - Kamera (skala 1-5)
- **Skor Akhir SAW:** Nilai hasil perhitungan (0-1, semakin tinggi semakin baik)

**Rekomendasi Terbaik** ditandai dengan badge **"REKOMENDASI TERBAIK"** dan background khusus.

#### Langkah 6: Cari Ulang (Opsional)

Jika hasil tidak sesuai:
1. Klik tombol **"Cari Ulang"**
2. Ubah budget atau profil kebutuhan
3. Hitung rekomendasi kembali

---

## Untuk Administrator

### Login ke Admin Panel

#### Langkah 1: Akses Halaman Login

1. Dari halaman utama, klik **"Admin"** di navbar
2. Atau langsung buka: `http://localhost/SPK-Handphone/public/admin/login`

#### Langkah 2: Masukkan Kredensial

- **Username:** `admin`
- **Password:** `admin123` (default)

#### Langkah 3: Klik Login

Setelah berhasil login, Anda akan diarahkan ke **Dashboard Admin**.

**⚠️ PENTING:** Segera ganti password default setelah login pertama!

---

### Mengelola Data Handphone

#### A. Melihat List Handphone

1. Dari dashboard, klik **"Data Handphone"** di navbar
2. Anda akan melihat tabel berisi semua data handphone:
   - ID
   - Nama
   - Merk
   - Harga
   - Chipset (skala 1-5)
   - RAM (GB)
   - Storage (GB)
   - Kamera (skala 1-5)
   - Tombol aksi (Edit & Hapus)

#### B. Menambah Handphone Baru

1. Klik tombol **"+ Tambah Handphone"** (pojok kanan atas)
2. Isi form dengan lengkap:

   **Wajib diisi:**
   - **Nama Handphone:** Nama lengkap produk (contoh: Samsung Galaxy A54 5G)
   - **Merk:** Brand handphone (contoh: Samsung)
   - **Harga:** Harga dalam rupiah (contoh: 5000000)
   - **Chipset (Skala 1-5):** Pilih skala performa chipset
     - 1: Sangat Rendah (entry-level)
     - 2: Rendah
     - 3: Sedang
     - 4: Tinggi
     - 5: Sangat Tinggi (flagship)
   - **RAM (GB):** Kapasitas RAM dalam GB (contoh: 8)
   - **Storage (GB):** Kapasitas penyimpanan (contoh: 128)
   - **Kamera (Skala 1-5):** Pilih skala kualitas kamera
     - 1: Sangat Rendah
     - 2: Rendah
     - 3: Sedang
     - 4: Tinggi
     - 5: Sangat Tinggi

   **Opsional:**
   - **Deskripsi:** Informasi tambahan tentang handphone
   - **Gambar:** Upload foto handphone
     - Format: JPG, JPEG, PNG
     - Ukuran maksimal: 2 MB
     - Resolusi direkomendasikan: 800x800px

3. Klik tombol **"Simpan"**
4. Jika berhasil, Anda akan melihat pesan sukses dan data muncul di list

#### C. Mengedit Data Handphone

1. Di list handphone, klik tombol **"Edit"** pada baris handphone yang ingin diubah
2. Form edit akan muncul dengan data yang sudah terisi
3. Ubah data yang diperlukan:
   - Semua field bisa diubah
   - Untuk mengganti gambar, upload file baru
   - Jika tidak upload gambar baru, gambar lama tetap digunakan
4. Klik tombol **"Update"**
5. Data akan diperbarui dan gambar lama (jika ada) akan terhapus otomatis saat upload gambar baru

#### D. Menghapus Handphone

1. Di list handphone, klik tombol **"Hapus"** (merah) pada baris yang ingin dihapus
2. Browser akan menampilkan konfirmasi: **"Yakin hapus handphone ini?"**
3. Klik **"OK"** untuk konfirmasi, atau **"Cancel"** untuk membatalkan
4. Data handphone dan gambarnya (jika ada) akan terhapus dari sistem

**⚠️ PERHATIAN:** Penghapusan data bersifat permanen dan tidak bisa dibatalkan!

---

### Dashboard Admin

Dashboard menampilkan:

- **Total Handphone:** Jumlah data handphone di database
- **Menu Cepat:**
  - Kelola Handphone: Link ke list data handphone
  - Lihat Website: Buka halaman publik (tab baru)

---

### Logout

1. Klik **"Logout"** di navbar admin (pojok kanan)
2. Anda akan diarahkan kembali ke halaman login
3. Session admin akan dihapus dari sistem

---

## Tips Penggunaan

### Untuk Pengguna Biasa

1. **Budget Realistis:**
   - Masukkan budget yang sesuai dengan harga pasar
   - Budget terlalu rendah akan menghasilkan hasil kosong

2. **Pilih Profil yang Tepat:**
   - Gaming: Jika prioritas main game
   - Fotografi: Jika prioritas kamera
   - Harian: Jika butuh handphone serba bisa

3. **Pahami Skor SAW:**
   - Skor mendekati 1.0000 = Sangat baik
   - Skor di bawah 0.5000 = Kurang ideal
   - Lihat tabel bobot kriteria di bawah hasil untuk memahami prioritas

### Untuk Administrator

1. **Konsistensi Data:**
   - Gunakan format nama yang konsisten (contoh: "Brand Model Series")
   - Harga selalu dalam rupiah tanpa koma/titik

2. **Skala Chipset & Kamera:**
   - Lakukan riset benchmark sebelum memberi skala
   - Jangan asal memberi nilai 5 untuk semua HP flagship
   - Perhatikan segmen pasar (entry, mid, flagship)

3. **Upload Gambar:**
   - Gunakan gambar berkualitas baik
   - Crop gambar agar fokus pada produk
   - Resize ke 800x800px sebelum upload (opsional, sistem auto-resize)
   - Hindari gambar dengan watermark besar

4. **Backup Data:**
   - Export database secara berkala via phpMyAdmin
   - Simpan backup gambar dari folder `public/images/handphones/`

---

## FAQ

### Pertanyaan Umum (Pengguna)

**Q: Kenapa tidak ada hasil rekomendasi?**  
A: Kemungkinan budget Anda terlalu rendah. Coba naikkan budget atau cek data handphone di admin panel.

**Q: Apakah bisa mencari handphone dengan budget unlimited?**  
A: Ya, masukkan angka sangat besar (contoh: 50000000 untuk 50 juta) untuk melihat semua HP terbaik tanpa batasan harga.

**Q: Apakah hasil ranking selalu sama?**  
A: Tidak. Hasil berubah sesuai budget dan profil yang dipilih. Profil berbeda = bobot berbeda = ranking berbeda.

**Q: Apa itu skor SAW?**  
A: Skor SAW (Simple Additive Weighting) adalah nilai 0-1 hasil perhitungan multi-kriteria. Semakin tinggi skor, semakin cocok HP dengan kebutuhan Anda.

### Pertanyaan Umum (Admin)

**Q: Kenapa upload gambar gagal?**  
A: Periksa:
- Ukuran file < 2MB
- Format JPG/JPEG/PNG
- Folder `public/images/handphones/` ada dan writable

**Q: Bisa upload gambar dari URL?**  
A: Tidak. Hanya upload file dari komputer lokal yang didukung.

**Q: Bagaimana cara mengganti password admin?**  
A: Lihat panduan di README.md bagian "Cara Ganti Password Admin".

**Q: Bisa menambah admin baru?**  
A: Saat ini hanya support single admin. Untuk menambah admin, insert manual ke tabel `admins` via phpMyAdmin.

**Q: Data HP yang dihapus bisa dikembalikan?**  
A: Tidak. Pastikan backup database sebelum menghapus data penting.

---

## Kontak & Dukungan

Untuk pertanyaan lebih lanjut atau melaporkan bug, silakan hubungi administrator sistem.

---

**Terakhir diperbarui:** 1 November 2024  
**Versi Aplikasi:** 1.0.0
