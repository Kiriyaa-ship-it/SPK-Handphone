<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>SPK Rekomendasi Handphone</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo asset('images/favicon.svg'); ?>">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    
    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="<?php echo url(); ?>">
                    <i class="fas fa-mobile-alt"></i>
                    SPK Handphone
                </a>
            </div>
            <div class="navbar-menu">
                <a href="<?php echo url(); ?>" class="nav-link">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="<?php echo url('rekomendasi'); ?>" class="nav-link">
                    <i class="fas fa-search"></i> Cari Rekomendasi
                </a>
                <a href="<?php echo url('admin/login'); ?>" class="nav-link">
                    <i class="fas fa-user-shield"></i> Admin
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Flash Message -->
    <?php 
    $flash = getFlash();
    if ($flash): 
    ?>
    <div class="flash-message flash-<?php echo $flash['type']; ?>">
        <div class="container">
            <span class="flash-icon">
                <?php if ($flash['type'] === 'success'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php elseif ($flash['type'] === 'error'): ?>
                    <i class="fas fa-exclamation-circle"></i>
                <?php elseif ($flash['type'] === 'warning'): ?>
                    <i class="fas fa-exclamation-triangle"></i>
                <?php else: ?>
                    <i class="fas fa-info-circle"></i>
                <?php endif; ?>
            </span>
            <span class="flash-text"><?php echo htmlspecialchars($flash['message']); ?></span>
            <button class="flash-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main class="main-content">
