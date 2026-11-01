<?php
/**
 * Model Profile
 * Mengelola data profil dan bobot kriteria dari database
 */

class Profile {
    private $db;
    
    /**
     * Constructor
     * @param PDO $db Objek koneksi database PDO
     */
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Mengambil semua data profil beserta bobot kriterianya
     * 
     * @return array Array berisi profil dengan bobot kriteria
     */
    public function getAllWithWeights() {
        try {
            $query = "
                SELECT 
                    p.id,
                    p.nama,
                    p.deskripsi,
                    pw.criteria_id,
                    pw.bobot,
                    c.kode as criteria_kode,
                    c.nama as criteria_nama,
                    c.sifat as criteria_sifat
                FROM profiles p
                LEFT JOIN profile_weights pw ON p.id = pw.profile_id
                LEFT JOIN criterias c ON pw.criteria_id = c.id
                ORDER BY p.id ASC, c.kode ASC
            ";
            
            $stmt = $this->db->query($query);
            $rawData = $stmt->fetchAll();
            
            // Format data: groupkan berdasarkan profil
            $profiles = [];
            foreach ($rawData as $row) {
                $profileId = $row['id'];
                
                // Jika profil belum ada di array, tambahkan
                if (!isset($profiles[$profileId])) {
                    $profiles[$profileId] = [
                        'id' => $row['id'],
                        'nama' => $row['nama'],
                        'deskripsi' => $row['deskripsi'],
                        'weights' => []
                    ];
                }
                
                // Tambahkan bobot kriteria jika ada
                if ($row['criteria_id'] !== null) {
                    $profiles[$profileId]['weights'][] = [
                        'criteria_id' => $row['criteria_id'],
                        'criteria_kode' => $row['criteria_kode'],
                        'criteria_nama' => $row['criteria_nama'],
                        'criteria_sifat' => $row['criteria_sifat'],
                        'bobot' => $row['bobot']
                    ];
                }
            }
            
            // Kembalikan sebagai array dengan index numerik
            return array_values($profiles);
        } catch (PDOException $e) {
            echo "Error getAllWithWeights(): " . $e->getMessage();
            return [];
        }
    }
    
    /**
     * Mengambil semua profil tanpa bobot (data profil saja)
     * 
     * @return array Array berisi data profil
     */
    public function getAll() {
        try {
            $query = "SELECT * FROM profiles ORDER BY nama ASC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error getAll(): " . $e->getMessage();
            return [];
        }
    }
}
