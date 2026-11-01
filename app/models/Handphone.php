<?php
/**
 * Model Handphone
 * Mengelola data handphone dari database
 */

class Handphone {
    private $db;
    
    /**
     * Constructor
     * @param PDO $db Objek koneksi database PDO
     */
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Mengambil semua data handphone
     * 
     * @return array Array berisi semua data handphone
     */
    public function getAll() {
        try {
            $query = "SELECT * FROM handphones ORDER BY nama ASC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error getAll(): " . $e->getMessage();
            return [];
        }
    }
    
    /**
     * Mengambil detail handphone berdasarkan ID
     * 
     * @param int $id ID handphone
     * @return array|null Array berisi data handphone atau null jika tidak ditemukan
     */
    public function getById($id) {
        try {
            $query = "SELECT * FROM handphones WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error getById(): " . $e->getMessage();
            return null;
        }
    }
}
