<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SPK Handphone</title>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body>
    <?php require_once __DIR__ . '/partials/navbar.php'; ?>
    
    <div class="container">
        <div class="page-header">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, <?= getAuthUser()['nama_lengkap'] ?? 'Admin' ?></p>
        </div>
        
        <?php
        $flash = getFlash();
        if ($flash):
        ?>
        <div class="alert alert-<?= $flash['type'] ?>">
            <?= $flash['message'] ?>
        </div>
        <?php endif; ?>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📱</div>
                <div class="stat-content">
                    <div class="stat-value"><?= $totalHandphones ?></div>
                    <div class="stat-label">Total Handphone</div>
                </div>
            </div>
        </div>
        
        <div class="quick-actions">
            <h2>Menu Cepat</h2>
            <div class="action-grid">
                <a href="<?= url('admin/handphones') ?>" class="action-card">
                    <div class="action-icon">📋</div>
                    <div class="action-title">Kelola Handphone</div>
                    <div class="action-desc">Tambah, edit, hapus data handphone</div>
                </a>
                
                <a href="<?= url() ?>" class="action-card" target="_blank">
                    <div class="action-icon">🌐</div>
                    <div class="action-title">Lihat Website</div>
                    <div class="action-desc">Buka halaman publik</div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
