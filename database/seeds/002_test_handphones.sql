-- ============================================================================
-- Seed Data: 10 Handphone untuk Testing Sistem SPK
-- ============================================================================
-- CATATAN PENTING:
-- 1. Data ini adalah SIMULASI untuk keperluan pengujian sistem.
-- 2. Spesifikasi berdasarkan referensi GSMArena (Oktober 2026).
-- 3. Harga adalah ESTIMASI untuk testing, bukan harga pasar aktual.
-- 4. Harga dihitung dari harga referensi 2024 dengan asumsi penurunan 20-26%.
-- ============================================================================

-- Bersihkan data lama (opsional, uncomment jika ingin reset)
-- DELETE FROM handphones WHERE id BETWEEN 1 AND 10;
-- ALTER TABLE handphones AUTO_INCREMENT = 1;

-- ============================================================================
-- INSERT DATA 10 HANDPHONE
-- ============================================================================

-- 1. Samsung Galaxy A35 5G (8/128GB)
-- Sumber: https://m.gsmarena.com/samsung_galaxy_a35-12705.php
-- Harga Ref: Rp 4.999.000 (Kompas.com, Maret 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Samsung Galaxy A35 5G',
    'Samsung',
    3799000,
    3,
    8,
    128,
    3,
    'Chipset: Exynos 1380 (5nm, AnTuTu ~520k) | Kamera: Triple - 50MP f/1.8 OIS (main) + 8MP f/2.2 123° UW + 5MP f/2.4 Macro | Display: 6.6" Super AMOLED 120Hz FHD+ | Baterai: 5000mAh 25W | Fitur: IP67, Gorilla Glass Victus+, Stereo Speaker | OS: Android 14 One UI 6'
);

-- 2. Xiaomi Redmi Note 13 Pro 5G (8/256GB)
-- Sumber: https://www.gsmarena.com/xiaomi_redmi_note_13_pro-12581.php
-- Harga Ref: Rp 4.999.000 (CNBC Indonesia, April 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Xiaomi Redmi Note 13 Pro 5G',
    'Xiaomi',
    3699000,
    4,
    8,
    256,
    5,
    'Chipset: Snapdragon 7s Gen 2 (4nm, AnTuTu ~600k) | Kamera: Triple - 200MP f/1.65 OIS Samsung HP3 (main) + 8MP f/2.2 UW + 2MP Macro | Display: 6.67" AMOLED 120Hz FHD+ 1800nits | Baterai: 5100mAh 67W | Fitur: IP54, Gorilla Glass Victus, Stereo Dolby Atmos | OS: Android 13 HyperOS'
);

-- 3. Poco X6 5G (8/256GB)
-- Sumber: https://gsmarena.com/xiaomi_poco_x6-12723.php
-- Harga Ref: Rp 3.499.000 (Tokopedia Official, Feb 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Poco X6 5G',
    'Poco',
    2699000,
    4,
    8,
    256,
    3,
    'Chipset: Snapdragon 7s Gen 2 (4nm, AnTuTu ~600k) | Kamera: Triple - 64MP f/1.79 OIS (main) + 8MP f/2.2 120° UW + 2MP Macro | Display: 6.67" AMOLED 120Hz FHD+ 1800nits | Baterai: 5100mAh 67W Turbo | Fitur: IP54, Gorilla Glass Victus, Quad Speaker Dolby Atmos | OS: Android 13 HyperOS'
);

-- 4. Samsung Galaxy A54 5G (8/256GB)
-- Sumber: https://www.gsmarena.com/samsung_galaxy_a54-12070.php
-- Harga Ref: Rp 4.800.000 (Tokopedia, 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Samsung Galaxy A54 5G',
    'Samsung',
    3599000,
    3,
    8,
    256,
    3,
    'Chipset: Exynos 1380 (5nm, AnTuTu ~507k) | Kamera: Triple - 50MP f/1.8 OIS 1/1.56" (main) + 12MP f/2.2 123° UW + 5MP f/2.4 Macro | Display: 6.4" Super AMOLED 120Hz FHD+ 1000nits | Baterai: 5000mAh 25W | Fitur: IP67, Gorilla Glass 5, Stereo Speaker | OS: Android 13 One UI 5.1'
);

