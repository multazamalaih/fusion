<?= view('pages/templates/header') ?>

<?php if (session()->get('successProfil')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="toastSuccess" class="toast wow fadeInRight align-items-center text-white bg-primary border-0 show" style="font-family:'Alata',sans-serif;"
            role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" data-wow-delay="0.1s">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->get('successProfil') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Profil</h1>
        <p class="lead animated slideInDown mb-4">
            Selamat datang di halaman profil Anda. Di sini, Anda dapat melihat informasi akun Anda serta memperbarui kata sandi untuk menjaga keamanan akun.
        </p>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Profil</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- ====== Main Konten Rekomendasikan ====== -->
<div class="container py-6">
    <div class="row justify-content-center">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="bg-white p-5 rounded shadow content-rekomendasi">
                <form method="post" action="/update-profil">
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control rounded-pill <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?? $user['nama'] ?>" placeholder="Nama">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama')  ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control rounded-pill" id="email" readonly name="email" value="<?= $user['email'] ?>" placeholder="Email" required>
                    </div>
                    <div class="mb-4">
                        <label for="passwordLama" class="form-label">Password Lama</label>
                        <input type="password" class="form-control rounded-pill <?= validation_show_error('passwordLama') ? 'is-invalid' : '' ?>" id="passwordLama" name="passwordLama">
                        <div class="invalid-feedback">
                            <?= validation_show_error('passwordLama')  ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="passwordBaru" class="form-label">Password Baru</label>
                        <input type="password" class="form-control rounded-pill <?= validation_show_error('passwordBaru') ? 'is-invalid' : '' ?>" id="passwordBaru" name="passwordBaru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('passwordBaru')  ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="konfirmasi" class="form-label">Ulangi Password</label>
                        <input type="password" class="form-control rounded-pill <?= validation_show_error('konfirmasi') ? 'is-invalid' : '' ?>" id="konfirmasi" name="konfirmasi">
                        <div class="invalid-feedback">
                            <?= validation_show_error('konfirmasi')  ?>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2" style="letter-spacing: 8px;">UPDATE</button>
                        </div>
                        <div class="col-6 d-grid">
                            <button type="reset" class="btn btn-secondary rounded-pill py-2" style="letter-spacing: 8px;">RESET</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ====== Akhir Main Konten ====== -->

<?= view('pages/templates/footer') ?>