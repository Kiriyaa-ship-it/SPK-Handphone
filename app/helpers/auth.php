<?php
/**
 * Auth Helper
 * Fungsi-fungsi untuk autentikasi dan autorisasi
 */

/**
 * Cek apakah user sudah login sebagai admin
 * 
 * @return bool
 */
function isLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require login - redirect ke login jika belum login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        setFlash('error', 'Silakan login terlebih dahulu');
        redirect('admin/login');
    }
}

/**
 * Set user sebagai logged in
 * 
 * @param array $userData Data user (optional)
 */
function setLogin($userData = []) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_data'] = $userData;
}

/**
 * Logout user
 */
function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
}

/**
 * Get data user yang sedang login
 * 
 * @return array|null
 */
function getAuthUser() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin_data']) ? $_SESSION['admin_data'] : null;
}
