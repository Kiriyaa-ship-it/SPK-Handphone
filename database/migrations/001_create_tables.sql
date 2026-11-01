-- =====================================================
-- Sistem Pendukung Keputusan Pemilihan Handphone
-- Database Schema Migration 001: Create Tables
-- =====================================================

-- Tabel: handphones (Alternatif Handphone)
-- Menyimpan spesifikasi handphone dan nilai kriteria untuk perhitungan SAW
CREATE TABLE handphones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    merk VARCHAR(50) NOT NULL,
    harga INT NOT NULL,
    chipset_skala INT NOT NULL CHECK (chipset_skala BETWEEN 1 AND 5),
    ram_gb INT NOT NULL,
    storage_gb INT NOT NULL,
    kamera_skala INT NOT NULL CHECK (kamera_skala BETWEEN 1 AND 5),
    gambar VARCHAR(255) NULL,
    deskripsi TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_merk (merk),
    INDEX idx_harga (harga)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel: criterias (Kriteria SAW)
-- Menyimpan definisi kriteria penilaian (C1 s.d. C5)
CREATE TABLE criterias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode VARCHAR(5) NOT NULL UNIQUE,
    nama VARCHAR(50) NOT NULL,
    sifat ENUM('Cost', 'Benefit') NOT NULL,
    keterangan TEXT NULL,
    INDEX idx_kode (kode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel: profiles (Profil Kebutuhan Pengguna)
-- Menyimpan profil prioritas kebutuhan pengguna (Gaming, Fotografi, Harian)
CREATE TABLE profiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel: profile_weights (Bobot Kriteria per Profil)
-- Relasi many-to-many antara profiles dan criterias
-- Menyimpan bobot setiap kriteria untuk setiap profil
CREATE TABLE profile_weights (
    id INT PRIMARY KEY AUTO_INCREMENT,
    profile_id INT NOT NULL,
    criteria_id INT NOT NULL,
    bobot DECIMAL(3, 2) NOT NULL CHECK (bobot >= 0.00 AND bobot <= 1.00),
    UNIQUE KEY uk_profile_criteria (profile_id, criteria_id),
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (criteria_id) REFERENCES criterias(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_profile_id (profile_id),
    INDEX idx_criteria_id (criteria_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- End of Migration 001
-- =====================================================
