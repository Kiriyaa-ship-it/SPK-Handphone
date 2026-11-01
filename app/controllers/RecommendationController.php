<?php
/**
 * Recommendation Controller
 * Menangani fitur pencarian rekomendasi HP menggunakan metode SAW
 */

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Handphone.php';
require_once __DIR__ . '/../models/Profile.php';
require_once __DIR__ . '/../services/SawService.php';

class RecommendationController extends BaseController {
    
    private $handphoneModel;
    private $profileModel;
    private $sawService;
    
    public function __construct() {
        parent::__construct();
        $this->handphoneModel = new Handphone($this->db);
        $this->profileModel = new Profile($this->db);
        $this->sawService = new SawService($this->db, $this->handphoneModel, $this->profileModel);
    }
    
    /**
     * Tampilkan form rekomendasi
     */
    public function index() {
        $profiles = $this->profileModel->getAll();
        
        $data = [
            'title' => 'Cari Rekomendasi',
            'profiles' => $profiles
        ];
        
        return $this->view('recommendation/index', $data);
    }
    
    /**
     * Proses perhitungan SAW dan tampilkan hasil
     */
    public function calculate() {
        if (!isPost()) {
            return redirect('rekomendasi');
        }
        
        // Validasi CSRF
        $csrfToken = post('csrf_token');
        if (!validateCSRFToken($csrfToken)) {
            setFlash('error', 'Token keamanan tidak valid');
            return redirect('rekomendasi');
        }
        
        $budget = post('budget');
        $profileId = post('profile_id');
        
        // Validasi input
        if (empty($budget) || !isNumeric($budget)) {
            setFlash('error', 'Budget harus diisi dengan angka valid.');
            return redirect('rekomendasi');
        }
        
        if (empty($profileId)) {
            setFlash('error', 'Silakan pilih profil kebutuhan Anda.');
            return redirect('rekomendasi');
        }
        
        // Jalankan perhitungan SAW
        $result = $this->sawService->calculate($budget, $profileId);
        
        if (!$result['success']) {
            setFlash('error', $result['message']);
            return redirect('rekomendasi');
        }
        
        // Ambil top 5 hasil
        $topResults = array_slice($result['data'], 0, 5);
        
        $data = [
            'title' => 'Hasil Rekomendasi',
            'metadata' => $result['metadata'],
            'results' => $topResults,
            'budget' => $budget,
            'profile_id' => $profileId
        ];
        
        return $this->view('recommendation/result', $data);
    }
}
