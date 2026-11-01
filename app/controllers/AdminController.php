<?php
/**
 * Admin Controller
 * Mengelola admin panel: login, dashboard, CRUD handphone
 */

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Handphone.php';

class AdminController extends BaseController {
    private $adminModel;
    private $handphoneModel;
    
    public function __construct() {
        parent::__construct();
        $this->adminModel = new Admin($this->db);
        $this->handphoneModel = new Handphone($this->db);
    }
    
    /**
     * Halaman login
     */
    public function login() {
        // Jika sudah login, redirect ke dashboard
        if (isLoggedIn()) {
            redirect('admin/dashboard');
        }
        
        if (isPost()) {
            $username = post('username');
            $password = $_POST['password'] ?? ''; // Password jangan di-sanitize
            $csrfToken = post('csrf_token');
            
            // Validasi CSRF
            if (!validateCSRFToken($csrfToken)) {
                setFlash('error', 'Token keamanan tidak valid');
                redirect('admin/login');
            }
            
            // Validasi input
            if (empty($username) || empty($password)) {
                setFlash('error', 'Username dan password harus diisi');
                redirect('admin/login');
            }
            
            // Coba login
            $admin = $this->adminModel->login($username, $password);
            
            if ($admin) {
                setLogin($admin);
                setFlash('success', 'Login berhasil');
                redirect('admin/dashboard');
            } else {
                setFlash('error', 'Username atau password salah');
                redirect('admin/login');
            }
        }
        
        $this->view('admin/login', [], false);
    }
    
    /**
     * Logout
     */
    public function logout() {
        logout();
        setFlash('success', 'Logout berhasil');
        redirect('admin/login');
    }
    
    /**
     * Dashboard admin
     */
    public function dashboard() {
        requireLogin();
        
        // Hitung statistik sederhana
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM handphones");
        $stats = $stmt->fetch();
        
        $this->view('admin/dashboard', [
            'totalHandphones' => $stats['total']
        ], false);
    }
    
    /**
     * List handphone
     */
    public function handphones() {
        requireLogin();
        
        $handphones = $this->handphoneModel->getAll();
        
        $this->view('admin/handphones/index', [
            'handphones' => $handphones
        ], false);
    }
    
    /**
     * Form tambah handphone
     */
    public function createHandphone() {
        requireLogin();
        
        if (isPost()) {
            $csrfToken = post('csrf_token');
            
            if (!validateCSRFToken($csrfToken)) {
                setFlash('error', 'Token keamanan tidak valid');
                redirect('admin/handphones/create');
            }
            
            $data = [
                'nama' => post('nama'),
                'merk' => post('merk'),
                'harga' => post('harga'),
                'chipset_skala' => post('chipset_skala'),
                'ram_gb' => post('ram_gb'),
                'storage_gb' => post('storage_gb'),
                'kamera_skala' => post('kamera_skala'),
                'deskripsi' => post('deskripsi')
            ];
            
            // Validasi
            $errors = $this->validateHandphoneData($data);
            if (!empty($errors)) {
                setFlash('error', implode('<br>', $errors));
                redirect('admin/handphones/create');
            }
            
            // Handle upload gambar
            $gambarFilename = null;
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['gambar']);
                if ($uploadResult['success']) {
                    $gambarFilename = $uploadResult['filename'];
                } else {
                    setFlash('error', $uploadResult['error']);
                    redirect('admin/handphones/create');
                }
            }
            
            // Insert ke database
            try {
                $stmt = $this->db->prepare("
                    INSERT INTO handphones (nama, merk, harga, chipset_skala, ram_gb, storage_gb, kamera_skala, deskripsi, gambar)
                    VALUES (:nama, :merk, :harga, :chipset_skala, :ram_gb, :storage_gb, :kamera_skala, :deskripsi, :gambar)
                ");
                $data['gambar'] = $gambarFilename;
                $stmt->execute($data);
                
                setFlash('success', 'Handphone berhasil ditambahkan');
                redirect('admin/handphones');
            } catch (PDOException $e) {
                // Hapus gambar jika insert gagal
                if ($gambarFilename) {
                    $this->deleteImage($gambarFilename);
                }
                setFlash('error', 'Gagal menambahkan handphone');
                redirect('admin/handphones/create');
            }
        }
        
