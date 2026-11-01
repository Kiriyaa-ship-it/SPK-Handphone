<?php
/**
 * Base Controller
 * Parent class untuk semua controller
 */

class BaseController {
    protected $db;
    
    /**
     * Constructor
     */
    public function __construct() {
        // Load database connection
        require_once __DIR__ . '/../config/database.php';
        $this->db = getDbConnection();
        
        // Start session jika belum
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Render view
     * 
     * @param string $view Path ke view file (tanpa .php)
     * @param array $data Data yang akan di-pass ke view
     * @param bool $useLayout Gunakan layout atau tidak
     */
    protected function view($view, $data = [], $useLayout = true) {
        // Extract data agar bisa diakses langsung di view
        extract($data);
        
        // Load layout header jika useLayout = true
        if ($useLayout) {
            require_once __DIR__ . '/../../views/layout/header.php';
        }
        
        // Load view
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View tidak ditemukan: {$view}");
        }
        
        // Load layout footer jika useLayout = true
        if ($useLayout) {
            require_once __DIR__ . '/../../views/layout/footer.php';
        }
    }
    
    /**
     * Return JSON response
     * 
     * @param array $data Data yang akan di-return
     * @param int $statusCode HTTP status code
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Validasi CSRF token (untuk future implementation)
     * 
     * @return bool
     */
    protected function validateCSRF() {
        // Untuk saat ini return true
        // Implementasi CSRF bisa ditambahkan di FASE 4
        return true;
    }
}
