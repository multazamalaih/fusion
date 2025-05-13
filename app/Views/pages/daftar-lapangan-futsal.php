<?= view('pages/templates/header') ?>

<?php if (session()->get('errorDetail')): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="toastSuccess" class="toast wow fadeInRight align-items-center text-white bg-secondary border-0 show" style="font-family:'Alata',sans-serif;"
            role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" data-wow-delay="0.1s">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->get('errorDetail') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing:2px;">Daftar Lapangan Futsal</h1>
        <p class="lead animated slideInDown mb-4">Dari harga murah hingga fasilitas yang lengkap, setiap lapangan futsal siap mendukung permainan terbaik sesuai dengan preferensi dan kebutuhan anda.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Daftar Lapangan Futsal</li>
            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->

<!-- Search and Filter Start -->
<div class="container-fluid bg-primary py-4 mb-5 cari-filter wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <form method="get">
            <div class="row g-3 align-items-center justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="cari" class="form-control rounded-pill" style="font-family:'Alata', sans-serif"
                        placeholder="Cari Lapangan..." value="<?= esc($cari) ?>">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-secondary rounded-pill px-4 py-2 w-100 w-md-auto">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Search and Filter End -->
<!-- Informasi Jumlah Lapangan Start -->
<div class="container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center flex-md-row flex-column text-center wow fadeIn" data-wow-delay="0.1">
            <h5 class="mb-2 mb-md-0 wow fadeInLeft" data-wow-delay="0.1s">
                Menampilkan <?= $start ?>–<?= $end ?> dari <?= $total ?> data
            </h5>
            <form method="get" class="d-flex align-items-center justify-content-center wow fadeInRight" data-wow-delay="0.1s">
                <h5 class="mb-0 me-2">Urutkan berdasarkan:</h5>
                <select class="form-select rounded-pill small-select mt-2 mt-md-0 me-2" name="urutan" onchange="this.form.submit()">
                    <option value="nilai tertinggi" <?= $urutan === 'nilai tertinggi' ? 'selected' : '' ?>>Nilai Tertinggi</option>
                    <option value="nilai terendah" <?= $urutan === 'nilai terendah' ? 'selected' : '' ?>>Nilai Terendah</option>
                    <option value="harga termurah" <?= $urutan === 'harga termurah' ? 'selected' : '' ?>>Termurah</option>
                    <option value="harga termahal" <?= $urutan === 'harga termahal' ? 'selected' : '' ?>>Termahal</option>
                </select>
                <?php if ($cari): ?>
                    <input type="hidden" name="cari" value="<?= esc($cari) ?>">
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<!-- Informasi Jumlah Lapangan End -->
<!-- lapangan Start -->
<div class="container-xxl py-5 ">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($lapangan as $item): ?>
                <div class="col-12 col-sm-6 col-lg-3 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="lapangan-item">
                        <div class="position-relative bg-light overflow-hidden">
                            <?php
                            $gambar = !empty($item['foto']) ? 'uploads/' . $item['foto'] : 'img/foto-contoh.png';
                            ?>
                            <img class="img-fluid w-100" src="<?= base_url($gambar) ?>" alt="<?= esc($item['nama']) ?>">
                        </div>
                        <div class="text-center p-4">
                            <a class="d-block h5 mb-2" href="<?= site_url('daftar-lapangan-futsal/detail/' . $item['id_lapangan']) ?>">
                                <?= esc($item['nama']) ?>
                            </a>
                            <span class="text-primary fw-bold">
                                Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                            </span>
                        </div>
                        <div class="d-flex border-top">
                            <small class="w-50 text-center border-end py-2">
                                <a class="text-body" href="<?= site_url('daftar-lapangan-futsal/detail/' . $item['id_lapangan']) ?>">
                                    <i class="fa fa-eye text-primary me-2"></i>Lihat Detail
                                </a>
                            </small>
                            <small class="w-50 text-center py-2">
                                <a class="text-body" href="https://wa.me/<?= $item['no_hp'] ?>" target="_blank">
                                    <i class="fab fa-whatsapp text-primary me-2 fa-lg "></i>Pesan
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- lapangan End -->
<!-- Pagination -->
<div class="container mt-4 mb-5 wow fadeInUp" data-wow-delay="0.5s">
    <div class="row">
        <div class="col-12 text-center">
            <nav>
                <ul class="pagination justify-content-center custom-pagination">
                    <?= $pager->links('lapangan', 'custom') ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Pagination End -->


<?= view('pages/templates/footer') ?>