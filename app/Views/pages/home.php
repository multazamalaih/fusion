<?= view('pages/templates/header'); ?>
<!-- Banner Start -->
<div class="banner-section mb-5">
    <img src="<?= base_url('/assets/img/banner.jpg') ?>" alt="Banner Futsal">
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
                    <a href="/hasil-rekomendasi" class="btn btn-primary rounded-pill py-3 px-5">Lihat Rekomendasi</a>
                    <a href="/cari-lapangan" class="btn btn-secondary rounded-pill py-3 px-5">Cari Sesuai Kebutuhanmu</a>
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
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light text-center shadow h-100 p-4 p-xl-5 d-flex flex-column justify-content-between">
                    <h4 class=" mb-3">Harga Sewa</h4>
                    <p class="mb-4 ">"Semakin murah harga sewa, semakin baik penilaian lapangan di mata pengguna."</p>
                    <div class="text-center mt-3">
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="daftar-kriteria.php">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light text-center shadow h-100 p-4 p-xl-5 d-flex flex-column justify-content-between">
                    <h4 class="mb-3">Kebersihan dan Perawatan</h4>
                    <p class="mb-4">"Semakin bersih dan terawat, semakin baik penilaian lapangan di mata pengguna."</p>
                    <div class="text-center mt-3">
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="daftar-kriteria.php">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light text-center shadow h-100 p-4 p-xl-5 d-flex flex-column justify-content-between">
                    <h4 class="mb-3">Kualitas Lapangan</h4>
                    <p class="mb-4">"Semakin bagus kualitas lapangan, semakin baik penilaian lapangan di mata pengguna."</p>
                    <div class="text-center mt-3">
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="daftar-kriteria.php">Read More</a>
                    </div>
                </div>
            </div>
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
                <div class="ratio ratio-16x9 rounded-3 shadow">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center wow fadeInRight" data-wow-delay="0.5s">
                <h4 class="mb-4 text-center">Daftar terlengkap lapangan futsal</h4>
                <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="daftar-lapangan-futsal.php">Lihat Daftar Lapangan</a>
            </div>
        </div>
    </div>
</div>
<!-- Daftar Lapangan End -->
<!-- lapangan Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 mb-3 text-nowrap">Lapangan Futsal Pilihan</h1>
            <p>Rekomendasi Lapangan Futsal dengan Kualitas Terbaik!</p>
        </div>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="lapangan-item">
                    <div class="position-relative bg-light overflow-hidden">
                        <img class="img-fluid w-100" src="img/foto-contoh.png" alt="">
                    </div>
                    <div class="text-center p-4">
                        <a class="d-block h5 mb-2" href="">Noel Futsal</a>
                        <span class="text-primary fw-bold">Rp 100.000</span>
                    </div>
                    <div class="d-flex border-top">
                        <small class="w-50 text-center border-end py-2">
                            <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Lihat Detail</a>
                        </small>
                        <small class="w-50 text-center py-2">
                            <a class="text-body" href=""><i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan</a>
                        </small>
                    </div>
                </div>
            </div>
            <!-- Card 2-4 tinggal duplikat dan ubah gambar/tulisan -->
            <div class="col-12 col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="lapangan-item">
                    <div class="position-relative bg-light overflow-hidden">
                        <img class="img-fluid w-100" src="img/foto-contoh.png" alt="">
                    </div>
                    <div class="text-center p-4">
                        <a class="d-block h5 mb-2" href="">Noel Futsal</a>
                        <span class="text-primary fw-bold">Rp 100.000</span>
                    </div>
                    <div class="d-flex border-top">
                        <small class="w-50 text-center border-end py-2">
                            <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Lihat Detail</a>
                        </small>
                        <small class="w-50 text-center py-2">
                            <a class="text-body" href=""><i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="lapangan-item">
                    <div class="position-relative bg-light overflow-hidden">
                        <img class="img-fluid w-100" src="img/foto-contoh.png" alt="">
                    </div>
                    <div class="text-center p-4">
                        <a class="d-block h5 mb-2" href="">Noel Futsal</a>
                        <span class="text-primary fw-bold">Rp 100.000</span>
                    </div>
                    <div class="d-flex border-top">
                        <small class="w-50 text-center border-end py-2">
                            <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Lihat Detail</a>
                        </small>
                        <small class="w-50 text-center py-2">
                            <a class="text-body" href=""><i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="lapangan-item">
                    <div class="position-relative bg-light overflow-hidden">
                        <img class="img-fluid w-100" src="img/foto-contoh.png" alt="">
                    </div>
                    <div class="text-center p-4">
                        <a class="d-block h5 mb-2" href="">Noel Futsal</a>
                        <span class="text-primary fw-bold">Rp 100.000</span>
                    </div>
                    <div class="d-flex border-top">
                        <small class="w-50 text-center border-end py-2">
                            <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Lihat Detail</a>
                        </small>
                        <small class="w-50 text-center py-2">
                            <a class="text-body" href=""><i class="fab fa-whatsapp text-primary me-2 fa-lg"></i>Pesan</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- lapangan End -->
<!-- Firm Visit Start -->
<div class="container-fluid bg-icon-hijau visit py-6 mt-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 text-white mb-3 text-nowrap">Kirimkan Rekomendasi Anda</h1>
                <p class="text-white mb-0">Rekomendasi Anda, Langkah Awal untuk Meningkatkan Layanan Kami!
                    <br>Rekomendasikan Lapangan atau Kriteria yang Anda Inginkan Sekarang!
                </p>
            </div>
            <div class="col-md-5 text-md-end wow fadeIn" data-wow-delay="0.5s">
                <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="">Rekomendasikan</a>
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
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4 text-center">Kami berharap website ini terus memberikan kenyamanan bagi pengguna dan menjadi platform terpercaya untuk mencari lapangan futsal terbaik.</p>
                <hr class="my-4">
                <div class="text-center">
                    <h5 class="mb-1">Nama Manajemen</h5>
                    <span>Nama Lapangan Futsal</span>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4 text-center">Kami berharap website ini terus memberikan kenyamanan bagi pengguna dan menjadi platform terpercaya untuk mencari lapangan futsal terbaik.</p>
                <hr class="my-4">
                <div class="text-center">
                    <h5 class="mb-1">Nama Manajemen</h5>
                    <span>Nama Lapangan Futsal</span>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4 text-center">Kami berharap website ini terus memberikan kenyamanan bagi pengguna dan menjadi platform terpercaya untuk mencari lapangan futsal terbaik.</p>
                <hr class="my-4">
                <div class="text-center">
                    <h5 class="mb-1">Nama Manajemen</h5>
                    <span>Nama Lapangan Futsal</span>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4 text-center">Kami berharap website ini terus memberikan kenyamanan bagi pengguna dan menjadi platform terpercaya untuk mencari lapangan futsal terbaik.</p>
                <hr class="my-4">
                <div class="text-center">
                    <h5 class="mb-1">Nama Manajemen</h5>
                    <span>Nama Lapangan Futsal</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ulasan End -->
<?= view('pages/templates/footer'); ?>