-- 5. Infinix Note 40 Pro 5G (8/256GB)
-- Sumber: https://m.gsmarena.com/infinix_note_40_pro-12875.php
-- Harga Ref: Rp 3.299.000 (Tokopedia Official Infinix, Mei 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Infinix Note 40 Pro 5G',
    'Infinix',
    2499000,
    3,
    8,
    256,
    4,
    'Chipset: MediaTek Dimensity 7020 (6nm, AnTuTu ~485k) | Kamera: Triple - 108MP f/1.75 OIS 1/1.67" (main) + 2MP Depth + 2MP Macro | Display: 6.78" AMOLED 120Hz FHD+ | Baterai: 5000mAh 45W Wired + 20W Wireless | Fitur: IP53, JBL Stereo Speaker | OS: Android 14 XOS 14'
);

-- 6. Oppo Reno11 5G (8/128GB)
-- Sumber: https://www.gsmarena.com/oppo_reno11-12791.php
-- Harga Ref: Rp 5.599.000 (Blibli, Januari 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Oppo Reno11 5G',
    'Oppo',
    4199000,
    5,
    8,
    128,
    4,
    'Chipset: MediaTek Dimensity 7050 (6nm, AnTuTu ~806k) | Kamera: Triple - 50MP f/1.8 OIS (main) + 32MP f/2.0 Telephoto 2x OIS (portrait) + 8MP f/2.2 112° UW | Display: 6.7" AMOLED 120Hz FHD+ Curved 950nits | Baterai: 5000mAh 67W SuperVOOC | Fitur: IP54, Stereo Speaker | OS: Android 14 ColorOS 14'
);

-- 7. Vivo V30e 5G (8/128GB)
-- Sumber: https://gsmarena.com/vivo_v30e-12971.php
-- Harga Ref: Rp 4.699.000 (Vivo.com, Detik.com, Mei 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Vivo V30e 5G',
    'Vivo',
    3499000,
    4,
    8,
    128,
    3,
    'Chipset: Snapdragon 6 Gen 1 (4nm, AnTuTu ~737k) | Kamera: Dual - 50MP f/1.79 OIS Sony IMX882 (main) + 8MP f/2.2 120° UW | Display: 6.78" AMOLED 120Hz FHD+ Curved | Baterai: 5500mAh 44W FlashCharge | Fitur: IP54, Aura Light Portrait, Stereo Speaker | OS: Android 14 Funtouch OS 14'
);

-- 8. Nothing Phone (2a) (8/128GB)
-- Sumber: https://m.gsmarena.com/nothing_phone_(2a)-12760.php
-- Harga Ref: Rp 5.699.000 (Rancah Post, Maret 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Nothing Phone (2a)',
    'Nothing',
    4299000,
    4,
    8,
    128,
    4,
    'Chipset: MediaTek Dimensity 7200 Pro (4nm, AnTuTu ~707k) | Kamera: Dual - 50MP f/1.88 OIS Samsung GN9 (main) + 50MP f/2.2 114° UW | Display: 6.7" AMOLED 120Hz FHD+ 1300nits | Baterai: 5000mAh 45W | Fitur: IP54, Glyph Interface, Stereo Speaker | OS: Android 14 Nothing OS 2.5'
);

-- 9. Motorola Edge 50 Fusion (8/256GB)
-- Sumber: https://gsmarena.com/motorola_edge_50_fusion-12871.php
-- Harga Ref: Rp 5.999.000 (Mobile57, Rekomendasi HP, Mei 2024)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Motorola Edge 50 Fusion',
    'Motorola',
    4499000,
    4,
    8,
    256,
    4,
    'Chipset: Snapdragon 7s Gen 2 (4nm, AnTuTu ~600k) | Kamera: Dual - 50MP f/1.79 OIS Sony Lytia 700C (main) + 13MP f/2.2 120° UW Autofocus | Display: 6.7" pOLED 144Hz FHD+ Curved 1600nits | Baterai: 5000mAh 68W TurboPower + 15W Wireless | Fitur: IP68, Dolby Atmos | OS: Android 14 MyUX'
);

