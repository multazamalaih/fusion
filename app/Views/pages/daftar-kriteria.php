<?= view('pages/templates/header') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Daftar Kriteria</h1>
        <p class="lead animated slideInDown mb-4">Setiap kriteria dirancang untuk membantu anda menemukan lapangan yang sesuai dengan kebutuhan dan preferensi anda.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Daftar Kriteria</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Detail Kriteria Start -->
<div class="container-fluid detail-kriteria mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <!-- Nav Tab Kiri -->
            <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.2s">
                <ul class="nav nav-tabs shadow rounded p-3 flex-column" role="tablist">
                    <?php $i = 0;
                    foreach ($kriteria as $item): ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?= ($i === 0) ? 'active' : '' ?>"
                                data-bs-toggle="tab"
                                href="#detail<?= $item['id_kriteria'] ?>" role="tab">
                                <?= esc($item['nama']) ?>
                            </a>
                        </li>
                    <?php $i++;
                    endforeach; ?>
                </ul>
            </div>

            <!-- Isi Content Kanan -->
            <div class="col-lg-9 mt-4 mt-lg-0 wow fadeInRight" data-wow-delay="0.2s">
                <div class="tab-content shadow rounded p-4 bg-white">
                    <?php $i = 0;
                    foreach ($kriteria as $item): ?>
                        <div class="tab-pane fade <?= ($i === 0) ? 'show active' : '' ?>"
                            id="detail<?= $item['id_kriteria'] ?>" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3><?= esc($item['nama']) ?></h3>
                                    <p class="fst-italic"><?= esc($item['slogan']) ?></p>
                                    <p><?= esc($item['keterangan']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php $i++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('pages/templates/footer') ?>