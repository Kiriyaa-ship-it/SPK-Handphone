#!/usr/bin/env php
<?php
/**
 * CLI Test Script untuk SawService.php
 * Jalankan: php tests/test_saw_cli.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Change to project root
chdir(__DIR__ . '/..');

require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/models/Handphone.php';
require_once __DIR__ . '/../app/models/Profile.php';
require_once __DIR__ . '/../app/services/SawService.php';

// Color output helper
function colorize($text, $color) {
    $colors = [
        'red' => "\033[31m",
        'green' => "\033[32m",
        'yellow' => "\033[33m",
        'blue' => "\033[34m",
        'magenta' => "\033[35m",
        'cyan' => "\033[36m",
        'white' => "\033[37m",
        'reset' => "\033[0m",
        'bold' => "\033[1m",
    ];
    return ($colors[$color] ?? '') . $text . $colors['reset'];
}

function printHeader($text) {
    echo "\n" . colorize(str_repeat('=', 80), 'cyan') . "\n";
    echo colorize($text, 'bold') . "\n";
    echo colorize(str_repeat('=', 80), 'cyan') . "\n\n";
}

function printSuccess($text) {
    echo colorize("✅ ", 'green') . $text . "\n";
}

function printError($text) {
    echo colorize("❌ ", 'red') . $text . "\n";
}

function printWarning($text) {
    echo colorize("⚠️  ", 'yellow') . $text . "\n";
}

function printInfo($text) {
    echo colorize("ℹ️  ", 'blue') . $text . "\n";
}

// Initialize
try {
    $db = getDbConnection();
    if (!$db) {
        printError("Gagal koneksi database!");
        exit(1);
    }
    
    $handphoneModel = new Handphone($db);
    $profileModel = new Profile($db);
    $sawService = new SawService($db, $handphoneModel, $profileModel);
    
    printSuccess("Koneksi database berhasil!");
    
} catch (Exception $e) {
    printError("Error inisialisasi: " . $e->getMessage());
    exit(1);
}

// ============================================================================
// TEST 1: VERIFIKASI DATA HP DI DATABASE
// ============================================================================
printHeader("TEST 1: Verifikasi Data HP di Database");

try {
    $allHandphones = $handphoneModel->getAll();
    $countHP = count($allHandphones);
    
    if ($countHP >= 10) {
        printSuccess("Ditemukan $countHP data handphone di database.");
    } else {
        printWarning("Hanya ditemukan $countHP data handphone. Harusnya minimal 10 data.");
        printInfo("Jalankan: mysql -u root -p spk_handphone < database/seeds/002_test_handphones.sql");
    }
    
    echo "\n" . colorize("Daftar HP:", 'bold') . "\n";
    printf("%-4s %-35s %-12s %-15s %s/%s %s/%s\n", 
        "ID", "Nama", "Merk", "Harga", "Chip", "Kam", "RAM", "Stor");
    echo str_repeat('-', 90) . "\n";
    
    foreach ($allHandphones as $hp) {
        printf("%-4d %-35s %-12s Rp %11s   %d    %d   %3d  %3d\n",
            $hp['id'],
            substr($hp['nama'], 0, 35),
            $hp['merk'],
            number_format($hp['harga'], 0, ',', '.'),
            $hp['chipset_skala'],
            $hp['kamera_skala'],
            $hp['ram_gb'],
            $hp['storage_gb']
        );
    }
    
} catch (Exception $e) {
    printError("Error: " . $e->getMessage());
}

// ============================================================================
// TEST 2: VERIFIKASI PROFIL DAN BOBOT
// ============================================================================
printHeader("TEST 2: Verifikasi Profil dan Bobot");

try {
    $profiles = $profileModel->getAllWithWeights();
    
    echo colorize("Profil dan Bobot Kriteria:", 'bold') . "\n";
    printf("%-3s %-15s %6s %6s %6s %6s %6s %6s\n",
        "ID", "Profil", "C1", "C2", "C3", "C4", "C5", "Total");
    echo str_repeat('-', 70) . "\n";
    
    foreach ($profiles as $profile) {
        $weightsMap = [];
        foreach ($profile['weights'] as $w) {
            $weightsMap[$w['criteria_kode']] = $w['bobot'];
        }
        $c1 = $weightsMap['C1'] ?? 0;
        $c2 = $weightsMap['C2'] ?? 0;
        $c3 = $weightsMap['C3'] ?? 0;
        $c4 = $weightsMap['C4'] ?? 0;
        $c5 = $weightsMap['C5'] ?? 0;
        $total = $c1 + $c2 + $c3 + $c4 + $c5;
        
        printf("%-3d %-15s %6.2f %6.2f %6.2f %6.2f %6.2f %6.2f\n",
            $profile['id'],
            $profile['nama'],
            $c1, $c2, $c3, $c4, $c5,
            $total
        );
        
        if (abs($total - 1.0) > 0.001) {
            printWarning("Total bobot profil '{$profile['nama']}' = $total (harusnya 1.0)");
        }
    }
    
} catch (Exception $e) {
    printError("Error: " . $e->getMessage());
}

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

$totalTests = 0;
$passedTests = 0;
$failedTests = 0;

foreach ($testCases as $testCase) {
    printHeader("TEST 3: Profil {$testCase['profile_name']}");
    
    foreach ($testCase['budgets'] as $budget) {
        $totalTests++;
        
        echo "\n" . colorize("💰 Budget: Rp " . number_format($budget, 0, ',', '.'), 'yellow') . "\n";
        echo str_repeat('-', 80) . "\n";
        
        try {
            $result = $sawService->calculate($budget, $testCase['profile_id']);
            
            if ($result['success']) {
                printSuccess($result['message']);
                $passedTests++;
                
                // Metadata
                $meta = $result['metadata'];
                echo "  Profil: " . $meta['profile_nama'] . "\n";
                echo "  Total Alternatif: {$meta['total_alternatives']} HP\n";
                echo "  Lolos Filter Budget: {$meta['filtered_alternatives']} HP\n";
                
                // Bobot
                echo "  Bobot: C1={$meta['weights']['C1']} C2={$meta['weights']['C2']} " .
                     "C3={$meta['weights']['C3']} C4={$meta['weights']['C4']} C5={$meta['weights']['C5']}\n";
                
                // Normalisasi Reference
                $norm = $meta['normalization_references'];
                echo "  Min/Max: minC1=" . number_format($norm['min_C1'], 0) . 
                     " maxC2={$norm['max_C2']} maxC3={$norm['max_C3']} " .
                     "maxC4={$norm['max_C4']} maxC5={$norm['max_C5']}\n";
                
                // Top 5 Ranking
                echo "\n  " . colorize("Top 5 Ranking:", 'bold') . "\n";
                printf("  %-4s %-30s %-15s %10s\n", "Rank", "Nama HP", "Harga", "Score");
                echo "  " . str_repeat('-', 70) . "\n";
                
                $displayCount = min(5, count($result['data']));
                for ($i = 0; $i < $displayCount; $i++) {
                    $item = $result['data'][$i];
                    printf("  %-4d %-30s Rp %11s %10.4f\n",
                        $item['rank'],
                        substr($item['handphone_nama'], 0, 30),
                        number_format($item['raw_values']['C1'], 0, ',', '.'),
                        $item['final_score']
                    );
                }
                
                // Validasi Perhitungan Manual untuk Rank 1
                if (count($result['data']) > 0) {
                    $topHP = $result['data'][0];
                    echo "\n  " . colorize("Validasi Perhitungan Manual (Rank #1):", 'bold') . "\n";
                    echo "  HP: {$topHP['handphone_nama']}\n";
                    
                    $manualCalc = 0;
                    foreach (['C1', 'C2', 'C3', 'C4', 'C5'] as $c) {
                        $w = $meta['weights'][$c];
                        $r = $topHP['normalized_values']['r_' . $c];
                        $weighted = $w * $r;
                        $manualCalc += $weighted;
                        
                        echo sprintf("  %s: %.2f × %.4f = %.4f\n", $c, $w, $r, $weighted);
                    }
                    
                    echo sprintf("  Total Manual: %.4f\n", $manualCalc);
                    echo sprintf("  Total Sistem: %.4f\n", $topHP['final_score']);
                    
                    $diff = abs($manualCalc - $topHP['final_score']);
                    if ($diff < 0.0001) {
                        printSuccess("Validasi BENAR (selisih: " . number_format($diff, 6) . ")");
                    } else {
                        printError("Validasi GAGAL (selisih: " . number_format($diff, 6) . ")");
                        $failedTests++;
                        $passedTests--;
                    }
                }
                
            } else {
                printWarning($result['message']);
                // Ini bukan error, tapi kondisi valid (misal: tidak ada HP dalam budget)
            }
            
        } catch (Exception $e) {
            printError("ERROR: " . $e->getMessage());
            $failedTests++;
            $passedTests--;
        }
    }
}

// ============================================================================
// TEST 4: EDGE CASES
// ============================================================================
printHeader("TEST 4: Edge Cases dan Error Handling");

$edgeCases = [
    ['budget' => 0, 'profile' => 1, 'desc' => 'Budget 0 (harus error)'],
    ['budget' => -1000000, 'profile' => 1, 'desc' => 'Budget negatif (harus error)'],
    ['budget' => 1000000, 'profile' => 1, 'desc' => 'Budget terlalu kecil (tidak ada HP)'],
    ['budget' => 10000000, 'profile' => 1, 'desc' => 'Budget sangat besar (semua HP)'],
    ['budget' => 3000000, 'profile' => 999, 'desc' => 'Profil ID tidak valid (harus error)'],
];

printf("%-50s %-15s %s\n", "Test Case", "Budget", "Status");
echo str_repeat('-', 80) . "\n";

foreach ($edgeCases as $case) {
    printf("%-50s Rp %11s ", $case['desc'], number_format($case['budget'], 0, ',', '.'));
    
    try {
        $result = $sawService->calculate($case['budget'], $case['profile']);
        
        if ($result['success']) {
            echo colorize("✅ SUKSES (" . count($result['data']) . " HP)", 'green') . "\n";
        } else {
            echo colorize("⚠️  GAGAL: " . $result['message'], 'yellow') . "\n";
        }
    } catch (Exception $e) {
        echo colorize("❌ ERROR: " . $e->getMessage(), 'red') . "\n";
    }
}

// ============================================================================
// RINGKASAN
// ============================================================================
printHeader("RINGKASAN PENGUJIAN");

echo colorize("Total Test Cases: ", 'bold') . $totalTests . "\n";
echo colorize("✅ Passed: ", 'green') . $passedTests . "\n";
echo colorize("❌ Failed: ", 'red') . $failedTests . "\n";

$successRate = $totalTests > 0 ? ($passedTests / $totalTests * 100) : 0;
echo colorize("Success Rate: ", 'bold') . sprintf("%.1f%%", $successRate) . "\n";

if ($failedTests == 0) {
    echo "\n" . colorize("🎉 SEMUA TEST PASSED! SawService.php bekerja dengan baik.", 'green') . "\n";
} else {
    echo "\n" . colorize("⚠️  Ada $failedTests test yang gagal. Periksa log di atas.", 'yellow') . "\n";
}

echo "\n" . colorize("Pengujian selesai pada " . date('Y-m-d H:i:s'), 'cyan') . "\n\n";
