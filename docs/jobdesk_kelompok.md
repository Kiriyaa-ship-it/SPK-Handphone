# Pembagian Tugas Kelompok - Projek SPK Handphone (Metode SAW)

Projek Sistem Pendukung Keputusan (SPK) Pemilihan Handphone menggunakan metode *Simple Additive Weighting* (SAW) ini dikembangkan secara kolaboratif oleh tim yang terdiri dari 4 orang.

## Struktur Tim dan Jobdesk

### 1. Ketua Kelompok & Backend/Database Developer
* **Nama / Peran:** Yosi
* **Tanggung Jawab:**
  * Memimpin koordinasi dan pembagian tugas tim.
  * Membangun arsitektur dasar *Model-View-Controller* (MVC) PHP Native.
  * Merancang dan mengelola database MySQL (`spk_handphone`) beserta koneksi PDO.
  * Mengimplementasikan logika inti dan algoritma perhitungan metode SAW (normalisasi matriks keputusan dan perangkingan preferensi).

### 2. System Analyst & UI/UX Designer
* **Nama / Peran:** Moklas
* **Tanggung Jawab:**
  * Menganalisis kebutuhan sistem dan alur fungsionalitas aplikasi.
  * Menentukan daftar kriteria (Harga, Chipset, RAM, Penyimpanan, Kamera) beserta bobotnya.
  * Merancang konsep antarmuka (UI/UX) dengan tema *Dark Gaming / Cyberpunk*.
  * Memastikan estetika visual dan konsistensi desain di berbagai halaman.

### 3. Frontend Developer
* **Nama / Peran:** Getar
* **Tanggung Jawab:**
  * Mengimplementasikan desain antarmuka ke dalam kode HTML, CSS, dan JavaScript.
  * Mengembangkan halaman utama (Hero Section, Features), halaman kriteria, alternatif, dan form perhitungan rekomendasi.
  * Memberikan efek visual, animasi interaktif, dan memastikan tampilan responsif di perangkat desktop maupun *mobile*.

### 4. QA Tester & Dokumentasi
* **Peran:** Vito
* **Tanggung Jawab:**
  * Melakukan pengujian (*testing*) fungsionalitas sistem secara menyeluruh.
  * Memverifikasi akurasi hasil perhitungan metode SAW pada modul rekomendasi.
  * Mendokumentasikan proses pengembangan, menangani pelaporan *bug*, dan menyusun laporan akhir proyek kelompok.

---

## Alur Kerja dan Timeline Proyek (1 Semester / 16 Minggu)

Progres pengerjaan proyek selama satu semester dibagi menjadi 4 tahap utama:

### Tahap 1: Inisiasi, Analisis, & Perancangan (Minggu 1 - 4)
* **System Analyst & UI/UX:** Studi literatur metode SAW, analisis kebutuhan pengguna, penentuan kriteria dan bobot, serta pembuatan wireframe/mockup UI tema *Dark Gaming*.
* **Ketua / Backend:** Perancangan ERD (Entity Relationship Diagram), struktur database MySQL, dan inisiasi kerangka struktur folder proyek PHP Native (MVC).
* **Luaran (Milestones):** Proposal proyek, spesifikasi kebutuhan sistem, skema database awal, dan rancangan UI/UX.

### Tahap 2: Pengembangan Core & Desain Visual (Minggu 5 - 8)
* **Ketua / Backend:** Pembuatan class database PDO, base model, base controller, serta implementasi CRUD kriteria dan alternatif handphone.
* **Frontend Developer:** Pembuatan layout dasar, CSS global, komponen navbar/footer, dan implementasi hero section / halaman utama.
* **Luaran (Milestones):** Koneksi database stabil, arsitektur MVC berjalan, dan halaman utama dasar terbangun.

### Tahap 3: Implementasi Logika SAW & Integrasi Frontend (Minggu 9 - 12)
* **Ketua / Backend:** Pengembangan algoritma inti SAW (perhitungan matriks ternormalisasi $R$, perkalian bobot $W$, dan perangkingan nilai preferensi $V$).
* **Frontend Developer:** Integrasi form input preferensi pengguna, halaman hasil rekomendasi, tabel alternatif, dan penyempurnaan animasi UI/UX responsif.
* **Luaran (Milestones):** Sistem perhitungan SAW berfungsi penuh dan antarmuka web terhubung dengan backend.

### Tahap 4: Pengujian, Evaluasi, & Dokumentasi Akhir (Minggu 13 - 16)
* **QA Tester & Dokumentasi:** Pengujian sistem (*black-box* & validasi hasil perhitungan SAW), identifikasi dan perbaikan *bug*, serta penyusunan laporan kemajuan (progres) mingguan dan laporan akhir kelompok.
* **Seluruh Tim:** Evaluasi akhir proyek, *code review*, dan persiapan presentasi/demontrasi sistem.
* **Luaran (Milestones):** Aplikasi siap rilis, laporan lengkap per anggota, dan dokumentasi proyek akhir 1 semester.
