<?= view('pages/templates/header') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing:2px;">Hasil Rekomendasi</h1>
        <p class="lead animated slideInDown mb-4">Hasil perhitungan metode AHP-TOPSIS dengan menganalisis berbagai alternatif lapangan futsal berdasarkan bobot kriteria yang ditentukan. Berikut adalah hasil perangkingan yang dapat menjadi referensi dalam memilih lapangan terbaik.</p>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Hasil Rekomendasi</li>
            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->

<!-- Kartu Rekomendasi Terbaik -->
<div class="container py-6">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-lg-3 mb-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="lapangan-item">
                <div class="position-relative bg-light overflow-hidden">
                    <!-- Gambar Utama -->
                    <img class="img-fluid w-100" src="<?= base_url('uploads/' . $lapangan['file']) ?>" alt="Gambar Lapangan">
                </div>
                <div class="text-center p-4">
                    <a class="d-block h5 mb-2" href=""><?= $data[0]['nama'] ?></a>
                    <span class="text-primary fw-bold">Rp <?= number_format($data[0]['harga'], 0, ',', '.') ?></span>
                </div>
                <div class="d-flex border-top">
                    <small class="w-50 text-center border-end py-2">
                        <a class="text-body" href="<?= base_url('detail-lapangan/' . $data[0]['id_lapangan']) ?>"> </small>
                    <small class="w-50 text-center py-2">
                        <a class="text-body" target="_blank" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $data[0]['no_hp']) ?>">
                            <i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Judul Pembobotan Start -->
<div class="container-fluid bg-primary mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center py-2">
                <h3 class="text-white position-relative d-inline-block px-3" style="letter-spacing: 2px;">Hasil Pembobotan Kriteria</h3>
            </div>
        </div>
    </div>
</div>
<!-- Judul Pembobotan End -->


<!-- Tabel Bobot Kriteria -->
<div class="container mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="scroll-hasil-wrapper">
        <table class="table table-bordered scroll-hasil-table text-center align-middle">
            <thead class="table-costum text-center">
                <tr>
                    <th style="letter-spacing: 2px;">Nama Kriteria</th>
                    <th style="letter-spacing: 2px;">Tipe</th>
                    <th style="letter-spacing: 2px;">Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataKriteria as $kriteria) : ?>
                    <tr class="text-center">
                        <td><?= $kriteria['nama'] ?></td>
                        <td><?= $kriteria['tipe'] ?></td>
                        <td><?= $kriteria['bobot'] ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <p class="text-muted fst-italic small mt-2 text-left d-block d-md-none">
        <i class="bi bi-arrow-left-right me-1"></i>Geser untuk melihat data yang lebih lengkap.
    </p>
</div>
<!-- Judul Pembobotan Start -->
<div class="container-fluid bg-primary mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center py-2">
                <h3 class="text-white position-relative d-inline-block px-3" style="letter-spacing: 2px;">Hasil Penilaian Lapangan</h3>
            </div>
        </div>
    </div>
</div>
<!-- Judul Pembobotan End -->

<!-- Tabel Perangkingan -->
<div class="container mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="scroll-hasil-wrapper">
        <table class="table table-bordered scroll-hasil-table text-center align-middle">
            <thead class="table-costum text-center">
                <tr>
                    <th style="letter-spacing: 2px;">Peringkat</th>
                    <th style="letter-spacing: 2px;">Nama Lapangan</th>
                    <th style="letter-spacing: 2px;">Nilai</th>
                    <th style="letter-spacing: 2px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php $i = 1; ?>
                <?php foreach ($data as $hasil) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $hasil['nama'] ?></td>
                        <td><?= $hasil['nilai'] ?></td>
                        <td><a href="<?= base_url('daftar-lapangan-futsal/detail/' . $hasil['id_lapangan']) ?>" class="btn btn-sm btn-secondary rounded-pill px-3">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="text-muted fst-italic small mt-2 text-left d-block d-md-none">
        <i class="bi bi-arrow-left-right me-1"></i>Geser untuk melihat data yang lebih lengkap.
    </p>
</div>

<!-- Tombol Cetak -->
<div class="container text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
    <a href="<?= base_url('cetak-hasil-rekomendasi') ?>" target="_blank" class="btn btn-primary rounded-pill py-3 px-5" style="letter-spacing: 8px;">
        <i class="fa fa-print me-2"></i>CETAK DATA
    </a>
</div>

<?= view('pages/templates/footer') ?>