<?= view('pages/templates/header') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Kontak Kami</h1>
        <p class="lead animated slideInDown mb-4">Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai rekomendasi lapangan futsal atau bantuan teknis lainnya. Tim kami siap melayani anda dengan sepenuh hati.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class=" breadcrumb-item "><a href=" index.php">Fusion</a></li>
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
                <form>
                    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-4">
                        <div class="col mb-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control rounded-pill" <?= checkLogin() ? 'readonly' : '' ?> id="nama" required value="<?= getUser()['nama'] ?? '' ?>">
                        </div>
                        <div class="col mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control rounded-pill" value="<?= getUser()['email'] ?? '' ?>" <?= checkLogin() ? 'readonly' : '' ?> id="email" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="4" style="border-radius: 12px;" required></textarea>
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