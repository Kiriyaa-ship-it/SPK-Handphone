-- =====================================================
-- Sistem Pendukung Keputusan Pemilihan Handphone
-- Database Seed 001: Initial Data
-- =====================================================

-- =====================================================
-- Seed Data: Tabel criterias (Kriteria SAW)
-- =====================================================
INSERT INTO criterias (kode, nama, sifat, keterangan) VALUES
('C1', 'Harga', 'Cost', 'Semakin murah harganya, semakin baik'),
('C2', 'Performa Chipset', 'Benefit', 'Penilaian manual oleh admin berdasarkan benchmark'),
('C3', 'RAM Fisik', 'Benefit', 'Ditransformasi dari kapasitas RAM fisik (1-5)'),
('C4', 'Penyimpanan Internal', 'Benefit', 'Ditransformasi dari kapasitas penyimpanan internal (1-5)'),
('C5', 'Kualitas Kamera', 'Benefit', 'Penilaian manual oleh admin berdasarkan spesifikasi & ulasan');

-- =====================================================
-- Seed Data: Tabel profiles (Profil Kebutuhan)
-- =====================================================
INSERT INTO profiles (nama, deskripsi) VALUES
('Gaming', 'Profil untuk pengguna yang memprioritaskan performa gaming dengan chipset yang kuat dan RAM besar'),
('Photography', 'Profil untuk pengguna yang memprioritaskan kualitas kamera dan penyimpanan untuk fotografi profesional'),
('Daily', 'Profil untuk pengguna umum yang membutuhkan keseimbangan antara harga, performa, dan fitur sehari-hari');

-- =====================================================
-- Seed Data: Tabel profile_weights (Bobot Kriteria per Profil)
-- =====================================================

-- Profil Gaming: C1=0.15, C2=0.40, C3=0.20, C4=0.10, C5=0.15 (Total=1.00)
INSERT INTO profile_weights (profile_id, criteria_id, bobot) VALUES
(1, 1, 0.15),  -- Gaming - Harga (C1)
(1, 2, 0.40),  -- Gaming - Chipset (C2)
(1, 3, 0.20),  -- Gaming - RAM (C3)
(1, 4, 0.10),  -- Gaming - Storage (C4)
(1, 5, 0.15);  -- Gaming - Kamera (C5)

-- Profil Photography: C1=0.15, C2=0.15, C3=0.10, C4=0.15, C5=0.45 (Total=1.00)
INSERT INTO profile_weights (profile_id, criteria_id, bobot) VALUES
(2, 1, 0.15),  -- Photography - Harga (C1)
(2, 2, 0.15),  -- Photography - Chipset (C2)
(2, 3, 0.10),  -- Photography - RAM (C3)
(2, 4, 0.15),  -- Photography - Storage (C4)
(2, 5, 0.45);  -- Photography - Kamera (C5)

-- Profil Daily: C1=0.30, C2=0.15, C3=0.20, C4=0.15, C5=0.20 (Total=1.00)
INSERT INTO profile_weights (profile_id, criteria_id, bobot) VALUES
(3, 1, 0.30),  -- Daily - Harga (C1)
(3, 2, 0.15),  -- Daily - Chipset (C2)
(3, 3, 0.20),  -- Daily - RAM (C3)
(3, 4, 0.15),  -- Daily - Storage (C4)
(3, 5, 0.20);  -- Daily - Kamera (C5)

-- =====================================================
-- End of Seed 001
-- =====================================================