-- 10. Realme C55 (8/128GB)
-- Sumber: https://gsmarena.com/realme_c55-12159.php
-- Harga Ref: INR 13,999 ~Rp 2.5jt (Realme India, 2023)
INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi)
VALUES (
    'Realme C55',
    'Realme',
    2399000,
    2,
    8,
    128,
    2,
    'Chipset: MediaTek Helio G88 (12nm, AnTuTu ~273k) | Kamera: Dual - 64MP f/1.79 PDAF (main) + 2MP Depth | Display: 6.72" IPS LCD 90Hz FHD+ 680nits | Baterai: 5000mAh 33W SuperVOOC | Fitur: Mini Capsule (Dynamic Island-like), Side Fingerprint, Dirac Audio | OS: Android 13 Realme UI 4.0'
);

-- ============================================================================
-- VERIFIKASI DATA
-- ============================================================================

-- Tampilkan data yang baru diinsert
SELECT 
    id,
    nama,
    merk,
    CONCAT('Rp ', FORMAT(harga, 0, 'id_ID')) AS harga_format,
    CONCAT(ram_gb, '/', storage_gb, 'GB') AS varian,
    chipset_skala AS chip,
    kamera_skala AS cam
FROM handphones
ORDER BY id DESC
LIMIT 10;

-- ============================================================================
-- STATISTIK DATASET
-- ============================================================================

-- Distribusi berdasarkan Chipset Skala
SELECT 
    chipset_skala,
    COUNT(*) AS jumlah,
    CONCAT(ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM handphones), 1), '%') AS persentase
FROM handphones
GROUP BY chipset_skala
ORDER BY chipset_skala;

-- Distribusi berdasarkan Kamera Skala
SELECT 
    kamera_skala,
    COUNT(*) AS jumlah,
    CONCAT(ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM handphones), 1), '%') AS persentase
FROM handphones
GROUP BY kamera_skala
ORDER BY kamera_skala;

-- Distribusi berdasarkan Merek
SELECT 
    merk,
    COUNT(*) AS jumlah,
    MIN(harga) AS harga_termurah,
    MAX(harga) AS harga_termahal
FROM handphones
GROUP BY merk
ORDER BY jumlah DESC, merk;

-- Rentang Harga
SELECT 
    CASE
        WHEN harga < 3000000 THEN '< Rp 3 juta'
        WHEN harga BETWEEN 3000000 AND 3999999 THEN 'Rp 3-3.9 juta'
        WHEN harga BETWEEN 4000000 AND 5000000 THEN 'Rp 4-5 juta'
        ELSE '> Rp 5 juta'
    END AS rentang_harga,
    COUNT(*) AS jumlah
FROM handphones
GROUP BY 
    CASE
        WHEN harga < 3000000 THEN '< Rp 3 juta'
        WHEN harga BETWEEN 3000000 AND 3999999 THEN 'Rp 3-3.9 juta'
        WHEN harga BETWEEN 4000000 AND 5000000 THEN 'Rp 4-5 juta'
        ELSE '> Rp 5 juta'
    END
ORDER BY MIN(harga);

-- ============================================================================
-- CATATAN PENGGUNAAN:
-- ============================================================================
-- 1. Import file ini melalui phpMyAdmin > Import > Choose File
-- 2. Atau via MySQL command line:
--    mysql -u root -p spk_handphone < 002_test_handphones.sql
-- 3. Pastikan tabel 'handphones' sudah dibuat dengan migration 001
-- 4. Data akan langsung tersedia untuk testing sistem SAW
-- ============================================================================
