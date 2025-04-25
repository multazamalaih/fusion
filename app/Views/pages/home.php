<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FUSION - Futsal Reccomendation</title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url() ?>/img/logo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/css/style.css" rel="stylesheet">
</head>

<body style="font-family: 'Alata', sans-serif;">

    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" role="status"></div>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container position-relative">

            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="img/logo-fusion.png" alt="FUSION" style="height: 42px;">
            </a>
            <!-- Hamburger Menu (mobile) -->
            <button class="navbar-toggler custom-toggler position-absolute top-0 start-50 translate-middle-x mt-2 z-3 d-lg-none"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Tombol kanan (mobile) -->
            <div class="d-flex d-lg-none mt-2">
                <a href="/login" class="btn btn-sm rounded-pill px-3 me-2 btn-masuk">Masuk</a>
                <a href="register.php" class="btn btn-sm rounded-pill px-3 btn-daftar">Daftar</a>
            </div>

            <!-- Menu Tengah -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav fw-semibold text-center mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Daftar Kriteria</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Lapangan Futsal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rekomendasikan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Tombol kanan (desktop) -->
            <div class="d-none d-lg-flex gap-2">
                <a href="/login" class="btn btn-sm rounded-pill px-3 btn-masuk">Masuk</a>
                <a href="register.php" class="btn btn-sm rounded-pill px-3 btn-daftar">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Navbar End -->

    <section class="hero-banner">
        <div class="overlay"></div>
        <div class="content">
            <h1>Rekomendasi Lapangan Futsal Terbaik Hanya untuk Kamu !</h1>
            <p>Dari harga murah hingga fasilitas lengkap, semua ada di sini. Pilih sekarang !</p>
            <div class="buttons">
                <a href="#" class="btn btn-sm rounded-pill px-3 me-2 btn-masuk">Lihat Rekomendasi</a>
                <a href="#" class="btn btn-sm rounded-pill px-3 btn-daftar">Cari Sesuai Kebutuhanmu</a>
            </div>
        </div>
    </section>


    <section class="kriteria-section py-5 text-center">
        <div class="container">

            <!-- 🔁 Diperbaiki urutan garis -->
            <div class="position-relative d-inline-block mb-3">
                <div class="garis-oranye"></div> <!-- Oranye sekarang di atas -->
                <div class="garis-hijau"></div> <!-- Hijau di bawah -->
            </div>

            <!-- 🔁 Font pada judul otomatis pakai 'Alata' dari CSS -->
            <h2 class="fw-bold">Kriteria Terbaik</h2>

            <!-- ⏺ Tidak ada perubahan di subjudul, stylingnya tetap -->
            <p class="text-muted mb-5">Kami Mengutamakan Kriteria dengan Bobot Prioritas Tinggi!</p>

            <!-- Card Grid -->
            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card-kriteria p-4 h-100">
                        <!-- 🔁 h5 ini akan gunakan 'Open Sans' sesuai CSS -->
                        <h5 class=" fw-bold mb-3">Harga Sewa</h5>

                        <!-- 🔁 Teks dalam tanda kutip pakai 'Alata' -->
                        <p class="fst-italic">“ Semakin murah harga sewa, semakin baik penilaian lapangan di mata pengguna ”</p>

                        <!-- 🔁 Tombol pakai font 'Alata' + outline styling -->
                        <a href="#" class="btn btn-outline-success rounded-pill px-4 mt-3">Detail</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card-kriteria p-4 h-100">
                        <h5 class=" fw-bold mb-3">Kualitas Lapangan</h5>
                        <p class="fst-italic">“ Semakin bagus kualitas lapangan, semakin baik penilaian lapangan di mata pengguna ”</p>
                        <a href="#" class="btn btn-outline-success rounded-pill px-4 mt-3">Detail</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card-kriteria p-4 h-100">
                        <h5 class=" fw-bold mb-3">Kebersihan dan Perawatan</h5>
                        <p class="fst-italic">“ Semakin bersih dan terawat , semakin baik penilaian lapangan di mata pengguna ”</p>
                        <a href="#" class="btn btn-outline-success rounded-pill px-4 mt-3">Detail</a>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- Konten Utama -->
    <main class="container my-5 text-center">
        <h1 class="fw-bold text-success mb-3">Selamat Datang di FUSION</h1>
        <p class="lead">Platform rekomendasi lapangan futsal terbaik berdasarkan berbagai kriteria.</p>
    </main>
    <!-- Konten Utama End -->

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 footer">
        <div class="container py-4">
            <div class="row g-5">
                <!-- Kolom 1 -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">FUSION</h5>
                    <p class="text-white-50">Platform yang memberikan rekomendasi lapangan futsal terbaik berdasarkan preferensi Anda.</p>
                </div>

                <!-- Kolom 2 -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Eksplorasi</h5>
                    <a class="btn btn-link" href="#"><i class="fas fa-angle-right me-2"></i>Daftar Kriteria</a>
                    <a class="btn btn-link" href="#"><i class="fas fa-angle-right me-2"></i>Lapangan Futsal</a>
                </div>

                <!-- Kolom 3 -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Informasi</h5>
                    <a class="btn btn-link" href="#"><i class="fas fa-angle-right me-2"></i>Rekomendasikan</a>
                    <a class="btn btn-link" href="#"><i class="fas fa-angle-right me-2"></i>Tentang Kami</a>
                    <a class="btn btn-link" href="#"><i class="fas fa-angle-right me-2"></i>Kontak Kami</a>
                </div>

                <!-- Kolom 4 -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Hubungi Kami</h5>
                    <p class="text-white-50 mb-2"><i class="fas fa-map-marker-alt me-2"></i>Depok, Indonesia</p>
                    <p class="text-white-50 mb-2"><i class="fas fa-envelope me-2"></i>multazam071220@gmail.com</p>
                    <p class="text-white-50 mb-0"><i class="fab fa-whatsapp me-2"></i>0813-1058-2096</p>
                </div>
            </div>

            <!-- Sosmed + Divider -->
            <div class="text-center mt-5">
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-x-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-tiktok"></i></a>
                </div>

                <hr class="footer-divider mx-auto">

                <p class="text-white-50 small m-0">Copyright by Multazam</p>
            </div>

        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        window.addEventListener('load', function() {
            const spinner = document.getElementById('spinner');
            if (spinner) {
                spinner.classList.remove('show');
            }
        });
    </script>
</body>

</html>