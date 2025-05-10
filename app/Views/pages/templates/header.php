<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fusion - Futsal Recommendation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('/assets/img/logo-baru.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('/assets/img/logo-baru.png') ?>" type="image/x-icon">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('/assets/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('/assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('/assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <nav class="navbar navbar-expand-lg bg-white shadow-sm">
            <div class="container d-flex align-items-center justify-content-between">

                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="index.php" style="text-decoration: none; font-family: 'Alata', sans-serif;">
                    <img src="<?= base_url('/assets/img/logo-baru.png') ?>" alt="Logo Fusion" style="height: 40px; margin-right: 8px;">
                    <div class="d-flex flex-column">
                        <span style="font-size: 15px; font-weight: bold; color: #000; letter-spacing: 5px;">FUSION</span>
                        <span style="font-size: 10px; letter-spacing: 2px; color: #555;">FUTSAL RECOMMENDATION</span>
                    </div>
                </a>


                <!-- Hamburger (hanya mobile) -->
                <button class="navbar-toggler custom-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapse menu -->
                <div class="collapse navbar-collapse flex-grow-1" id="navbarNav">
                    <ul class="navbar-nav me-auto ms-3 gap-lg-3 text-center">
                        <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="/daftar-kriteria">Daftar Kriteria</a></li>
                        <li class="nav-item"><a class="nav-link" href="/daftar-lapangan-futsal">Daftar Lapangan Futsal</a></li>
                        <li class="nav-item"><a class="nav-link" href="/rekomendasikan">Rekomendasikan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/tentang-kami">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="/kontak-kami">Kontak Kami</a></li>
                    </ul>

                    <!-- Tombol Desktop (kanan) -->
                    <?php if (checkLogin()) : ?>
                        <div class="d-none d-lg-flex align-items-center gap-2 ms-auto">
                            <span class="fw-bold user-name" style="color: #222; white-space: nowrap;">
                                <?= htmlspecialchars(getUser()['nama'] ?? 'PENGGUNA') ?>
                            </span>
                            <div class="dropdown">
                                <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('/assets/img/user-baru.png') ?>" alt="User" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="nav-buttons d-none d-lg-flex gap-2 align-items-center ms-auto">
                            <a href="/login" class="btn btn-primary rounded-pill px-4 py-2">Masuk</a>
                            <a href="/register" class="btn btn-secondary rounded-pill px-4 py-2">Daftar</a>
                        </div>
                    <?php endif; ?>

                    <!-- Tombol Mobile (collapse) -->
                    <?php if (checkLogin()) : ?>
                        <div class="collapse-buttons d-flex d-lg-none flex-row gap-2 mt-3 w-100">
                            <a href="profil.php" class="btn btn-primary rounded-pill px-4 py-2 w-100">Profil</a>
                            <a href="#" class="btn btn-secondary  rounded-pill px-4 py-2 w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a>
                        </div>
                    <?php else : ?>
                        <div class="collapse-buttons d-flex d-lg-none flex-row gap-2 mt-3 w-100">
                            <a href="/login" class="btn btn-primary  rounded-pill px-4 py-2 w-100">Masuk</a>
                            <a href="/register" class="btn btn-secondary  rounded-pill px-4 py-2 w-100">Daftar</a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </nav>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="font-family:Alata, sans-serif;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar? Pilih 'Keluar' untuk melanjutkan.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning rounded-pill py-2 px-3" type="button" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <form action="/logout" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger rounded-pill py-2 px-3">Keluar

                    </form>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->