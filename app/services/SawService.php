<?php
/**
 * SAW Service
 * Service untuk menangani perhitungan metode Simple Additive Weighting (SAW)
 * Sistem Pendukung Keputusan Pemilihan Handphone
 */

class SawService {
    private $db;
    private $handphoneModel;
    private $profileModel;
    
    /**
     * Constructor
     * @param PDO $db Objek koneksi database PDO
     * @param Handphone $handphoneModel Model Handphone
     * @param Profile $profileModel Model Profile
     */
    public function __construct($db, $handphoneModel, $profileModel) {
        $this->db = $db;
        $this->handphoneModel = $handphoneModel;
        $this->profileModel = $profileModel;
    }
    
    /**
     * Menghitung skala RAM berdasarkan kapasitas fisik
     * Sesuai dengan SAW_METHODOLOGY.md section 4.1
     * 
     * @param int $ramGb Kapasitas RAM dalam GB
     * @return int Skala RAM (1-5)
     */
    private function calculateRamScale($ramGb) {
        if ($ramGb <= 3) return 1;
        if ($ramGb >= 4 && $ramGb <= 5) return 2;
        if ($ramGb >= 6 && $ramGb <= 7) return 3;
        if ($ramGb >= 8 && $ramGb <= 11) return 4;
        if ($ramGb >= 12) return 5;
        return 1; // Default fallback
    }
    
    /**
     * Menghitung skala Storage berdasarkan kapasitas fisik
     * Sesuai dengan SAW_METHODOLOGY.md section 4.2
     * 
     * @param int $storageGb Kapasitas Storage dalam GB
     * @return int Skala Storage (1-5)
     */
    private function calculateStorageScale($storageGb) {
        if ($storageGb < 64) return 1;
        if ($storageGb >= 64 && $storageGb < 128) return 2;
        if ($storageGb >= 128 && $storageGb < 256) return 3;
        if ($storageGb >= 256 && $storageGb < 512) return 4;
        if ($storageGb >= 512) return 5;
        return 1; // Default fallback
    }
    
