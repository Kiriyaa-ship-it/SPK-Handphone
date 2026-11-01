<?php
/**
 * Test Models
 * Sistem Pendukung Keputusan Pemilihan Handphone
 */

// Include konfigurasi database dan models
require_once '../app/config/database.php';
require_once '../app/models/Handphone.php';
require_once '../app/models/Criteria.php';
require_once '../app/models/Profile.php';

// Inisialisasi models
$handphoneModel = new Handphone($db);
$criteriaModel = new Criteria($db);
$profileModel = new Profile($db);

// Ambil data dari setiap model
$allHandphones = $handphoneModel->getAll();
$allCriterias = $criteriaModel->getAll();
$allProfiles = $profileModel->getAll();
$profilesWithWeights = $profileModel->getAllWithWeights();

// Variable untuk test getById
$testHandphoneId = 1;
$detailHandphone = $handphoneModel->getById($testHandphoneId);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Models - SPK Handphone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 10px;
            font-size: 32px;
        }
        
        .subtitle {
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .test-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .test-section h2 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 20px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        
        .count-badge {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .count-badge.empty {
            background-color: #ffc107;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        table thead {
            background-color: #667eea;
            color: white;
        }
        
        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #ddd;
        }
        
        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 13px;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        table tbody tr:hover {
            background-color: #f0f0f0;
        }
        
        .empty-data {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            color: #856404;
            margin-top: 10px;
            font-size: 13px;
        }
        
        .success {
            background-color: #d4edda;
            border: 1px solid #28a745;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        
        .detail-box {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 13px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 8px;
        }
        
        .detail-label {
            font-weight: 600;
            color: #1976D2;
            min-width: 150px;
        }
        
        .detail-value {
            color: #333;
        }
        
        .weights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .weight-card {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }
        
        .weight-card h4 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .weight-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 12px;
        }
        
        .weight-criteria {
            font-weight: 500;
            color: #333;
        }
        
        .weight-value {
            background-color: #667eea;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 600;
        }
        
        .footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Test Models</h1>
        <p class="subtitle">Sistem Pendukung Keputusan Pemilihan Handphone</p>
        
        <!-- Test Criteria::getAll() -->
        <div class="test-section">
            <h2>1. Test Criteria::getAll()</h2>
            <span class="count-badge">Total Kriteria: <?php echo count($allCriterias); ?></span>
            
            <?php if (count($allCriterias) > 0): ?>
                <div class="success">✓ Data kriteria berhasil diambil dari database</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Sifat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allCriterias as $criteria): ?>
                            <tr>
                                <td><?php echo $criteria['id']; ?></td>
                                <td><strong><?php echo $criteria['kode']; ?></strong></td>
                                <td><?php echo $criteria['nama']; ?></td>
                                <td>
                                    <span style="background-color: <?php echo $criteria['sifat'] === 'Cost' ? '#ff6b6b' : '#51cf66'; ?>; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px; font-weight: 600;">
                                        <?php echo $criteria['sifat']; ?>
                                    </span>
                                </td>
                                <td><?php echo $criteria['keterangan'] ?? '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-data">⚠️ Tidak ada data kriteria. Jalankan file database/seeds/001_initial_data.sql terlebih dahulu.</div>
            <?php endif; ?>
        </div>
        
        <!-- Test Profile::getAll() -->
        <div class="test-section">
            <h2>2. Test Profile::getAll()</h2>
            <span class="count-badge">Total Profil: <?php echo count($allProfiles); ?></span>
            
            <?php if (count($allProfiles) > 0): ?>
                <div class="success">✓ Data profil berhasil diambil dari database</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Profil</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allProfiles as $profile): ?>
                            <tr>
                                <td><?php echo $profile['id']; ?></td>
                                <td><strong><?php echo $profile['nama']; ?></strong></td>
                                <td><?php echo $profile['deskripsi'] ?? '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-data">⚠️ Tidak ada data profil. Jalankan file database/seeds/001_initial_data.sql terlebih dahulu.</div>
            <?php endif; ?>
        </div>
        
        <!-- Test Profile::getAllWithWeights() -->
        <div class="test-section">
            <h2>3. Test Profile::getAllWithWeights()</h2>
            <span class="count-badge">Total Profil: <?php echo count($profilesWithWeights); ?></span>
            
            <?php if (count($profilesWithWeights) > 0): ?>
                <div class="success">✓ Data profil beserta bobot kriteria berhasil diambil dari database</div>
                <div class="weights-grid">
                    <?php foreach ($profilesWithWeights as $profile): ?>
                        <div class="weight-card">
                            <h4><?php echo $profile['nama']; ?></h4>
                            <p style="font-size: 12px; color: #666; margin-bottom: 10px;"><?php echo $profile['deskripsi'] ?? '-'; ?></p>
                            <?php 
                            $totalBobot = 0;
                            foreach ($profile['weights'] as $weight):
                                $totalBobot += $weight['bobot'];
                            ?>
                                <div class="weight-item">
                                    <span class="weight-criteria"><?php echo $weight['criteria_kode']; ?> (<?php echo $weight['criteria_nama']; ?>)</span>
                                    <span class="weight-value"><?php echo number_format($weight['bobot'], 2); ?></span>
                                </div>
                            <?php endforeach; ?>
                            <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #ccc; font-weight: 600;">
                                Total: <span style="color: #667eea;"><?php echo number_format($totalBobot, 2); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-data">⚠️ Tidak ada data profil dengan bobot. Jalankan file database/seeds/001_initial_data.sql terlebih dahulu.</div>
            <?php endif; ?>
        </div>
        
        <!-- Test Handphone::getAll() -->
        <div class="test-section">
            <h2>4. Test Handphone::getAll()</h2>
            <span class="count-badge <?php echo count($allHandphones) === 0 ? 'empty' : ''; ?>">Total Handphone: <?php echo count($allHandphones); ?></span>
            
            <?php if (count($allHandphones) > 0): ?>
                <div class="success">✓ Data handphone berhasil diambil dari database</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Harga (Rp)</th>
                            <th>Chipset Skala</th>
                            <th>RAM (GB)</th>
                            <th>Storage (GB)</th>
                            <th>Kamera Skala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allHandphones as $hp): ?>
                            <tr>
                                <td><?php echo $hp['id']; ?></td>
                                <td><?php echo $hp['nama']; ?></td>
                                <td><?php echo $hp['merk']; ?></td>
                                <td><?php echo number_format($hp['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $hp['chipset_skala']; ?>/5</td>
                                <td><?php echo $hp['ram_gb']; ?></td>
                                <td><?php echo $hp['storage_gb']; ?></td>
                                <td><?php echo $hp['kamera_skala']; ?>/5</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-data">⚠️ Tabel handphones masih kosong. Tambahkan data handphone melalui admin panel untuk menguji fitur ini.</div>
            <?php endif; ?>
        </div>
        
        <!-- Test Handphone::getById() -->
        <div class="test-section">
            <h2>5. Test Handphone::getById(<?php echo $testHandphoneId; ?>)</h2>
            
            <?php if ($detailHandphone !== null): ?>
                <div class="success">✓ Data detail handphone berhasil diambil</div>
                <div class="detail-box">
                    <div class="detail-row">
                        <span class="detail-label">ID:</span>
                        <span class="detail-value"><?php echo $detailHandphone['id']; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama:</span>
                        <span class="detail-value"><?php echo $detailHandphone['nama']; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Merk:</span>
                        <span class="detail-value"><?php echo $detailHandphone['merk']; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Harga:</span>
                        <span class="detail-value">Rp <?php echo number_format($detailHandphone['harga'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Chipset Skala:</span>
                        <span class="detail-value"><?php echo $detailHandphone['chipset_skala']; ?>/5</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">RAM:</span>
                        <span class="detail-value"><?php echo $detailHandphone['ram_gb']; ?> GB</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Storage:</span>
                        <span class="detail-value"><?php echo $detailHandphone['storage_gb']; ?> GB</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Kamera Skala:</span>
                        <span class="detail-value"><?php echo $detailHandphone['kamera_skala']; ?>/5</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Deskripsi:</span>
                        <span class="detail-value"><?php echo $detailHandphone['deskripsi'] ?? '-'; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Dibuat:</span>
                        <span class="detail-value"><?php echo $detailHandphone['created_at']; ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-data">⚠️ Handphone dengan ID <?php echo $testHandphoneId; ?> tidak ditemukan. Tabel handphones mungkin masih kosong atau ID tidak ada.</div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p>SPK Handphone &copy; 2026 | Sistem Pendukung Keputusan Pemilihan Handphone</p>
            <p>Akses file ini untuk menguji ketiga Model: Handphone, Criteria, dan Profile</p>
        </div>
    </div>
</body>
</html>
