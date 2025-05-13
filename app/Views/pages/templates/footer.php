    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Kolom 1 -->
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-white mb-4" style="letter-spacing: 5px;">FUSION</h1>
                    <p>Website yang memberikan rekomendasi lapangan futsal terbaik berdasarkan berbagai kriteria untuk memenuhi kebutuhan anda.</p>
                </div>

                <!-- Kolom 2 -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Eksplorasi Lapangan</h4>
                    <a class="btn btn-link" href="/daftar-kriteria">Daftar Kriteria</a>
                    <a class="btn btn-link" href="/daftar-lapangan-futsal">Daftar Lapangan Futsal</a>
                </div>

                <!-- Kolom 3 -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Layanan & Informasi</h4>
                    <a class="btn btn-link" href="/rekomendasikan">Rekomendasikan</a>
                    <a class="btn btn-link" href="/tentang-kami">Tentang Kami</a>
                    <a class="btn btn-link" href="/kontak-kami">Kontak Kami</a>
                </div>

                <!-- Kolom 4 -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Hubungi Kami</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Pondok Petir, Bojongsari, Depok</p>
                    <p><i class="fa fa-envelope me-3"></i>multazam071220@gmail.com</p>
                    <?php
                    $nomor = !empty($kontak['whatsapp']) ? preg_replace('/^0/', '62', $kontak['whatsapp']) : '';
                    $link = $nomor ? 'https://wa.me/' . $nomor : '#';
                    ?>
                    <p>
                        <i class="fab fa-whatsapp me-3"></i>
                        <a href="<?= $link ?>" target="_blank">
                            <?= esc($kontak['whatsapp']) ?>
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="<?= !empty($kontak['instagram']) ? esc($kontak['instagram']) : '#' ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="<?= !empty($kontak['facebook']) ? esc($kontak['facebook']) : '#' ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="<?= !empty($kontak['twitter']) ? esc($kontak['twitter']) : '#' ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="<?= !empty($kontak['tiktok']) ? esc($kontak['tiktok']) : '#' ?>" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- COPYRIGHT -->
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; <a href="#">Fusion</a>, All Right Reserved | Designed By Multazam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>


    <script src="<?= base_url('/assets/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('/assets/js/main.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aktifkan tab dari hash URL saat halaman dimuat
            const hash = window.location.hash;
            if (hash) {
                const tabTrigger = document.querySelector(`.nav-link[href="${hash}"]`);
                if (tabTrigger) {
                    new bootstrap.Tab(tabTrigger).show();
                }
            }

            // Ganti hash URL saat tab diklik
            document.querySelectorAll('.nav-link[data-bs-toggle="tab"]').forEach(function(tab) {
                tab.addEventListener('shown.bs.tab', function(e) {
                    const newHash = e.target.getAttribute('href');
                    history.replaceState(null, null, newHash);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('toastSuccess');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show(); // <-- ini penting agar autohide dan delay aktif
            }
        });
    </script>

    </body>

    </html>