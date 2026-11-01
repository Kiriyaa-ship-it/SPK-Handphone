<?php
/**
 * Entry Point - SPK Handphone
 * Simple Router untuk menangani request
 */

// Error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load helpers
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/helpers/security.php';

// Set security headers
setSecurityHeaders();

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get request URI dan method
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string
$requestUri = strtok($requestUri, '?');

// Remove base path (/SPK-Handphone/public)
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$route = str_replace($basePath, '', $requestUri);
$route = '/' . trim($route, '/');

// Router Logic
switch ($route) {
    case '/':
    case '/home':
        require_once __DIR__ . '/../app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    
    case '/rekomendasi':
        require_once __DIR__ . '/../app/controllers/RecommendationController.php';
        $controller = new RecommendationController();
        $controller->index();
        break;
    
    case '/rekomendasi/proses':
        require_once __DIR__ . '/../app/controllers/RecommendationController.php';
        $controller = new RecommendationController();
        $controller->calculate();
        break;

    // ========================================
    // TEST PAGES (existing)
    // ========================================
    case '/test_db.php':
        require_once __DIR__ . '/test_db.php';
        break;
    
    case '/test_models.php':
        require_once __DIR__ . '/test_models.php';
        break;
    
    case '/test_saw_service.php':
        require_once __DIR__ . '/test_saw_service.php';
        break;
    
    // ========================================
    // ADMIN ROUTES (FASE 3)
    // ========================================
    case '/admin':
    case '/admin/dashboard':
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->dashboard();
        break;
    
    case '/admin/login':
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->login();
        break;
    
    case '/admin/logout':
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->logout();
        break;
    
    case '/admin/handphones':
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->handphones();
        break;
    
    case '/admin/handphones/create':
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->createHandphone();
        break;
    
    // ========================================
    // 404 NOT FOUND
    // ========================================
    default:
        // Handle dynamic routes dengan ID
        if (preg_match('#^/admin/handphones/edit/(\d+)$#', $route, $matches)) {
            require_once __DIR__ . '/../app/controllers/BaseController.php';
            require_once __DIR__ . '/../app/controllers/AdminController.php';
            $controller = new AdminController();
            $controller->editHandphone($matches[1]);
            break;
        }
        
        if (preg_match('#^/admin/handphones/delete/(\d+)$#', $route, $matches)) {
            require_once __DIR__ . '/../app/controllers/BaseController.php';
            require_once __DIR__ . '/../app/controllers/AdminController.php';
            $controller = new AdminController();
            $controller->deleteHandphone($matches[1]);
            break;
        }
        
        // 404
        http_response_code(404);
        require_once __DIR__ . '/../app/controllers/BaseController.php';
        // Fallback simple 404 view
        echo '<!DOCTYPE html>';
        echo '<html lang="id">';
        echo '<head><meta charset="UTF-8"><title>404 - Not Found</title></head>';
        echo '<body style="font-family: sans-serif; text-align: center; padding: 50px;">';
        echo '<h1 style="color: #ef4444;">404 - Halaman Tidak Ditemukan</h1>';
        echo '<p>Rute: <code>' . htmlspecialchars($route) . '</code></p>';
        echo '<p><a href="' . url() . '">Kembali ke Beranda</a></p>';
        echo '</body></html>';
        break;
}

