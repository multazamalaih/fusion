<!DOCTYPE html>
<html lang="id">

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

<body class="login-page">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <div class="container py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="bg-white p-5 rounded shadow content-rekomendasi">
                    <h2 class="text-center text-dark mb-4" style="letter-spacing: 2px;">Masuk</h2>
                    <form action="/login" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-4 form-group input-group has-validation">
                            <input type="email" name="email" id="email" class="form-control rounded-pill <?= session()->getFlashdata('errorEmail') ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= old('email') ?>" required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errorEmail')  ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <input type="password" id="password" name="password" class="form-control rounded-pill <?= session()->getFlashdata('errorPassword') ? 'is-invalid' : '' ?>" placeholder="Password" required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errorEmail') ?>
                            </div>

                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 w-100" style="letter-spacing: 8px;">MASUK</button>
                        </div>

                        <div class="register-link text-center">
                            Belum punya akun? <a href="/register" class="text-secondary">Daftar di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/assets/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('/assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('/assets/js/main.js') ?>"></script>
</body>


</html>