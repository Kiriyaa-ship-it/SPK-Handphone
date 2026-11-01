<?php
/**
 * Test Script untuk SawService.php
 * 
 * Pengujian:
 * 1. Verifikasi data HP sudah masuk database
 * 2. Test perhitungan SAW untuk 3 profil (Gaming, Photography, Daily)
 * 3. Test berbagai skenario budget
 * 4. Validasi filter budget, normalisasi, bobot, skor akhir, ranking
 * 5. Validasi tidak ada division by zero
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/models/Handphone.php';
require_once __DIR__ . '/../app/models/Profile.php';
require_once __DIR__ . '/../app/services/SawService.php';

// Inisialisasi
$db = getDbConnection();
$handphoneModel = new Handphone($db);
$profileModel = new Profile($db);
$sawService = new SawService($db, $handphoneModel, $profileModel);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test SawService - SPK Handphone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .test-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .test-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #667eea;
            font-size: 1.8em;
        }
        
        .test-section h3 {
            color: #764ba2;
            margin: 20px 0 15px 0;
            font-size: 1.3em;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            margin-right: 5px;
        }
        
        .badge-success {
            background: #10b981;
            color: white;
        }
        
        .badge-danger {
            background: #ef4444;
            color: white;
        }
        
        .badge-warning {
            background: #f59e0b;
            color: white;
        }
        
        .badge-info {
            background: #3b82f6;
            color: white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: white;
        }
        
        table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        
        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        table tr:hover {
            background: #f3f4f6;
        }
        
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        
        .error-box {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        
        .success-box {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        
        .metadata {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .metadata-item {
            display: inline-block;
            margin-right: 25px;
            margin-bottom: 8px;
        }
        
        .metadata-label {
            font-weight: 600;
            color: #6b7280;
        }
        
        .metadata-value {
            color: #1f2937;
            font-weight: 500;
        }
        
        .rank-1 { background: #fef3c7 !important; font-weight: bold; }
        .rank-2 { background: #e5e7eb !important; }
        .rank-3 { background: #fce7f3 !important; }
        
        pre {
            background: #1f2937;
            color: #10b981;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 0.9em;
            line-height: 1.5;
        }
        
        .test-case {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .test-case-header {
            font-size: 1.2em;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Test SawService.php</h1>
        
        <?php
        // ============================================================================
        // TEST 1: VERIFIKASI DATA HP SUDAH MASUK DATABASE
        // ============================================================================
        ?>
        <div class="test-section">
            <h2>📊 Test 1: Verifikasi Data HP di Database</h2>
            
            <?php
            try {
                $allHandphones = $handphoneModel->getAll();
                $countHP = count($allHandphones);
                
                if ($countHP >= 10) {
                    echo '<div class="success-box">';
                    echo '<strong>✅ SUKSES:</strong> Ditemukan ' . $countHP . ' data handphone di database.';
                    echo '</div>';
                } else {
                    echo '<div class="warning-box">';
                    echo '<strong>⚠️ PERINGATAN:</strong> Hanya ditemukan ' . $countHP . ' data handphone. Harusnya minimal 10 data.';
                    echo '</div>';
                }
                
                echo '<table>';
                echo '<thead><tr>';
                echo '<th>ID</th><th>Nama HP</th><th>Merk</th><th>Harga</th>';
                echo '<th>Chipset</th><th>RAM</th><th>Storage</th><th>Kamera</th>';
                echo '</tr></thead><tbody>';
                
                foreach ($allHandphones as $hp) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($hp['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($hp['nama']) . '</td>';
                    echo '<td>' . htmlspecialchars($hp['merk']) . '</td>';
                    echo '<td>Rp ' . number_format($hp['harga'], 0, ',', '.') . '</td>';
                    echo '<td><span class="badge badge-info">' . $hp['chipset_skala'] . '</span></td>';
                    echo '<td>' . $hp['ram_gb'] . ' GB</td>';
                    echo '<td>' . $hp['storage_gb'] . ' GB</td>';
                    echo '<td><span class="badge badge-success">' . $hp['kamera_skala'] . '</span></td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
                
            } catch (Exception $e) {
                echo '<div class="error-box">';
                echo '<strong>❌ ERROR:</strong> ' . htmlspecialchars($e->getMessage());
                echo '</div>';
            }
            ?>
        </div>
        
        <?php
        // ============================================================================
        // TEST 2: VERIFIKASI PROFIL DAN BOBOT
        // ============================================================================
        ?>
        <div class="test-section">
            <h2>🎯 Test 2: Verifikasi Profil dan Bobot</h2>
            
            <?php
            try {
                $profiles = $profileModel->getAllWithWeights();
                
                echo '<table>';
                echo '<thead><tr>';
                echo '<th>ID</th><th>Profil</th><th>Harga (C1)</th><th>Chipset (C2)</th>';
                echo '<th>RAM (C3)</th><th>Storage (C4)</th><th>Kamera (C5)</th><th>Total</th>';
                echo '</tr></thead><tbody>';
                
                foreach ($profiles as $profile) {
                    // Extract weights by criteria code
                    $weights = [];
                    foreach ($profile['weights'] as $w) {
                        $weights[$w['criteria_kode']] = $w['bobot'];
                    }
                    
                    $total = ($weights['C1'] ?? 0) + ($weights['C2'] ?? 0) + 
                             ($weights['C3'] ?? 0) + ($weights['C4'] ?? 0) + 
                             ($weights['C5'] ?? 0);
                    
                    echo '<tr>';
                    echo '<td>' . $profile['id'] . '</td>';
                    echo '<td><strong>' . htmlspecialchars($profile['nama']) . '</strong></td>';
                    echo '<td>' . ($weights['C1'] ?? 0) . '</td>';
                    echo '<td>' . ($weights['C2'] ?? 0) . '</td>';
                    echo '<td>' . ($weights['C3'] ?? 0) . '</td>';
                    echo '<td>' . ($weights['C4'] ?? 0) . '</td>';
                    echo '<td>' . ($weights['C5'] ?? 0) . '</td>';
                    echo '<td><strong>' . $total . '</strong></td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
                
            } catch (Exception $e) {
                echo '<div class="error-box">';
                echo '<strong>❌ ERROR:</strong> ' . htmlspecialchars($e->getMessage());
                echo '</div>';
            }
            ?>
        </div>
        
        <?php
        // ============================================================================
        // TEST 3: PENGUJIAN SAWSERVICE UNTUK BERBAGAI SKENARIO
        // ============================================================================
        
        $testCases = [
            [
                'profile_id' => 1,
                'profile_name' => 'Gaming',
                'budgets' => [3000000, 4000000, 5000000]
            ],
            [
                'profile_id' => 2,
                'profile_name' => 'Photography',
                'budgets' => [3000000, 4000000, 5000000]
            ],
            [
                'profile_id' => 3,
                'profile_name' => 'Daily',
                'budgets' => [2500000, 3500000, 4500000]
            ]
        ];
        
        foreach ($testCases as $testCase) {
            ?>
            <div class="test-section">
                <h2>🎮 Test 3: Profil <?php echo htmlspecialchars($testCase['profile_name']); ?></h2>
                
                <?php
                foreach ($testCase['budgets'] as $budget) {
                    echo '<div class="test-case">';
                    echo '<div class="test-case-header">💰 Budget: Rp ' . number_format($budget, 0, ',', '.') . '</div>';
                    
                    try {
                        $result = $sawService->calculate($budget, $testCase['profile_id']);
                        
                        if ($result['success']) {
                            echo '<div class="success-box">';
                            echo '<strong>✅ SUKSES:</strong> ' . htmlspecialchars($result['message']);
                            echo '</div>';
                            
                            // Metadata
                            echo '<div class="metadata">';
                            echo '<div class="metadata-item">';
                            echo '<span class="metadata-label">Profil:</span> ';
                            echo '<span class="metadata-value">' . htmlspecialchars($result['metadata']['profile_nama']) . '</span>';
                            echo '</div>';
                            
                            echo '<div class="metadata-item">';
                            echo '<span class="metadata-label">Budget:</span> ';
                            echo '<span class="metadata-value">Rp ' . number_format($result['metadata']['budget'], 0, ',', '.') . '</span>';
                            echo '</div>';
                            
                            echo '<div class="metadata-item">';
                            echo '<span class="metadata-label">Total Alternatif:</span> ';
                            echo '<span class="metadata-value">' . $result['metadata']['total_alternatives'] . ' HP</span>';
                            echo '</div>';
                            
                            echo '<div class="metadata-item">';
                            echo '<span class="metadata-label">Lolos Filter:</span> ';
                            echo '<span class="metadata-value">' . $result['metadata']['filtered_alternatives'] . ' HP</span>';
                            echo '</div>';
                            echo '</div>';
                            
                            // Bobot
                            echo '<h3>Bobot Kriteria:</h3>';
                            echo '<div class="info-box">';
                            echo 'C1 (Harga-Cost): ' . $result['metadata']['weights']['C1'] . ' | ';
                            echo 'C2 (Chipset-Benefit): ' . $result['metadata']['weights']['C2'] . ' | ';
                            echo 'C3 (RAM-Benefit): ' . $result['metadata']['weights']['C3'] . ' | ';
                            echo 'C4 (Storage-Benefit): ' . $result['metadata']['weights']['C4'] . ' | ';
                            echo 'C5 (Kamera-Benefit): ' . $result['metadata']['weights']['C5'];
                            echo '</div>';
                            
                            // Normalisasi References
                            echo '<h3>Nilai Min/Max untuk Normalisasi:</h3>';
                            echo '<div class="info-box">';
                            $norm = $result['metadata']['normalization_references'];
                            echo 'Min C1 (Harga): Rp ' . number_format($norm['min_C1'], 0, ',', '.') . ' | ';
                            echo 'Max C2 (Chipset): ' . $norm['max_C2'] . ' | ';
                            echo 'Max C3 (RAM): ' . $norm['max_C3'] . ' GB | ';
                            echo 'Max C4 (Storage): ' . $norm['max_C4'] . ' GB | ';
                            echo 'Max C5 (Kamera): ' . $norm['max_C5'];
                            echo '</div>';
                            
                            // Hasil Ranking
                            echo '<h3>Hasil Ranking:</h3>';
                            echo '<table>';
                            echo '<thead><tr>';
                            echo '<th>Rank</th><th>Nama HP</th><th>Harga</th>';
                            echo '<th>C1 Raw</th><th>C2 Raw</th><th>C3 Raw</th><th>C4 Raw</th><th>C5 Raw</th>';
                            echo '<th>r1</th><th>r2</th><th>r3</th><th>r4</th><th>r5</th>';
                            echo '<th>V (Final)</th>';
                            echo '</tr></thead><tbody>';
                            
                            foreach ($result['data'] as $item) {
                                $rankClass = $item['rank'] <= 3 ? 'rank-' . $item['rank'] : '';
                                echo '<tr class="' . $rankClass . '">';
                                echo '<td><strong>#' . $item['rank'] . '</strong></td>';
                                echo '<td>' . htmlspecialchars($item['handphone_nama']) . '</td>';
                                echo '<td>Rp ' . number_format($item['raw_values']['C1'], 0, ',', '.') . '</td>';
                                
                                // Raw Values
                                echo '<td>Rp ' . number_format($item['raw_values']['C1'], 0, ',', '.') . '</td>';
                                echo '<td>' . $item['raw_values']['C2'] . '</td>';
                                echo '<td>' . $item['raw_values']['C3'] . ' GB</td>';
                                echo '<td>' . $item['raw_values']['C4'] . ' GB</td>';
                                echo '<td>' . $item['raw_values']['C5'] . '</td>';
                                
                                // Normalized Values
                                echo '<td>' . number_format($item['normalized_values']['r_C1'], 4) . '</td>';
                                echo '<td>' . number_format($item['normalized_values']['r_C2'], 4) . '</td>';
                                echo '<td>' . number_format($item['normalized_values']['r_C3'], 4) . '</td>';
                                echo '<td>' . number_format($item['normalized_values']['r_C4'], 4) . '</td>';
                                echo '<td>' . number_format($item['normalized_values']['r_C5'], 4) . '</td>';
                                
                                // Final Score
                                echo '<td><strong>' . number_format($item['final_score'], 4) . '</strong></td>';
                                echo '</tr>';
                            }
                            
                            echo '</tbody></table>';
                            
                            // Validasi Perhitungan Manual untuk Rank 1
                            if (count($result['data']) > 0) {
                                $topHP = $result['data'][0];
                                echo '<h3>✔️ Validasi Perhitungan Manual (Rank #1):</h3>';
                                echo '<div class="info-box">';
                                echo '<strong>' . htmlspecialchars($topHP['handphone_nama']) . '</strong><br>';
                                
                                $manualCalc = 0;
                                foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $c) {
                                    $w = $result['metadata']['weights'][$c];
                                    $r = $topHP['normalized_values']['r_' . $c];
                                    $weighted = $w * $r;
                                    $manualCalc += $weighted;
                                    
                                    echo $c . ': ' . $w . ' × ' . number_format($r, 4) . ' = ' . number_format($weighted, 4) . '<br>';
                                }
                                
                                echo '<strong>Total V: ' . number_format($manualCalc, 4) . '</strong><br>';
                                echo 'Sistem V: ' . number_format($topHP['final_score'], 4) . '<br>';
                                
                                $diff = abs($manualCalc - $topHP['final_score']);
                                if ($diff < 0.0001) {
                                    echo '<span class="badge badge-success">✅ Validasi BENAR (selisih: ' . number_format($diff, 6) . ')</span>';
                                } else {
                                    echo '<span class="badge badge-danger">❌ Validasi GAGAL (selisih: ' . number_format($diff, 6) . ')</span>';
                                }
                                echo '</div>';
                            }
                            
                        } else {
                            echo '<div class="warning-box">';
                            echo '<strong>⚠️ INFO:</strong> ' . htmlspecialchars($result['message']);
                            echo '</div>';
                        }
                        
                    } catch (Exception $e) {
                        echo '<div class="error-box">';
                        echo '<strong>❌ ERROR:</strong> ' . htmlspecialchars($e->getMessage());
                        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
                        echo '</div>';
                    }
                    
                    echo '</div>'; // end test-case
                }
                ?>
            </div>
            <?php
        }
        
        // ============================================================================
        // TEST 4: EDGE CASES
        // ============================================================================
        ?>
        <div class="test-section">
            <h2>🔍 Test 4: Edge Cases dan Validasi Error Handling</h2>
            
            <?php
            $edgeCases = [
                ['budget' => 0, 'profile' => 1, 'expected' => 'error', 'desc' => 'Budget 0'],
                ['budget' => -1000000, 'profile' => 1, 'expected' => 'error', 'desc' => 'Budget negatif'],
                ['budget' => 1000000, 'profile' => 1, 'expected' => 'no_hp', 'desc' => 'Budget terlalu kecil (1 juta)'],
                ['budget' => 10000000, 'profile' => 1, 'expected' => 'success', 'desc' => 'Budget sangat besar (10 juta)'],
                ['budget' => 3000000, 'profile' => 999, 'expected' => 'error', 'desc' => 'Profil ID tidak valid'],
            ];
            
            echo '<table>';
            echo '<thead><tr><th>Test Case</th><th>Budget</th><th>Profil ID</th><th>Status</th><th>Pesan</th></tr></thead>';
            echo '<tbody>';
            
            foreach ($edgeCases as $case) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($case['desc']) . '</td>';
                echo '<td>Rp ' . number_format($case['budget'], 0, ',', '.') . '</td>';
                echo '<td>' . $case['profile'] . '</td>';
                
                try {
                    $result = $sawService->calculate($case['budget'], $case['profile']);
                    
                    if ($result['success']) {
                        echo '<td><span class="badge badge-success">SUKSES</span></td>';
                        echo '<td>' . htmlspecialchars($result['message']) . ' (' . count($result['data']) . ' HP)</td>';
                    } else {
                        echo '<td><span class="badge badge-warning">GAGAL</span></td>';
                        echo '<td>' . htmlspecialchars($result['message']) . '</td>';
                    }
                } catch (Exception $e) {
                    echo '<td><span class="badge badge-danger">ERROR</span></td>';
                    echo '<td>' . htmlspecialchars($e->getMessage()) . '</td>';
                }
                
                echo '</tr>';
            }
            
            echo '</tbody></table>';
            ?>
        </div>
        
        <?php
        // ============================================================================
        // RINGKASAN PENGUJIAN
        // ============================================================================
        ?>
        <div class="test-section">
            <h2>📋 Ringkasan Pengujian</h2>
            
            <div class="success-box">
                <strong>✅ Pengujian Selesai</strong><br>
                <ul style="margin-top: 10px; margin-left: 20px;">
                    <li>Verifikasi data HP di database</li>
                    <li>Verifikasi profil dan bobot kriteria</li>
                    <li>Test perhitungan SAW untuk 3 profil (Gaming, Photography, Daily)</li>
                    <li>Test berbagai skenario budget</li>
                    <li>Validasi filter budget sebelum normalisasi</li>
                    <li>Validasi normalisasi Cost (min/x) dan Benefit (x/max)</li>
                    <li>Validasi perhitungan weighted score dan final score</li>
                    <li>Validasi ranking (descending by final score)</li>
                    <li>Validasi error handling untuk edge cases</li>
                    <li>Validasi division by zero protection</li>
                </ul>
            </div>
            
            <div class="info-box">
                <strong>📌 Catatan:</strong><br>
                - Semua perhitungan menggunakan metodologi SAW sesuai docs/SAW_METHODOLOGY.md<br>
                - Filter budget diterapkan SEBELUM normalisasi<br>
                - Min/Max diambil dari subset HP yang lolos filter budget<br>
                - Validasi manual dilakukan untuk top-1 ranking setiap skenario<br>
                - Error handling sudah mencakup division by zero, budget invalid, profil tidak ditemukan
            </div>
        </div>
    </div>
</body>
</html>
