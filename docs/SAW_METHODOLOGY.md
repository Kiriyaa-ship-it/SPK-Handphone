# METODOLOGI SIMPLE ADDITIVE WEIGHTING (SAW)
## Sistem Pendukung Keputusan Pemilihan Handphone

### 1. Pendahuluan
Dokumen ini menjelaskan penerapan metode **Simple Additive Weighting (SAW)** dalam Sistem Pendukung Keputusan (SPK) Pemilihan Handphone. Metode SAW dikenal juga sebagai metode penjumlahan terbobot, yang mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif di seluruh kriteria.

---

### 2. Pre-Filtering (Penyaringan Anggaran)
Sebelum proses perhitungan perhitungan metode SAW dijalankan, sistem melakukan langkah penyaringan (*pre-filtering*):
* Handphone dengan harga yang **melebihi batas anggaran (budget)** yang diinput oleh pengguna akan **dikeluarkan** dari kandidat alternatif.
* Perhitungan normalisasi dan pemeringkatan SAW hanya dilakukan terhadap alternatif handphone yang harganya kurang dari atau sama dengan anggaran pengguna.

---

### 3. Kriteria Penilaian
Sistem menggunakan 5 kriteria penilaian utama:

| Kode | Kriteria | Sifat (Type) | Skala Nilai | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| **C1** | Harga | **Cost** | Nilai Asli (Rupiah) | Semakin murah harganya, semakin baik |
| **C2** | Performa Chipset | **Benefit** | Skala 1 – 5 | Penilaian manual oleh admin berdasarkan benchmark |
| **C3** | RAM Fisik | **Benefit** | Skala 1 – 5 | Ditransformasi dari kapasitas RAM fisik |
| **C4** | Penyimpanan Internal | **Benefit** | Skala 1 – 5 | Ditransformasi dari kapasitas penyimpanan internal |
| **C5** | Kualitas Kamera | **Benefit** | Skala 1 – 5 | Penilaian manual oleh admin berdasarkan spesifikasi & ulasan |

---

### 4. Skala Penilaian Kriteria Terstruktur

#### 4.1 Skala RAM Fisik (C3)
Aturan transformasi kapasitas RAM fisik ke skala 1 – 5, termasuk aturan penanganan kapasitas di antara kategori standar (pembulatan ke kategori terdekat/bawah):
* $\le$ 3 GB : **1**
* 4 GB s.d. 5 GB : **2**
* 6 GB s.d. 7 GB : **3**
* 8 GB s.d. 11 GB : **4**
* $\ge$ 12 GB : **5**

#### 4.2 Skala Penyimpanan Internal (C4)
Aturan transformasi kapasitas penyimpanan internal ke skala 1 – 5, termasuk aturan penanganan kapasitas di antara kategori standar:
* < 64 GB (misal 16 GB, 32 GB) : **1**
* 64 GB s.d. < 128 GB (misal 64 GB) : **2**
* 128 GB s.d. < 256 GB (misal 128 GB) : **3**
* 256 GB s.d. < 512 GB (misal 256 GB) : **4**
* $\ge$ 512 GB : **5**

#### 4.3 Penilaian Manual Admin (C2 & C5)
* **Chipset (C2)** dan **Kamera (C5)** dinilai secara manual oleh admin dengan memberikan nilai skala 1 hingga 5 berdasarkan referensi spesifikasi teknis dan benchmark yang relevan (seperti skor benchmark prosesor dan konfigurasi sensor/kualitas kamera).

---

### 5. Bobot Kriteria Berdasarkan Profil Kebutuhan
Bobot kriteria disesuaikan dengan prioritas kebutuhan yang dipilih oleh pengguna. Seluruh bobot pada setiap profil telah dipastikan berjumlah tepat **1,00 (100%)**:

