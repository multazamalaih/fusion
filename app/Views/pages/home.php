<?= view('pages/templates/header'); ?>

<!-- Banner Start -->
<div class="banner-section mb-5">
    <img src="<?= base_url('assets/img/banner.jpg') ?>" alt="Banner Futsal">
    <div class="overlay-dark">
        <div class="banner-content">
            <div class="container">
                <h1 class="display-5 text-white fw-bold mb-4 wow fadeInDown" data-wow-delay="0.3s">
                    Rekomendasi Lapangan Futsal Terbaik Hanya untuk Kamu!
                </h1>
                <p class="text-white fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">
                    Dari harga murah hingga fasilitas lengkap, semua ada di sini. Pilih sekarang!
                </p>
                <div class="banner-buttons d-flex justify-content-center gap-3 flex-wrap wow fadeInUp" data-wow-delay="0.7s">
                    <a href="<?= base_url('hasil-rekomendasi') ?>" class="btn btn-primary rounded-pill py-3 px-5">Lihat Rekomendasi</a>
                    <a href="<?= base_url('cari-lapangan') ?>" class="btn btn-secondary rounded-pill py-3 px-5">Cari Sesuai Kebutuhanmu</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Feature Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3 text-nowrap">Kriteria Terbaik</h1>
            <p>Kami Mengutamakan Kriteria dengan Bobot Prioritas Tinggi!</p>
        </div>
        <div class="row g-4">
            <?php foreach ($kriteriaTerbaik as $judul => $item): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?= $judul + 1 ?>s">
                    <div class="bg-light text-center shadow h-100 p-4 p-xl-5 d-flex flex-column justify-content-between">
                        <h4 class="mb-3"><?= esc($item['nama']) ?></h4>
                        <p class="mb-4">"<?= esc($item['slogan']) ?>"</p>
                        <div class="text-center mt-3">
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill"
                                href="<?= base_url('daftar-kriteria#detail' . $item['id_kriteria']) ?>">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Feature End -->

<!-- Daftar Lapangan Start -->
<div class="container-fluid bg-icon my-5 py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="display-5 mb-3">Daftar Lapangan Futsal</h1>
            <p>Main Futsal Lebih Mudah, Pilih Lapangan Favoritmu!</p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-md-7 wow fadeInLeft" data-wow-delay="0.3s">
                <div class="rounded-3 shadow">
                    <div id="map-home" style="width: 100%; height: 350px;"></div>
                </div>
            </div>
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center wow fadeInRight" data-wow-delay="0.5s">
                <h4 class="mb-4 text-center">Daftar terlengkap lapangan futsal</h4>
                <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="<?= base_url('daftar-lapangan-futsal') ?>">Lihat Daftar Lapangan</a>
            </div>
        </div>
    </div>
</div>
<!-- Daftar Lapangan End -->

<!-- Lapangan Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 mb-3 text-nowrap">Lapangan Futsal Pilihan</h1>
            <p>Rekomendasi Lapangan Futsal dengan Kualitas Terbaik!</p>
        </div>
        <div class="row g-4">
            <?php foreach ($lapanganTerbaik as $i => $lap): ?>
                <div class="col-12 col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.<?= $i + 1 ?>s">
                    <div class="lapangan-item">
                        <div class="position-relative bg-light overflow-hidden">
                            <img class="img-fluid w-100" src="<?= base_url('uploads/' . ($lap['foto'] ?? 'default.png')) ?>" alt="">
                        </div>
                        <div class="text-center p-4">
                            <a class="d-block h5 mb-2" href="<?= base_url('daftar-lapangan-futsal/detail/' . $lap['id_lapangan']) ?>">
                                <?= esc($lap['nama']) ?>
                            </a>
                            <span class="text-primary fw-bold">Rp <?= number_format($lap['harga'], 0, ',', '.') ?></span>
                        </div>
                        <div class="d-flex border-top">
                            <small class="w-50 text-center border-end py-2">
                                <a class="text-body" href="<?= base_url('daftar-lapangan-futsal/detail/' . $lap['id_lapangan']) ?>">
                                    <i class="fa fa-eye text-primary me-2"></i>Lihat Detail
                                </a>
                            </small>
                            <small class="w-50 text-center py-2">
                                <a class="text-body" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $lap['no_hp']) ?>" target="_blank">
                                    <i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Lapangan End -->

<!-- Firm Visit Start -->
<div class="container-fluid bg-icon-hijau visit py-6 mt-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 text-white mb-3 text-nowrap">Kirimkan Rekomendasi Anda</h1>
                <p class="text-white mb-0">
                    Rekomendasi Anda, Langkah Awal untuk Meningkatkan Layanan Kami!<br>
                    Rekomendasikan Lapangan atau Kriteria yang Anda Inginkan Sekarang!
                </p>
            </div>
            <div class="col-md-5 text-md-end wow fadeIn" data-wow-delay="0.5s">
                <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="<?= base_url('rekomendasikan') ?>">Rekomendasikan</a>
            </div>
        </div>
    </div>
</div>
<!-- Firm Visit End -->

<!-- Ulasan Start -->
<div class="container-fluid bg-icon testimonial py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Ulasan Manajemen</h1>
            <p>Berikut Ulasan Manajemen tentang Rekomendasi Lapangan Futsal</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($ulasan as $ulas): ?>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4 text-center"><?= esc($ulas['ulasan']) ?></p>
                    <hr class="my-4">
                    <div class="text-center">
                        <h5 class="mb-1"><?= esc($ulas['nama_manajemen']) ?></h5>
                        <span><?= esc($ulas['nama']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Ulasan End -->

<!-- Maps Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const map = L.map('map-home').setView([-6.3, 106.7], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        const iconLapangan = L.icon({
            iconUrl: "<?= base_url('assets/img/logo-baru.png') ?>",
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            popupAnchor: [0, -36]
        });

        const group = L.featureGroup();

        <?php foreach ($lapanganList as $lap): ?>
            var marker = L.marker([<?= $lap['latitude'] ?>, <?= $lap['longitude'] ?>], {
                    icon: iconLapangan
                })
                .bindPopup(`
                    <strong><?= esc($lap['nama']) ?></strong><br>
                    <a href="<?= base_url('daftar-lapangan-futsal/detail/' . $lap['id_lapangan']) ?>" class="text-primary">Lihat Detail</a>
                `);
            marker.addTo(map);
            group.addLayer(marker);
        <?php endforeach; ?>

        if (group.getLayers().length > 0) {
            map.fitBounds(group.getBounds());
        }
    });
</script>

<?= view('pages/templates/footer'); ?>