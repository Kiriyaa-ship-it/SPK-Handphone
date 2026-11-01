<?php
/**
 * Helper Functions
 * Fungsi-fungsi bantuan umum untuk aplikasi
 */

/**
 * Redirect ke URL tertentu
 * 
 * @param string $path Path tujuan (relatif dari base URL)
 */
function redirect($path = '') {
    $baseUrl = getBaseUrl();
    header("Location: {$baseUrl}/{$path}");
    exit;
}

/**
 * Mendapatkan base URL aplikasi
 * Menangani subfolder XAMPP: /SPK-Handphone/public/
 * 
 * @return string Base URL
 */
function getBaseUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME'];
    
    // Ambil path folder dari script name
    // /SPK-Handphone/public/index.php → /SPK-Handphone/public
    $basePath = str_replace('\\', '/', dirname($scriptName));
    
    return $protocol . '://' . $host . $basePath;
}

/**
 * Sanitize input untuk keamanan
 * 
 * @param string $data Input data
 * @return string Sanitized data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validasi input numerik
 * 
 * @param mixed $value Nilai yang akan divalidasi
 * @return bool
 */
function isNumeric($value) {
    return is_numeric($value) && $value > 0;
}

/**
 * Format rupiah
 * 
 * @param int $number Angka
 * @return string Format Rupiah
 */
function formatRupiah($number) {
    return 'Rp ' . number_format($number, 0, ',', '.');
}

/**
 * Cek apakah request adalah POST
 * 
 * @return bool
 */
function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Cek apakah request adalah GET
 * 
 * @return bool
 */
function isGet() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Get POST data dengan sanitasi
 * 
 * @param string $key Key dari POST data
 * @param mixed $default Nilai default jika tidak ada
 * @return mixed
 */
function post($key, $default = '') {
    return isset($_POST[$key]) ? sanitize($_POST[$key]) : $default;
}

/**
 * Get GET data dengan sanitasi
 * 
 * @param string $key Key dari GET data
 * @param mixed $default Nilai default jika tidak ada
 * @return mixed
 */
function get($key, $default = '') {
    return isset($_GET[$key]) ? sanitize($_GET[$key]) : $default;
}

/**
 * Set flash message ke session
 * 
 * @param string $type Type pesan (success, error, warning, info)
 * @param string $message Isi pesan
 */
function setFlash($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Get dan hapus flash message dari session
 * 
 * @return array|null Flash message atau null
 */
function getFlash() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    
    return null;
}

/**
 * Debug helper - var_dump dengan format
 * 
 * @param mixed $data Data yang akan di-dump
 */
function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

/**
 * Get asset URL
 * 
 * @param string $path Path asset (css/style.css, js/script.js, dll)
 * @return string Full URL asset
 */
function asset($path) {
    return getBaseUrl() . '/' . ltrim($path, '/');
}

/**
 * Generate URL untuk route tertentu
 * 
 * @param string $path Path route
 * @return string Full URL
 */
function url($path = '') {
    return getBaseUrl() . '/' . ltrim($path, '/');
}