| Profil Kebutuhan | C1 (Harga) | C2 (Chipset) | C3 (RAM) | C4 (Penyimpanan) | C5 (Kamera) | Total Bobot |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **Gaming** | 15% (0.15) | 40% (0.40) | 20% (0.20) | 10% (0.10) | 15% (0.15) | **100% (1.00)** |
| **Fotografi** | 15% (0.15) | 15% (0.15) | 10% (0.10) | 15% (0.15) | 45% (0.45) | **100% (1.00)** |
| **Harian** | 30% (0.30) | 15% (0.15) | 20% (0.20) | 15% (0.15) | 20% (0.20) | **100% (1.00)** |

---

### 6. Rumus Perhitungan SAW

#### 6.1 Normalisasi Matriks ($r_{ij}$)
Rumus normalisasi kinerja alternatif $x_{ij}$ ke nilai ternormalisasi $r_{ij}$:

* **Kriteria Benefit** (C2, C3, C4, C5 - termasuk Kualitas Kamera):
  $$r_{ij} = \frac{x_{ij}}{\max_j(x_{ij})}$$

* **Kriteria Cost** (C1 - Harga):
  $$r_{ij} = \frac{\min_j(x_{ij})}{x_{ij}}$$

**Ketentuan Nilai Ekstrem ($\min$ dan $\max$):**
* Nilai $\max_j(x_{ij})$ untuk seluruh kriteria benefit (C2, C3, C4, C5 termasuk kamera) dan $\min_j(x_{ij})$ untuk kriteria cost (C1) **wajib diambil dari subset alternatif yang lolos tahap pre-filtering anggaran**, bukan dari keseluruhan data mentah di database. Hal ini memastikan proses normalisasi mencerminkan perbandingan relatif yang objektif di antara handphone yang valid sebagai kandidat bagi pengguna.

**Keterangan Notasi:**
* $x_{ij}$ = Nilai alternatif ke-$i$ pada kriteria ke-$j$.
* $\max_j(x_{ij})$ = Nilai tertinggi dari seluruh alternatif yang **lolos filter anggaran** pada kriteria ke-$j$ (berlaku untuk semua kriteria benefit: C2, C3, C4, C5).
* $\min_j(x_{ij})$ = Nilai terendah dari seluruh alternatif yang **lolos filter anggaran** pada kriteria ke-$j$ (berlaku untuk kriteria cost: C1).
* $r_{ij}$ = Nilai ternormalisasi dari alternatif ke-$i$ pada kriteria ke-$j$.

#### 6.2 Perhitungan Nilai Preferensi / Akhir ($V_i$)
$$V_i = \sum_{j=1}^{n} (w_j \times r_{ij})$$

**Keterangan:**
* $V_i$ = Nilai akhir/preferensi alternatif ke-$i$.
* $w_j$ = Bobot kriteria ke-$j$ sesuai profil kebutuhan yang dipilih.
* $r_{ij}$ = Nilai ternormalisasi kriteria ke-$j$ pada alternatif ke-$i$.

Alternatif dengan nilai $V_i$ terbesar merupakan hasil rekomendasi terbaik.

---

### 7. Contoh Perhitungan Sederhana

#### Skenario:
* **Anggaran Pengguna:** Rp 3.500.000
* **Profil Kebutuhan:** Gaming ($w = [0.15, 0.40, 0.20, 0.10, 0.15]$)

#### Data Alternatif Awal (Sebelum Filter):
1. **HP A:** Harga Rp 2.500.000, Chipset Skala 3, RAM 6 GB (Skala 3), Storage 128 GB (Skala 3), Kamera Skala 3.
2. **HP B:** Harga Rp 3.200.000, Chipset Skala 4, RAM 8 GB (Skala 4), Storage 256 GB (Skala 4), Kamera Skala 3.
3. **HP C:** Harga Rp 4.500.000, Chipset Skala 5, RAM 12 GB (Skala 5), Storage 256 GB (Skala 4), Kamera Skala 5.

#### Langkah 1: Pre-Filtering Anggaran
* **HP C (Rp 4.500.000)** dieliminasi karena melebihi anggaran Rp 3.500.000.
* Kandidat alternatif yang lolos dan diproses: **HP A** dan **HP B**.

