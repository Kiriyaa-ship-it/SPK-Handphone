<?php
/**
 * Model Admin
 * Mengelola data admin dan autentikasi
 */

class Admin {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Login admin
     * @param string $username
     * @param string $password
     * @return array|null Data admin jika berhasil
     */
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $admin = $stmt->fetch();
            
            if ($admin && password_verify($password, $admin['password'])) {
                unset($admin['password']); // Jangan return password hash
                return $admin;
            }
            
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    /**
     * Get admin by ID
     */
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT id, username, nama_lengkap FROM admins WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }
}
