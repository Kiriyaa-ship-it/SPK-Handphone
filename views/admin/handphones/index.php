<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Handphone - Admin SPK</title>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body>
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>
    
    <div class="container">
        <?php
        $flash = getFlash();
        if ($flash):
        ?>
        <div class="alert alert-<?= $flash['type'] ?>">
            <?= $flash['message'] ?>
        </div>
        <?php endif; ?>
        
        <div class="table-container">
            <div class="table-header">
                <h2>Data Handphone</h2>
                <a href="<?= url('admin/handphones/create') ?>" class="btn btn-primary">+ Tambah Handphone</a>
            </div>
            
            <?php if (empty($handphones)): ?>
            <div class="empty-state">
                <p>Belum ada data handphone</p>
                <a href="<?= url('admin/handphones/create') ?>" class="btn btn-primary" style="margin-top: 16px;">Tambah Handphone Pertama</a>
            </div>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Harga</th>
                        <th>Chipset</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>Kamera</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($handphones as $hp): ?>
                    <tr>
                        <td><?= $hp['id'] ?></td>
                        <td><?= htmlspecialchars($hp['nama']) ?></td>
                        <td><?= htmlspecialchars($hp['merk']) ?></td>
                        <td><?= formatRupiah($hp['harga']) ?></td>
                        <td><?= $hp['chipset_skala'] ?>/5</td>
                        <td><?= $hp['ram_gb'] ?> GB</td>
                        <td><?= $hp['storage_gb'] ?> GB</td>
                        <td><?= $hp['kamera_skala'] ?>/5</td>
                        <td>
                            <div class="table-actions">
                                <a href="<?= url('admin/handphones/edit/' . $hp['id']) ?>" class="btn btn-success btn-sm">Edit</a>
                                
                                <form method="POST" action="<?= url('admin/handphones/delete/' . $hp['id']) ?>" style="display: inline;" onsubmit="return confirm('Yakin hapus handphone ini?')">
                                    <?= csrfField() ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