        $this->view('admin/handphones/create', [], false);
    }
    
    /**
     * Form edit handphone
     */
    public function editHandphone($id) {
        requireLogin();
        
        $handphone = $this->handphoneModel->getById($id);
        if (!$handphone) {
            setFlash('error', 'Handphone tidak ditemukan');
            redirect('admin/handphones');
        }
        
        if (isPost()) {
            $csrfToken = post('csrf_token');
            
            if (!validateCSRFToken($csrfToken)) {
                setFlash('error', 'Token keamanan tidak valid');
                redirect('admin/handphones/edit/' . $id);
            }
            
            $data = [
                'id' => $id,
                'nama' => post('nama'),
                'merk' => post('merk'),
                'harga' => post('harga'),
                'chipset_skala' => post('chipset_skala'),
                'ram_gb' => post('ram_gb'),
                'storage_gb' => post('storage_gb'),
                'kamera_skala' => post('kamera_skala'),
                'deskripsi' => post('deskripsi')
            ];
            
            // Validasi
            $errors = $this->validateHandphoneData($data);
            if (!empty($errors)) {
                setFlash('error', implode('<br>', $errors));
                redirect('admin/handphones/edit/' . $id);
            }
            
            // Handle upload gambar baru
            $gambarFilename = $handphone['gambar']; // Keep old image by default
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['gambar']);
                if ($uploadResult['success']) {
                    // Delete old image
                    if ($handphone['gambar']) {
                        $this->deleteImage($handphone['gambar']);
                    }
                    $gambarFilename = $uploadResult['filename'];
                } else {
                    setFlash('error', $uploadResult['error']);
                    redirect('admin/handphones/edit/' . $id);
                }
            }
            
            // Update database
            try {
                $stmt = $this->db->prepare("
                    UPDATE handphones 
                    SET nama = :nama, merk = :merk, harga = :harga, 
                        chipset_skala = :chipset_skala, ram_gb = :ram_gb, 
                        storage_gb = :storage_gb, kamera_skala = :kamera_skala, 
                        deskripsi = :deskripsi, gambar = :gambar
                    WHERE id = :id
                ");
                $data['gambar'] = $gambarFilename;
                $stmt->execute($data);
                
                setFlash('success', 'Handphone berhasil diupdate');
                redirect('admin/handphones');
            } catch (PDOException $e) {
                setFlash('error', 'Gagal mengupdate handphone');
                redirect('admin/handphones/edit/' . $id);
            }
        }
        
        $this->view('admin/handphones/edit', [
            'handphone' => $handphone
        ], false);
    }
    
    /**
     * Hapus handphone
     */
    public function deleteHandphone($id) {
        requireLogin();
        
        if (!isPost()) {
            setFlash('error', 'Method tidak valid');
            redirect('admin/handphones');
        }
        
        $csrfToken = post('csrf_token');
        if (!validateCSRFToken($csrfToken)) {
            setFlash('error', 'Token keamanan tidak valid');
            redirect('admin/handphones');
        }
        
        try {
            // Get image filename before delete
            $handphone = $this->handphoneModel->getById($id);
            
            $stmt = $this->db->prepare("DELETE FROM handphones WHERE id = :id");
            $stmt->execute(['id' => $id]);
            
            // Delete image file if exists
            if ($handphone && $handphone['gambar']) {
                $this->deleteImage($handphone['gambar']);
            }
            
            setFlash('success', 'Handphone berhasil dihapus');
        } catch (PDOException $e) {
            setFlash('error', 'Gagal menghapus handphone');
        }
        
        redirect('admin/handphones');
    }
    
    /**
     * Validasi data handphone
     */
    private function validateHandphoneData($data) {
        $errors = [];
        
        if (empty($data['nama'])) $errors[] = 'Nama handphone harus diisi';
        if (empty($data['merk'])) $errors[] = 'Merk harus diisi';
        if (!isNumeric($data['harga'])) $errors[] = 'Harga harus berupa angka positif';
        if (!in_array($data['chipset_skala'], [1,2,3,4,5])) $errors[] = 'Chipset skala harus 1-5';
        if (!isNumeric($data['ram_gb'])) $errors[] = 'RAM harus berupa angka positif';
        if (!isNumeric($data['storage_gb'])) $errors[] = 'Storage harus berupa angka positif';
        if (!in_array($data['kamera_skala'], [1,2,3,4,5])) $errors[] = 'Kamera skala harus 1-5';
        
        return $errors;
    }
    
    /**
     * Handle upload gambar
     * @return array ['success' => bool, 'filename' => string, 'error' => string]
     */
    private function handleImageUpload($file) {
        $uploadDir = __DIR__ . '/../../public/images/handphones/';
        
        // Validasi error upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Gagal upload file'];
        }
        
        // Validasi ukuran (max 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return ['success' => false, 'error' => 'Ukuran file maksimal 2MB'];
        }
        
        // Validasi MIME type
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, $allowedMimes)) {
            return ['success' => false, 'error' => 'Format file harus JPG, JPEG, atau PNG'];
        }
        
        // Validasi extension
        $allowedExts = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowedExts)) {
            return ['success' => false, 'error' => 'Ekstensi file harus jpg, jpeg, atau png'];
        }
        
        // Generate unique filename
        $filename = uniqid('hp_') . '_' . time() . '.' . $ext;
        $targetPath = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'filename' => $filename];
        } else {
            return ['success' => false, 'error' => 'Gagal menyimpan file'];
        }
    }
    
    /**
     * Delete image file
     */
    private function deleteImage($filename) {
        if (empty($filename)) return;
        
        $filePath = __DIR__ . '/../../public/images/handphones/' . $filename;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
}
