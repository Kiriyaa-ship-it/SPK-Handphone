<?php
/**
 * Model Criteria
 * Mengelola data kriteria dari database
 */

class Criteria {
    private $db;
    
    /**
     * Constructor
     * @param PDO $db Objek koneksi database PDO
     */
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Mengambil semua data kriteria
     * 
     * @return array Array berisi semua data kriteria
     */
    public function getAll() {
        try {
            $query = "SELECT * FROM criterias ORDER BY kode ASC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error getAll(): " . $e->getMessage();
            return [];
        }
    }
}
