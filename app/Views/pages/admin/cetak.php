<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Fusion - Futsal Recommendation</title>
	<link rel="shortcut icon" href="<?= base_url('admin/img/favicon.png') ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('admin/img/favicon.png') ?>" type="image/x-icon">
	<style>
		body {
			font-family: 'Alata', Tahoma, Geneva, Verdana, sans-serif;
			margin: 40px;
			color: #222;
			background-color: #fff;
		}

		.header {
			text-align: center;
			margin-bottom: 30px;
		}

		.header img {
			height: 90px;
			margin-bottom: 10px;
		}

		.title-fusion {
			font-size: 32px;
			font-weight: bold;
			letter-spacing: 6px;
			margin: 0;
			color: #2c3e50;
		}

		.subtitle-futsal {
			font-size: 16px;
			letter-spacing: 3px;
			margin-top: 5px;
			color: #7f8c8d;
		}

		h4 {
			margin-top: 40px;
			margin-bottom: 25px;
			text-align: center;
			font-size: 22px;
			font-weight: normal;
			color: #34495e;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 10px;
			font-size: 16px;
		}

		th,
		td {
			border: 1px solid #ccc;
			padding: 12px 16px;
			text-align: center;
		}

		th {
			background-color: #1cc88a;
			/* fallback yang aman untuk print */
			color: #000;
			font-weight: bold;
			border: 1px solid #999;
		}

		tbody tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		tbody tr:hover {
			background-color: #e1f5f2;
		}

		@media print {
			th {
				background-color: #eaeaea !important;
				color: #000 !important;
			}
		}
	</style>
</head>

<body onload="window.print();">

	<!-- Header -->
	<div class="header">
		<img src="<?= base_url('admin/img/logo.png') ?>" alt="Fusion Logo">
		<p class="title-fusion">FUSION</p>
		<p class="subtitle-futsal">FUTSAL RECOMMENDATION</p>
	</div>

	<!-- Judul -->
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

</body>

</html>