#### Langkah 2: Matriks Keputusan ($X$) dari Alternatif yang Lolos Filter
| Alternatif | C1 (Harga) | C2 (Chipset) | C3 (RAM) | C4 (Storage) | C5 (Kamera) |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **HP A** | 2.500.000 | 3 | 3 | 3 | 3 |
| **HP B** | 3.200.000 | 4 | 4 | 4 | 3 |

**Nilai Ekstrem (Berdasarkan Alternatif yang Lolos Filter):**
* $\min(C1) = 2.500.000$ (dari HP A)
* $\max(C2) = 4$ (dari HP B)
* $\max(C3) = 4$ (dari HP B)
* $\max(C4) = 4$ (dari HP B)
* $\max(C5) = 3$ (dari HP A & HP B)

#### Langkah 3: Matriks Normalisasi ($R$)
* **HP A:**
  * $r_{11} \text{ (Cost)} = \frac{2.500.000}{2.500.000} = 1.0000$
  * $r_{12} \text{ (Benefit - Chipset)} = \frac{3}{4} = 0.7500$
  * $r_{13} \text{ (Benefit - RAM)} = \frac{3}{4} = 0.7500$
  * $r_{14} \text{ (Benefit - Storage)} = \frac{3}{4} = 0.7500$
  * $r_{15} \text{ (Benefit - Kamera)} = \frac{3}{3} = 1.0000$

* **HP B:**
  * $r_{21} \text{ (Cost)} = \frac{2.500.000}{3.200.000} \approx 0.7813$ (atau eksak $0.78125$)
  * $r_{22} \text{ (Benefit - Chipset)} = \frac{4}{4} = 1.0000$
  * $r_{23} \text{ (Benefit - RAM)} = \frac{4}{4} = 1.0000$
  * $r_{24} \text{ (Benefit - Storage)} = \frac{4}{4} = 1.0000$
  * $r_{25} \text{ (Benefit - Kamera)} = \frac{3}{3} = 1.0000$

#### Langkah 4: Perhitungan Nilai Preferensi ($V_i$)
* **HP A:**
  $$V_A = (0.15 \times 1.0000) + (0.40 \times 0.7500) + (0.20 \times 0.7500) + (0.10 \times 0.7500) + (0.15 \times 1.0000)$$
  $$V_A = 0.1500 + 0.3000 + 0.1500 + 0.0750 + 0.1500 = 0.8250$$

* **HP B:**
  $$V_B = (0.15 \times 0.78125) + (0.40 \times 1.0000) + (0.20 \times 1.0000) + (0.10 \times 1.0000) + (0.15 \times 1.0000)$$
  $$V_B = 0.1171875 + 0.4000 + 0.2000 + 0.1000 + 0.1500 = 0.9671875 \approx 0.9672$$

#### Langkah 5: Hasil Pemeringkatan
1. **Peringkat 1:** HP B ($V = 0.9672$)
2. **Peringkat 2:** HP A ($V = 0.8250$)

**Rekomendasi Utama:** HP B.

---

### 8. Catatan Keputusan yang Belum Ditentukan (Untuk Dibahas Lebih Lanjut)
1. **Rubrik Acuan Penilaian Admin:** Belum ada panduan kuantitatif/rentang baku bagi admin saat menentukan skala 1–5 untuk Chipset dan Kamera (misalnya batas skor AnTuTu/Geekbench untuk tiap level skala).
2. **Penanganan Hasil Kosong (Empty Result):** Mekanisme sistem jika seluruh alternatif handphone tereliminasi akibat filter anggaran (apakah menampilkan pesan warning, menyarankan kenaikan anggaran, atau menampilkan opsi terdekat).
3. **Pembulatan Desimal:** Keputusan presisi desimal untuk nilai normalisasi dan preferensi akhir (misalnya dibulatkan hingga 4 angka di belakang koma).
