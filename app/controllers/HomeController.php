<?php
/**
 * Home Controller
 * Menangani halaman utama (landing page)
 */

require_once __DIR__ . '/BaseController.php';

class HomeController extends BaseController {
    
    /**
     * Tampilkan halaman utama
     */
    public function index() {
        $data = [
            'title' => 'Beranda',
            'hero_small' => 'SELAMAT DATANG DI SPK HANDPHONE',
            'hero_title' => 'TEMUKAN SMARTPHONE TERBAIK UNTUKMU.',
            'hero_slogan' => 'Smart Choice. Better Experience.',
            'hero_desc' => 'Bingung memilih handphone yang sesuai kebutuhan dan budget? Temukan rekomendasi smartphone terbaik berdasarkan kebutuhan gaming, fotografi, maupun penggunaan harian menggunakan metode SAW.'
        ];
        
        return $this->view('home', $data);
    }
}
