<?= view('pages/templates/header') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-5 mb-3 animated slideInDown" style="letter-spacing: 2px;">Daftar Lapangan Futsal</h1>
        <p class="lead animated slideInDown mb-4">Dari harga murah hingga fasilitas yang lengkap, setiap lapangan futsal siap mendukung permainan terbaik sesuai dengan preferensi dan kebutuhan anda.</p>
        <nav aria-label="breadcrumb animated slideInDown ">
            <ol class="breadcrumb justify-content-center mb-0 wow fadeIn" data-wow-delay="0.1s">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Fusion</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('daftar-lapangan-futsal') ?>">Daftar Lapangan Futsal</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page"><?= esc($lapangan['nama']) ?></li>
            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->

<!-- ===== Detail Lapangan Start ===== -->
<div class="container py-5 detail-lapangan">

    <!-- Foto Besar + Foto Kecil -->
    <div class="row g-5 mb-5">
        <div class="col-lg-5 d-flex flex-column h-100 wow fadeInLeft" data-wow-delay="0.1s">
            <div class="position-relative flex-grow-1">
                <img id="mainPhoto" src="<?= base_url('uploads/' . ($foto[0]['file'])) ?>" alat="fotoUtama" class="img-fluid rounded shadow main-photo w-100 object-cover">
            </div>
            <div class="d-flex justify-content-between mt-3 gap-2 flex-wrap">
                <?php foreach ($foto as $f): ?>
                    <img src="<?= base_url('uploads/' . $f['file']) ?>" alt="Thumbnail"
                        class="img-fluid rounded shadow thumb-photo" style="width: 18%;">
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Informasi Detail Lapangan -->
        <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.1s">
            <div class="bg-light p-4 rounded shadow content-detail">
                <h1 class="text-primary mb-4"><?= esc($lapangan['nama']) ?></h1>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Harga</h6>
                    </div>
                    <div class="col-md-8">
                        <p><span class="harga-highlight">Rp. <?= number_format($lapangan['harga'], 0, ',', '.') ?> / Jam</span></p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Jenis Lantai</h6>
                    </div>
                    <div class="col-md-8">
                        <p><?= esc($lapangan['jenis_lantai']) ?></p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Nomor HP</h6>
                    </div>
                    <div class="col-md-8">
                        <p><?= esc($lapangan['no_hp']) ?></p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Alamat</h6>
                    </div>
                    <div class="col-md-8">
                        <p><?= esc($lapangan['alamat']) ?></p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Fasilitas</h6>
                    </div>
                    <div class="col-md-8">
                        <p><?= esc(implode(', ', array_column($fasilitas, 'nama'))) ?></p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <h6>Jam Operasional</h6>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($jamOperasional as $jam): ?>
                                <?php
                                $isTutup = $jam['status'] === 'Tutup' || $jam['jam_buka'] === null || $jam['jam_tutup'] === null;
                                $jamBuka = substr($jam['jam_buka'], 0, 5);
                                $jamTutup = substr($jam['jam_tutup'], 0, 5);
                                ?>
                                <li class="d-flex justify-content-between">
                                    <div class="col-4"><?= esc($jam['hari']) ?></div>
                                    <div class="col-8">
                                        <?= $isTutup ? 'Tutup' : esc("$jamBuka - $jamTutup") ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="text-center mt-4 mb-3">
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $lapangan['no_hp']) ?>"
                        target="_blank" class="btn btn-primary rounded-pill px-4 py-2 w-100" style="letter-spacing: 8px;">PESAN </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Peta Lokasi -->
    <div class="row g-5">
        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class=" bg-light p-4 rounded shadow">
                <h4 class="text-primary mb-3"><?= esc($lapangan['nama']) ?></h4>
                <div class="custom-map-container">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lat = <?= floatval($lapangan['latitude']) ?>;
        const lng = <?= floatval($lapangan['longitude']) ?>;

        const map = L.map('map').setView([lat, lng], 15);

        // Tambah tile dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Custom icon
        const iconLapangan = L.icon({
            iconUrl: "<?= base_url('assets/img/logo-baru.png') ?>",
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        // Marker dengan popup
        const popupContent = `
      <strong><?= esc($lapangan['nama']) ?></strong><br>
      <a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank">Lihat di Google Maps</a>`;

        L.marker([lat, lng], {
                icon: iconLapangan
            })
            .addTo(map)
            .bindPopup(popupContent)
            .openPopup(); // otomatis tampil
    });
</script>
<?= view('pages/templates/footer') ?>