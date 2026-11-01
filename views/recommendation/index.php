<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title"><i class="fas fa-search"></i> Cari Rekomendasi Handphone</h1>
            <p>Masukkan anggaran dan pilih profil penggunaan untuk mendapatkan rekomendasi terbaik.</p>
        </div>
        <div class="card-body">
            <form action="<?php echo url('rekomendasi/proses'); ?>" method="POST">
                <?php echo csrfField(); ?>
                
                <div class="form-group">
                    <label for="budget" class="form-label">Anggaran Maksimal (Rp)</label>
                    <div class="input-with-icon">
                        <i class="fas fa-wallet"></i>
                        <input type="number" name="budget" id="budget" class="form-control" placeholder="Contoh: 5000000" min="1000000" required>
                    </div>
                    <small class="text-muted">Masukkan angka tanpa titik atau koma. Contoh: 5000000 untuk 5 Juta.</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profil Kebutuhan</label>
                    <div class="profile-options">
                        <?php foreach ($profiles as $profile): ?>
                        <label class="profile-card">
                            <input type="radio" name="profile_id" value="<?php echo $profile['id']; ?>" required>
                            <div class="profile-card-content">
                                <div class="profile-icon">
                                    <?php 
                                    $icon = 'mobile-alt';
                                    if (stripos($profile['nama'], 'gaming') !== false) $icon = 'gamepad';
                                    elseif (stripos($profile['nama'], 'photo') !== false || stripos($profile['nama'], 'kamera') !== false) $icon = 'camera';
                                    elseif (stripos($profile['nama'], 'daily') !== false || stripos($profile['nama'], 'harian') !== false) $icon = 'tasks';
                                    ?>
                                    <i class="fas fa-<?php echo $icon; ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($profile['nama']); ?></h3>
                                <p><?php echo htmlspecialchars($profile['deskripsi']); ?></p>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="form-actions mt-4 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-calculator"></i> Hitung Rekomendasi
                    </button>
                    <a href="<?php echo url(); ?>" class="btn btn-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.input-with-icon {
    position: relative;
}
.input-with-icon i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary);
}
.input-with-icon .form-control {
    padding-left: 45px;
}

.profile-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-sm);
}

.profile-card {
    cursor: pointer;
}

.profile-card input {
    display: none;
}

.profile-card-content {
    border: 2px solid #e5e7eb;
    border-radius: var(--radius-lg);
    padding: var(--spacing-md);
    text-align: center;
    transition: var(--transition);
    height: 100%;
}

.profile-card input:checked + .profile-card-content {
    border-color: var(--primary);
    background-color: rgba(102, 126, 234, 0.05);
    box-shadow: var(--shadow-md);
}

.profile-icon {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: var(--spacing-sm);
}

.profile-card h3 {
    margin-bottom: var(--spacing-xs);
    font-size: 1.25rem;
}

.profile-card p {
    font-size: 0.875rem;
    color: #6b7280;
}

.profile-card:hover .profile-card-content {
    border-color: var(--primary);
    transform: translateY(-5px);
}
</style>
