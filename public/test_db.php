<?php
/**
 * Test Koneksi Database
 * Sistem Pendukung Keputusan Pemilihan Handphone
 */

// Include konfigurasi database
require_once '../app/config/database.php';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Koneksi Database - SPK Handphone</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .section {
            margin-bottom: 25px;
            padding: 15px;
            border-left: 4px solid #667eea;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .section h2 {
            color: #667eea;
            font-size: 16px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            min-width: 120px;
        }
        
        .info-value {
            color: #333;
        }
        
        .status {
            margin-top: 25px;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: 600;
        }
        
        .status.success {
            background-color: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
        }
        
        .status.error {
            background-color: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
        }
        
        .status-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .status-message {
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        table th {
            background-color: #667eea;
            color: white;
            padding: 10px;
            text-align: left;
        }
        
        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Test Koneksi Database</h1>
        <p class="subtitle">Sistem Pendukung Keputusan Pemilihan Handphone</p>
        
        <!-- Konfigurasi Database -->
        <div class="section">
            <h2>📋 Konfigurasi Database</h2>
            <div class="info-row">
                <span class="info-label">Host:</span>
                <span class="info-value"><?php echo DB_HOST; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Database:</span>
                <span class="info-value"><?php echo DB_NAME; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Username:</span>
                <span class="info-value"><?php echo DB_USER; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Charset:</span>
                <span class="info-value"><?php echo DB_CHARSET; ?></span>
            </div>
        </div>
        
        <!-- Status Koneksi -->
        <div class="section">
            <h2>🔌 Status Koneksi</h2>
            <?php
            if ($db !== null) {
                echo '<div class="status success">';
                echo '<div class="status-icon">✓</div>';
                echo '<div class="status-message">Koneksi Database Berhasil!</div>';
                echo '<small>Database siap digunakan untuk aplikasi SPK Handphone</small>';
                echo '</div>';
                
                // Tampilkan informasi database
                echo '<table>';
                echo '<tr>';
                echo '<th>Informasi Database</th>';
                echo '<th>Nilai</th>';
                echo '</tr>';
                
                // Versi MySQL
                $result = $db->query("SELECT VERSION() as version");
                $versionRow = $result->fetch();
                echo '<tr>';
                echo '<td>Versi MySQL</td>';
                echo '<td>' . htmlspecialchars($versionRow['version']) . '</td>';
                echo '</tr>';
                
                // Jumlah tabel
                $result = $db->query("SELECT COUNT(*) as table_count FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . DB_NAME . "'");
                $tableRow = $result->fetch();
                echo '<tr>';
                echo '<td>Jumlah Tabel</td>';
                echo '<td>' . $tableRow['table_count'] . '</td>';
                echo '</tr>';
                
                // Karakter Set Database
                $result = $db->query("SELECT @@character_set_database as charset");
                $charsetRow = $result->fetch();
                echo '<tr>';
                echo '<td>Character Set Database</td>';
                echo '<td>' . htmlspecialchars($charsetRow['charset']) . '</td>';
                echo '</tr>';
                
                echo '</table>';
            } else {
                echo '<div class="status error">';
                echo '<div class="status-icon">✗</div>';
                echo '<div class="status-message">Koneksi Database Gagal!</div>';
                echo '<small>Periksa konfigurasi database dan pastikan server MySQL berjalan</small>';
                echo '</div>';
            }
            ?>
        </div>
        
        <!-- Tips & Troubleshooting -->
        <div class="section">
            <h2>💡 Tips Troubleshooting</h2>
            <ul style="padding-left: 20px; color: #555; font-size: 13px; line-height: 1.8;">
                <li>Pastikan server MySQL (XAMPP/WAMP) sudah berjalan</li>
                <li>Pastikan database <strong><?php echo DB_NAME; ?></strong> telah dibuat</li>
                <li>Pastikan file migration 001_create_tables.sql telah dijalankan</li>
                <li>Pastikan file seed 001_initial_data.sql telah dijalankan</li>
                <li>Jika gagal, periksa username dan password database di app/config/database.php</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>SPK Handphone &copy; 2026 | Sistem Pendukung Keputusan Pemilihan Handphone</p>
        </div>
    </div>
</body>
</html>
