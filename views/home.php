<!-- Hero Section -->
<section class="hero cyber-hero">
    <div class="container">
        <div class="hero-content text-center">
            <div class="hero-small-badge">
                <span class="pulse-dot"></span>
                <span><?php echo $hero_small ?? 'SELAMAT DATANG DI SPK HANDPHONE'; ?></span>
            </div>
            <h1 class="hero-title"><?php echo $hero_title ?? 'TEMUKAN SMARTPHONE TERBAIK UNTUKMU.'; ?></h1>
            <div class="hero-slogan"><?php echo $hero_slogan ?? 'Smart Choice. Better Experience.'; ?></div>
            <p class="hero-desc"><?php echo $hero_desc ?? 'Bingung memilih handphone yang sesuai kebutuhan dan budget? Temukan rekomendasi smartphone terbaik berdasarkan kebutuhan gaming, fotografi, maupun penggunaan harian menggunakan metode SAW.'; ?></p>
            <div class="hero-actions mt-4">
                <a href="<?php echo url('rekomendasi'); ?>" class="btn btn-primary btn-lg hero-btn">
                    <i class="fas fa-search"></i> Mulai Cari Rekomendasi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features mt-4">
    <div class="container">
        <div class="grid-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-bolt fa-3x mb-3 text-primary"></i>
                    <h3>Cepat & Akurat</h3>
                    <p>Hasil perhitungan muncul dalam sekejap dengan akurasi metode SAW.</p>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-cog fa-3x mb-3 text-primary"></i>
                    <h3>Sesuai Kebutuhan</h3>
                    <p>Pilih profil kebutuhan Anda: Gaming, Fotografi, atau Penggunaan Harian.</p>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-mobile-alt fa-3x mb-3 text-primary"></i>
                    <h3>Data Terupdate</h3>
                    <p>Membandingkan berbagai handphone terbaru di pasaran.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats / Info Section -->
<!-- <section class="info-section mt-4 mb-4">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Tentang Sistem Ini</h2>
            </div>
            <div class="card-body">
                <p>Sistem ini membantu Anda mengambil keputusan dalam memilih handphone yang paling sesuai dengan kriteria yang Anda inginkan. Kami menggunakan kriteria utama:</p>
                <ul class="mt-2">
                    <li><strong>Harga (C1):</strong> Menyesuaikan dengan anggaran Anda.</li>
                    <li><strong>Chipset (C2):</strong> Performa untuk aplikasi dan game.</li>
                    <li><strong>RAM (C3):</strong> Kelancaran multitasking.</li>
                    <li><strong>Penyimpanan (C4):</strong> Kapasitas untuk file dan aplikasi.</li>
                    <li><strong>Kamera (C5):</strong> Kualitas tangkapan foto dan video.</li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

<style>
/* Cyberpunk / Dark Gaming Hero Section Styles */
.cyber-hero {
    position: relative;
    background: linear-gradient(135deg, rgba(5, 11, 20, 0.95) 0%, rgba(13, 27, 42, 0.9) 100%),
                radial-gradient(circle at 50% 30%, rgba(0, 212, 255, 0.15) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(220, 20, 60, 0.12) 0%, transparent 50%);
    padding: var(--spacing-xl) 0;
    border-radius: var(--radius-lg);
    margin-bottom: var(--spacing-lg);
    border: 1px solid rgba(0, 212, 255, 0.3);
    box-shadow: 0 0 50px rgba(0, 212, 255, 0.2), inset 0 0 40px rgba(220, 20, 60, 0.1);
    overflow: hidden;
}

.cyber-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, var(--accent-red), var(--accent-blue), var(--accent-red));
    animation: scanline 4s linear infinite;
}

@keyframes scanline {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.hero-small-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 212, 255, 0.1);
    border: 1px solid rgba(0, 212, 255, 0.4);
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 2px;
    color: var(--accent-blue);
    margin-bottom: var(--spacing-sm);
    box-shadow: 0 0 15px rgba(0, 212, 255, 0.3);
    text-shadow: 0 0 8px rgba(0, 212, 255, 0.6);
    animation: badgePulse 2s ease-in-out infinite;
}

.pulse-dot {
    width: 8px;
    height: 8px;
    background-color: var(--accent-red);
    border-radius: 50%;
    box-shadow: 0 0 10px var(--accent-red), 0 0 20px var(--accent-red);
    animation: dotBlink 1.5s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% { box-shadow: 0 0 15px rgba(0, 212, 255, 0.3); }
    50% { box-shadow: 0 0 25px rgba(0, 212, 255, 0.6), 0 0 10px rgba(220, 20, 60, 0.4); }
}

@keyframes dotBlink {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(0.8); }
}

.hero-title {
    font-size: 3.2rem;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: var(--spacing-xs);
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 0 0 20px rgba(0, 212, 255, 0.6), 
                 0 0 40px rgba(30, 64, 175, 0.5), 
                 0 0 60px rgba(220, 20, 60, 0.4);
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% {
        text-shadow: 0 0 15px rgba(0, 212, 255, 0.5), 
                     0 0 30px rgba(30, 64, 175, 0.4), 
                     0 0 45px rgba(220, 20, 60, 0.3);
    }
    100% {
        text-shadow: 0 0 25px rgba(0, 212, 255, 0.8), 
                     0 0 50px rgba(30, 64, 175, 0.7), 
                     0 0 75px rgba(220, 20, 60, 0.6);
    }
}

.hero-slogan {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--accent-blue);
    margin-bottom: var(--spacing-md);
    letter-spacing: 3px;
    text-transform: uppercase;
    text-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
}

.hero-desc {
    font-size: 1.15rem;
    color: var(--text-secondary);
    max-width: 820px;
    margin: 0 auto var(--spacing-md) auto;
    line-height: 1.7;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

.hero-btn {
    background: linear-gradient(135deg, var(--accent-red) 0%, var(--primary-dark) 100%);
    border: 1px solid var(--accent-red);
    box-shadow: 0 0 25px rgba(220, 20, 60, 0.5), 0 0 50px rgba(0, 212, 255, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.hero-btn:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 0 35px var(--accent-red), 0 0 70px rgba(0, 212, 255, 0.7);
    border-color: var(--accent-blue);
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
}

.btn-lg {
    padding: 16px 36px;
    font-size: 1.15rem;
    border-radius: var(--radius-md);
}

@media (max-width: 768px) {
    .cyber-hero {
        padding: var(--spacing-lg) var(--spacing-sm);
    }
    .hero-title {
        font-size: 2.1rem;
    }
    .hero-slogan {
        font-size: 1.1rem;
        letter-spacing: 2px;
    }
    .hero-desc {
        font-size: 1rem;
    }
    .hero-small-badge {
        font-size: 0.75rem;
        padding: 4px 12px;
    }
}
</style>
