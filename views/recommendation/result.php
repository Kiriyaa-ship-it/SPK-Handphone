<div class="container">
    <div class="result-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-poll"></i> Hasil Rekomendasi</h1>
                <p>Berikut adalah 5 handphone terbaik berdasarkan profil <strong><?php echo htmlspecialchars($metadata['profile_nama']); ?></strong> dengan budget <strong><?php echo formatRupiah($budget); ?></strong>.</p>
            </div>
            <a href="<?php echo url('rekomendasi'); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cari Ulang
            </a>
        </div>
    </div>

    <?php if (empty($results)): ?>
    <div class="card text-center">
        <div class="card-body">
            <i class="fas fa-search-minus fa-3x mb-3 text-warning"></i>
            <h3>Tidak Ada Hasil</h3>
            <p>Maaf, tidak ada handphone yang sesuai dengan budget Anda. Silakan coba naikkan anggaran Anda.</p>
            <a href="<?php echo url('rekomendasi'); ?>" class="btn btn-primary mt-3">Cari Ulang</a>
        </div>
    </div>
    <?php else: ?>
    
    <div class="recommendation-list">
        <?php foreach ($results as $index => $hp): ?>
        <div class="card hp-card <?php echo $index === 0 ? 'top-recommendation' : ''; ?>">
            <?php if ($index === 0): ?>
            <div class="top-badge">
                <i class="fas fa-crown"></i> REKOMENDASI TERBAIK
            </div>
            <?php endif; ?>
            
            <div class="hp-card-body">
                <div class="hp-rank">
                    #<?php echo $hp['rank']; ?>
                </div>
                
                <div class="hp-image">
                    <?php 
                    $imagePath = !empty($hp['gambar']) 
                        ? asset('images/handphones/' . $hp['gambar']) 
                        : asset('images/placeholder.svg');
                    ?>
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($hp['handphone_nama']); ?>">
                </div>
                
                <div class="hp-info">
                    <div class="hp-main">
                        <h2 class="hp-name"><?php echo htmlspecialchars($hp['handphone_nama']); ?></h2>
                        <span class="badge badge-primary mb-2"><?php echo htmlspecialchars($hp['handphone_merk']); ?></span>
                        <div class="hp-price"><?php echo formatRupiah($hp['handphone_harga']); ?></div>
                    </div>
                    
                    <div class="hp-specs">
                        <div class="spec-item">
                            <i class="fas fa-microchip"></i>
                            <span>Chipset (Skala: <?php echo $hp['raw_values']['C2']; ?>/5)</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-memory"></i>
                            <span>RAM: <?php echo $hp['ram_gb']; ?> GB</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-hdd"></i>
                            <span>Storage: <?php echo $hp['storage_gb']; ?> GB</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-camera"></i>
                            <span>Kamera (Skala: <?php echo $hp['raw_values']['C5']; ?>/5)</span>
                        </div>
                    </div>
                </div>
                
                <div class="hp-score">
                    <div class="score-label">Skor Akhir SAW</div>
                    <div class="score-value"><?php echo number_format($hp['final_score'], 4); ?></div>
                    <div class="score-bar-container">
                        <div class="score-bar" style="width: <?php echo ($hp['final_score'] * 100); ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Catatan Perhitungan</h3>
        </div>
        <div class="card-body">
            <p>Peringkat ini dihitung menggunakan metode <strong>Simple Additive Weighting (SAW)</strong> dengan bobot kriteria sebagai berikut:</p>
            <div class="table-responsive mt-2">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Sifat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>C1 - Harga</td>
                            <td><?php echo ($metadata['weights']['C1'] * 100); ?>%</td>
                            <td>Cost (Semakin kecil semakin baik)</td>
                        </tr>
                        <tr>
                            <td>C2 - Chipset</td>
                            <td><?php echo ($metadata['weights']['C2'] * 100); ?>%</td>
                            <td>Benefit (Semakin besar semakin baik)</td>
                        </tr>
                        <tr>
                            <td>C3 - RAM</td>
                            <td><?php echo ($metadata['weights']['C3'] * 100); ?>%</td>
                            <td>Benefit (Semakin besar semakin baik)</td>
                        </tr>
                        <tr>
                            <td>C4 - Storage</td>
                            <td><?php echo ($metadata['weights']['C4'] * 100); ?>%</td>
                            <td>Benefit (Semakin besar semakin baik)</td>
                        </tr>
                        <tr>
                            <td>C5 - Kamera</td>
                            <td><?php echo ($metadata['weights']['C5'] * 100); ?>%</td>
                            <td>Benefit (Semakin besar semakin baik)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div> -->

<style>
.hp-card {
    position: relative;
    overflow: hidden;
    margin-bottom: var(--spacing-md);
    border-left: 5px solid #e5e7eb;
}

.top-recommendation {
    border-left: 5px solid var(--primary);
    background-color: rgba(102, 126, 234, 0.02);
}

.top-badge {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    padding: 5px 20px;
    font-size: 0.75rem;
    font-weight: bold;
    position: absolute;
    top: 0;
    right: 0;
    border-bottom-left-radius: var(--radius-md);
}

.hp-card-body {
    display: flex;
    align-items: center;
    gap: var(--spacing-lg);
    padding: var(--spacing-sm);
}

.hp-rank {
    font-size: 2.5rem;
    font-weight: 900;
    color: #e5e7eb;
    min-width: 80px;
    text-align: center;
}

.hp-image {
    width: 120px;
    height: 120px;
    flex-shrink: 0;
}

.hp-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--radius-md);
    border: 1px solid #e5e7eb;
}

.top-recommendation .hp-rank {
    color: var(--primary);
    opacity: 0.2;
}

.hp-info {
    flex: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
}

.hp-name {
    font-size: 1.5rem;
    margin-bottom: 0;
}

.hp-price {
    font-size: 1.25rem;
    font-weight: bold;
    color: var(--secondary);
}

.hp-specs {
    display: grid;
    grid-template-columns: 1fr;
    gap: 5px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.875rem;
    color: #4b5563;
}

.spec-item i {
    width: 20px;
    color: var(--primary);
}

.hp-score {
    min-width: 150px;
    text-align: center;
}

.score-label {
    font-size: 0.75rem;
    color: #6b7280;
    text-transform: uppercase;
    font-weight: bold;
}

.score-value {
    font-size: 2rem;
    font-weight: bold;
    color: var(--primary);
}

.score-bar-container {
    height: 8px;
    background-color: #e5e7eb;
    border-radius: 4px;
    margin-top: 5px;
    overflow: hidden;
}

.score-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 4px;
}

@media (max-width: 768px) {
    .hp-card-body {
        flex-direction: column;
        text-align: center;
    }
    .hp-info {
        grid-template-columns: 1fr;
    }
    .hp-rank {
        min-width: auto;
    }
    .hp-image {
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }
}
</style>