    /**
     * Melakukan perhitungan SAW lengkap
     * 
     * @param float $budget Budget maksimal pengguna
     * @param int $profileId ID profil kebutuhan
     * @return array Hasil perhitungan SAW dengan detail lengkap
     */
    public function calculate($budget, $profileId) {
        // 1. Validasi input
        if ($budget <= 0) {
            return [
                'success' => false,
                'message' => 'Budget harus lebih besar dari 0',
                'data' => []
            ];
        }
        
        // 2. Ambil data profil beserta bobot kriteria
        $profiles = $this->profileModel->getAllWithWeights();
        $selectedProfile = null;
        
        foreach ($profiles as $profile) {
            if ($profile['id'] == $profileId) {
                $selectedProfile = $profile;
                break;
            }
        }
        
        if ($selectedProfile === null) {
            return [
                'success' => false,
                'message' => 'Profil tidak ditemukan',
                'data' => []
            ];
        }
        
        // 3. Ambil semua data handphone
        $allHandphones = $this->handphoneModel->getAll();
        
        if (empty($allHandphones)) {
            return [
                'success' => false,
                'message' => 'Tidak ada data handphone di database',
                'data' => []
            ];
        }
        
        // 4. Pre-filtering: Filter handphone berdasarkan budget
        $filteredHandphones = [];
        foreach ($allHandphones as $hp) {
            if ($hp['harga'] <= $budget) {
                $filteredHandphones[] = $hp;
            }
        }
        
        // 5. Cek apakah ada handphone yang lolos filter
        if (empty($filteredHandphones)) {
            return [
                'success' => false,
                'message' => 'Tidak ada handphone yang sesuai dengan budget Rp ' . number_format($budget, 0, ',', '.'),
                'data' => []
            ];
        }
        
        // 6. Transform data: hitung skala RAM dan Storage untuk setiap handphone
        foreach ($filteredHandphones as &$hp) {
            $hp['ram_skala'] = $this->calculateRamScale($hp['ram_gb']);
            $hp['storage_skala'] = $this->calculateStorageScale($hp['storage_gb']);
        }
        unset($hp); // Break reference
        
        // 7. Buat mapping bobot kriteria dari profil
        // Format: ['C1' => 0.15, 'C2' => 0.40, ...]
        $weights = [];
        foreach ($selectedProfile['weights'] as $weight) {
            $weights[$weight['criteria_kode']] = $weight['bobot'];
        }
        
        // 8. Ekstrak nilai kriteria untuk normalisasi
        // C1 = Harga (Cost)
        // C2 = Chipset (Benefit)
        // C3 = RAM (Benefit)
        // C4 = Storage (Benefit)
        // C5 = Kamera (Benefit)
        
        $criteria = [
            'C1' => [], // Harga
            'C2' => [], // Chipset
            'C3' => [], // RAM
            'C4' => [], // Storage
            'C5' => []  // Kamera
        ];
        
        foreach ($filteredHandphones as $hp) {
            $criteria['C1'][] = $hp['harga'];
            $criteria['C2'][] = $hp['chipset_skala'];
            $criteria['C3'][] = $hp['ram_skala'];
            $criteria['C4'][] = $hp['storage_skala'];
            $criteria['C5'][] = $hp['kamera_skala'];
        }
        
        // 9. Hitung nilai min dan max untuk normalisasi
        // Sesuai SAW_METHODOLOGY.md: nilai min/max diambil dari subset yang lolos filter
        $minC1 = min($criteria['C1']); // Min harga (untuk Cost)
        $maxC2 = max($criteria['C2']); // Max chipset (untuk Benefit)
        $maxC3 = max($criteria['C3']); // Max RAM (untuk Benefit)
        $maxC4 = max($criteria['C4']); // Max Storage (untuk Benefit)
        $maxC5 = max($criteria['C5']); // Max Kamera (untuk Benefit)
        
        // 10. Validasi nilai ekstrem untuk mencegah division by zero
        if ($minC1 <= 0) {
            return [
                'success' => false,
                'message' => 'Data tidak valid: ditemukan harga handphone <= 0',
                'data' => []
            ];
        }
        
        if ($maxC2 <= 0 || $maxC3 <= 0 || $maxC4 <= 0 || $maxC5 <= 0) {
            return [
                'success' => false,
                'message' => 'Data tidak valid: ditemukan nilai kriteria benefit <= 0',
                'data' => []
            ];
        }
        
        // 11. Normalisasi dan hitung nilai preferensi untuk setiap handphone
        $results = [];
        
        foreach ($filteredHandphones as $hp) {
            // Nilai asli kriteria
            $rawValues = [
                'C1' => $hp['harga'],
                'C2' => $hp['chipset_skala'],
                'C3' => $hp['ram_skala'],
                'C4' => $hp['storage_skala'],
                'C5' => $hp['kamera_skala']
            ];
            
            // Normalisasi
            // C1 (Cost): r_ij = min / x_ij
            // C2-C5 (Benefit): r_ij = x_ij / max
            $normalized = [
                'r_C1' => $minC1 / $hp['harga'],
                'r_C2' => $hp['chipset_skala'] / $maxC2,
                'r_C3' => $hp['ram_skala'] / $maxC3,
                'r_C4' => $hp['storage_skala'] / $maxC4,
                'r_C5' => $hp['kamera_skala'] / $maxC5
            ];
            
            // Hitung nilai preferensi: V_i = sum(w_j * r_ij)
            $finalScore = 0;
            $weightedScores = [];
            
            foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $criteriaCode) {
                $weight = isset($weights[$criteriaCode]) ? $weights[$criteriaCode] : 0;
                $weightedScore = $weight * $normalized['r_' . $criteriaCode];
                $weightedScores[$criteriaCode] = $weightedScore;
                $finalScore += $weightedScore;
            }
            
            // Simpan hasil untuk handphone ini
            $results[] = [
                'handphone_id' => $hp['id'],
                'handphone_nama' => $hp['nama'],
                'handphone_merk' => $hp['merk'],
                'handphone_harga' => $hp['harga'],
                'handphone_deskripsi' => $hp['deskripsi'] ?? '',
                'ram_gb' => $hp['ram_gb'],
                'storage_gb' => $hp['storage_gb'],
                'raw_values' => $rawValues,
                'normalized_values' => $normalized,
                'weighted_scores' => $weightedScores,
                'final_score' => $finalScore
            ];
        }
        
        // 12. Urutkan hasil dari nilai tertinggi ke terendah
        usort($results, function($a, $b) {
            return $b['final_score'] <=> $a['final_score'];
        });
        
        // 13. Tambahkan peringkat
        $rank = 1;
        foreach ($results as &$result) {
            $result['rank'] = $rank++;
        }
        unset($result); // Break reference
        
        // 14. Return hasil lengkap
        return [
            'success' => true,
            'message' => 'Perhitungan SAW berhasil',
            'metadata' => [
                'budget' => $budget,
                'profile_id' => $profileId,
                'profile_nama' => $selectedProfile['nama'],
                'profile_deskripsi' => $selectedProfile['deskripsi'],
                'weights' => $weights,
                'total_alternatives' => count($allHandphones),
                'filtered_alternatives' => count($filteredHandphones),
                'normalization_references' => [
                    'min_C1' => $minC1,
                    'max_C2' => $maxC2,
                    'max_C3' => $maxC3,
                    'max_C4' => $maxC4,
                    'max_C5' => $maxC5
                ]
            ],
            'data' => $results
        ];
    }
}
