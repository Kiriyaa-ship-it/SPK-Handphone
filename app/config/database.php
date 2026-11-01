<?php
/**
 * Konfigurasi Database MySQL
 * Sistem Pendukung Keputusan Pemilihan Handphone
 */

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_NAME', 'spk_handphone');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Fungsi untuk membuat koneksi PDO ke database
 * 
 * @return PDO|null Mengembalikan objek PDO jika berhasil, null jika gagal
 */
function getDbConnection() {
    try {
        // DSN (Data Source Name) untuk MySQL
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        
        // Opsi PDO untuk kontrol error dan fetch mode
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Aktifkan exception untuk error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Default fetch sebagai array asosiatif
            PDO::ATTR_EMULATE_PREPARES   => false,                   // Gunakan prepared statement native
        ];
        
        // Buat koneksi PDO
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        return $pdo;
    } catch (PDOException $e) {
        // Tangkap error koneksi
        echo "Error Koneksi Database: " . $e->getMessage();
        return null;
    }
}

/**
 * Inisialisasi koneksi database global
 * Digunakan untuk akses database di seluruh aplikasi
 */
$db = getDbConnection();
