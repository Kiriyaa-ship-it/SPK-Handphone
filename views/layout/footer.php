    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><i class="fas fa-mobile-alt"></i> SPK Handphone</h3>
                    <p>Sistem Pendukung Keputusan Pemilihan Handphone menggunakan metode Simple Additive Weighting (SAW)</p>
                </div>
                <div class="footer-section">
                    <h3><i class="fas fa-link"></i> Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo url(); ?>">Home</a></li>
                        <li><a href="<?php echo url('rekomendasi'); ?>">Cari Rekomendasi</a></li>
                        <li><a href="<?php echo url('admin/login'); ?>">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3><i class="fas fa-info-circle"></i> Informasi</h3>
                    <ul>
                        <li><i class="fas fa-graduation-cap"></i> Tugas Akhir Teamwork Building</li>
                        <li><i class="fas fa-calendar"></i> 2026</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> SPK Handphone. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Main JavaScript -->
    <script src="<?php echo asset('js/script.js'); ?>"></script>
</body>
</html>
