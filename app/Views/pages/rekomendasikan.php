<?= view('pages/templates/header') ?>

<?php if (session()->get('successRekomendasi')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="toastSuccess" class="toast wow fadeInRight align-items-center text-white bg-primary border-0 show" style="font-family:'Alata',sans-serif;"
            role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" data-wow-delay="0.1s">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->get('successRekomendasi') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>


<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Rekomendasikan</h1>
        <p class="lead animated slideInDown mb-4">Ajukan rekomendasi untuk lapangan atau kriteria baru agar kami dapat memberikan yang terbaik.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Rekomendasikan</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- ====== Main Konten Rekomendasikan ====== -->
<div class="container-fluid py-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="bg-white p-5 rounded shadow content-rekomendasi">
                <form method="post" action="/rekomendasikan">
                    <div class="mb-4">
                        <label for="jenis" class="form-label">Jenis Rekomendasi</label>
                        <select class="form-select rounded-pill <?= validation_show_error('jenis_rekomendasi') ? 'is-invalid' : '' ?>" name="jenis_rekomendasi" id="jenis" required>
                            <option value="" disabled selected hidden>-- Pilih --</option>
                            <option value="lapangan" <?= old('jenis_rekomendasi') === 'lapangan' ? 'selected' : '' ?>>Lapangan</option>
                            <option value="kriteria" <?= old('jenis_rekomendasi') === 'kriteria' ? 'selected' : '' ?>>Kriteria</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('jenis_rekomendasi')  ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Rekomendasi</label>
                        <input type="text" class="form-control rounded-pill <?= validation_show_error('nama_rekomendasi') ? 'is-invalid' : '' ?>" name="nama_rekomendasi" id="nama" value="<?= old('nama_rekomendasi') ?>" required>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_rekomendasi')  ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control <?= validation_show_error('keterangan') ? 'is-invalid' : '' ?>" id="keterangan" rows="4" name="keterangan" style="border-radius: 12px;" required><?= old('keterangan') ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('keterangan')  ?>
                        </div>
                    </div>

                    <div class="text-center">
                        <?php if (checkLogin()) : ?>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 w-100" style="letter-spacing: 8px;">K I R I M</button>
                        <?php else : ?>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalLogin" class="btn btn-primary rounded-pill px-5 py-2 w-100" style="letter-spacing: 8px;">K I R I M</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family:Alata, sans-serif;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLoginLabel">Masuk Akun ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silahkan Masuk Akun terlebih dahulu sebelum mengirim rekomendasi
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white rounded-pill py-2 px-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary rounded-pill py-2 px-3"><a href="/login" class="text-white">Masuk</a></button>
            </div>
        </div>
    </div>
</div>

<!-- ====== Akhir Main Konten ====== -->

<?= view('pages/templates/footer') ?>