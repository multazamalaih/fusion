<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Fusion - Futsal Recommendation</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url('img/logo-baru.png') ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('img/logo-baru.png') ?>" type="image/x-icon">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="lib/animate/animate.min.css" rel="stylesheet">
	<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="<?= base_url('assets-admin/css/sb-admin-2.css') ?>" rel="stylesheet">
</head>

<body onload="window.print();">

	<!-- Header -->
	<div class="print-header mt-5">
		<img src="<?= base_url('/assets-admin/img/logo.png') ?>" alt="Fusion Logo">
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
				<?php $rank = 1;
				foreach ($hasil as $row): ?>
					<tr>
						<td><?= esc($namaLapanganMap[$row['id_lapangan']] ?? '-') ?></td>
						<td><?= number_format($row['nilai'], 5, ',', '.') ?></td>
						<td><?= $rank++ ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>

</html>