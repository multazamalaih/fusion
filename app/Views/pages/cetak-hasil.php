<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Fusion - Futsal Recommendation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo-baru.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/img/logo-baru.png') ?>" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body onload="window.print();">

    <!-- Header -->
    <div class="print-header mt-5">
        <img src="<?= base_url('assets/img/logo-baru.png') ?>" alt="Fusion Logo">
        <p class="title-fusion">FUSION</p>
        <p class="subtitle-futsal">FUTSAL RECOMMENDATION</p>
    </div>

    <!-- Judul -->
    <div class="print-section">
        <h4>Hasil Rekomendasi Lapangan Futsal dengan Metode AHP-TOPSIS</h4>
        <!-- Tabel -->
        <table>
            <thead>
                <tr>
                    <th>Nama Lapangan Futsal</th>
                    <th>Nilai Preferensi</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= number_format($row['nilai'], 5, ',', '.') ?></td>
                        <td><?= $row['peringkat'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>