<?= view('pages/templates/header') ?>

<?php if (session()->get('successPesan')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="toastSuccess" class="toast wow fadeInRight align-items-center text-white bg-primary border-0 show" style="font-family:'Alata',sans-serif;"
            role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" data-wow-delay="0.1s">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->get('successPesan') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Kontak Kami</h1>
        <p class="lead animated slideInDown mb-4">Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai rekomendasi lapangan futsal atau bantuan teknis lainnya. Tim kami siap melayani anda dengan sepenuh hati.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Kontak Kami</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Kontak Kami Section -->
<div class="container py-5 mb-5">
    <div class="row g-5">
        <!-- Kolom 5: Informasi Kontak -->
        <div class="col-lg-5 kontak-info wow fadeInLeft" data-wow-delay="0.1s">
            <div class="p-5 rounded-4 shadow-sm text-white" style="background-color: #3CB815;">
                <h5>Telepon</h5>
                <p><i class="fab fa-whatsapp me-2"></i> 081310582096</p>
                <h5>Email</h5>
                <p class="d-flex align-items-center mb-3">
                    <i class="fas fa-envelope me-2"></i>
                    <a href="mailto:multazam071220@gmail.com" class="text-white text-decoration-underline">multazam071220@gmail.com</a>
                </p>
                <h5>Alamat</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i> Dara 5 Blok Dg 6, Pondok Petir, Bojongsari, Depok</p>
                <h5>Media Sosial</h5>
                <div class="d-flex mt-3">
                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-2" href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <!-- Kolom 7: Form Kontak -->
        <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.1s">
            <div class="bg-white p-5 rounded shadow content-rekomendasi">
                <form method="post" action="/kontak-kami">
                    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-4">
                        <div class="col mb-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control rounded-pill <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" name="nama" <?= checkLogin() ? 'readonly' : '' ?> id="nama" required value="<?= getUser()['nama'] ?? '' ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('nama')  ?>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control rounded-pill <?= validation_show_error('email') ? 'is-invalid' : '' ?>" name="email" value="<?= getUser()['email'] ?? '' ?>" <?= checkLogin() ? 'readonly' : '' ?> id="email" required>
                            <div class="invalid-feedback">
                                <?= validation_show_error('email')  ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea class="form-control <?= validation_show_error('pesan') ? 'is-invalid' : '' ?>" id="pesan" name="pesan" rows="4" style="border-radius: 12px;" required></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('pesan')  ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 w-100" style="letter-spacing: 8px;">K I R I M</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ====== Akhir Main Konten ====== -->

<?= view('pages/templates/footer') ?>