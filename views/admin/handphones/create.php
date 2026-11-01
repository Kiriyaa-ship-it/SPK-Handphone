<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Handphone - Admin SPK</title>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body>
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>
    
    <div class="container">
        <div class="page-header">
            <h1>Tambah Handphone Baru</h1>
            <p>Masukkan data handphone yang akan ditambahkan</p>
        </div>
        
        <?php
        $flash = getFlash();
        if ($flash):
        ?>
        <div class="alert alert-<?= $flash['type'] ?>">
            <?= $flash['message'] ?>
        </div>
        <?php endif; ?>
        
        <div class="form-card">
            <form method="POST" action="<?= url('admin/handphones/create') ?>" enctype="multipart/form-data">
                <?= csrfField() ?>
                
                <div class="form-group">
                    <label for="nama">Nama Handphone *</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="merk">Merk *</label>
                    <input type="text" id="merk" name="merk" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="harga">Harga (Rp) *</label>
                        <input type="number" id="harga" name="harga" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="chipset_skala">Chipset (Skala 1-5) *</label>
                        <select id="chipset_skala" name="chipset_skala" required>
                            <option value="">Pilih</option>
                            <option value="1">1 - Sangat Rendah</option>
                            <option value="2">2 - Rendah</option>
                            <option value="3">3 - Sedang</option>
                            <option value="4">4 - Tinggi</option>
                            <option value="5">5 - Sangat Tinggi</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="ram_gb">RAM (GB) *</label>
                        <input type="number" id="ram_gb" name="ram_gb" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="storage_gb">Storage (GB) *</label>
                        <input type="number" id="storage_gb" name="storage_gb" min="1" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="kamera_skala">Kamera (Skala 1-5) *</label>
                    <select id="kamera_skala" name="kamera_skala" required>
                        <option value="">Pilih</option>
                        <option value="1">1 - Sangat Rendah</option>
                        <option value="2">2 - Rendah</option>
                        <option value="3">3 - Sedang</option>
                        <option value="4">4 - Tinggi</option>
                        <option value="5">5 - Sangat Tinggi</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="gambar">Gambar Handphone</label>
                    <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/jpg,image/png">
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= url('admin/handphones') ?>" class="btn" style="background: #e2e8f0;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
