<?= view('pages/templates/header') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Tentang Kami</h1>
        <p class="lead animated slideInDown mb-4"> Halaman yang berisi informasi tentang tujuan, latar belakang, dan cara kerja sistem. Serta bagaimana pengguna dapat memanfaatkannya.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container py-5 mb-5">
    <!-- Baris 1: Gambar kiri, Teks kanan -->
    <div class="row align-items-center mb-5 wow fadeInRight" data-wow-delay="0.1s">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <img src="<?= base_url('assets/img/tentangkami3.jpg') ?>" alt="Lapangan Futsal" class="img-fluid rounded shadow" style="width: 100%; height: 100%; max-height: 350px; object-fit: cover;">
        </div>
        <div class="col-lg-7">
            <h2 class="mb-3" style="font-family: 'Alata', sans-serif;">Fusion (Futsal Recommendation)</h2>
            <p style="text-align: justify;">
                Fusion adalah sistem rekomendasi lapangan futsal yang memanfaatkan pendekatan objektif berbasis data. Dirancang untuk membantu pemain atau tim memilih lapangan terbaik sesuai kebutuhan. Fusion memperhitungkan faktor seperti harga, kualitas lapangan, fasilitas, dan faktor lainnya.
            </p>
            <p style="text-align: justify;">
                Dengan tampilan yang sederhana dan fokus pada pengalaman pengguna, Fusion menyederhanakan proses pencarian lapangan, menghemat waktu, dan memberikan hasil yang relevan. Website ini cocok untuk agenda main bareng rutin, latihan tim, hingga turnamen komunitas.
            </p>
            <p>Kami berharap Fusion dapat membantu komunitas futsal dalam memilih lapangan terbaik dan memberikan pengalaman bermain yang lebih nyaman dan menyenangkan. Dengan sistem ini, pengguna tidak hanya menghemat waktu dalam mencari lapangan, tetapi juga mendapatkan informasi yang akurat dan terpercaya.</p>
        </div>
    </div>

    <!-- Baris 2: Teks kiri, Gambar kanan -->
    <div class="row align-items-center mb-5 wow fadeInLeft" data-wow-delay="0.1s">
        <div class="col-lg-7">
            <h2 class="mb-3" style="font-family: 'Alata', sans-serif;">Metode AHP & TOPSIS</h2>
            <p style="text-align: justify;">
                Fusion memberikan rekomendasi berdasarkan metode <strong>Analytical Hierarchy Process (AHP)</strong> untuk menentukan bobot penting setiap kriteria seperti harga, fasilitas, kualitas lapangan, kebersihan, dan sebagainya.
            </p>
            <p style="text-align: justify;">
                Setelah bobot didapatkan, sistem menggunakan <strong>Technique for Order Preference by Similarity to Ideal Solution (TOPSIS)</strong> untuk mengurutkan lapangan berdasarkan kedekatan pada solusi terbaik. Metode ini memberikan rekomendasi yang logis, terukur, dan transparan.
            </p>
            <p style="text-align: justify;">
                Semua data dikumpulkan dari lapangan terverifikasi, kemudian disajikan dengan cara yang mudah dipahami tanpa perlu memahami teori di baliknya.
            </p>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <img src="<?= base_url('assets/img/tentangkami.jpg') ?>" alt="AHP TOPSIS" class="img-fluid rounded shadow" style="width: 100%; height: 100%; max-height: 350px; object-fit: cover;">
        </div>
    </div>

    <!-- Baris 3: Tombol tengah -->
    <div class="row">
        <div class="col-12 mt-3 d-flex justify-content-center gap-3 flex-wrap wow fadeInUp" data-wow-delay="0.3s">
            <a href="<?= base_url('hasil-rekomendasi') ?>" class="btn btn-primary rounded-pill py-3 px-5">Lihat Rekomendasi</a>
            <a href="<?= base_url('cari-lapangan') ?>" class="btn btn-secondary rounded-pill py-3 px-5">Cari Sesuai Kebutuhanmu</a>
        </div>
    </div>
</div>

<?= view('pages/templates/footer') ?>