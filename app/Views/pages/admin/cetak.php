<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Fusion - Futsal Recommendation</title>
	<link rel="shortcut icon" href="<?= base_url('admin/img/favicon.png') ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('admin/img/favicon.png') ?>" type="image/x-icon">
	<style>
		body {
			font-family: 'Arial', sans-serif;
			margin: 20px;
			color: #333;
		}

		.header {
			text-align: center;
			margin-bottom: 20px;
		}

		.header img {
			height: 80px;
			margin-bottom: 10px;
		}

		.title-fusion {
			font-size: 28px;
			font-weight: bold;
			letter-spacing: 5px;
			margin: 0;
		}

		.subtitle-futsal {
			font-size: 16px;
			letter-spacing: 3px;
			margin-top: 5px;
		}

		h4 {
			margin-top: 30px;
			margin-bottom: 30px;
			text-align: center;
			font-size: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		th,
		td {
			border: 1px solid #999;
			padding: 10px 15px;
			text-align: center;
			font-size: 16px;
		}

		th {
			background-color: #f2f2f2;
		}

		tbody tr:nth-child(even) {
			background-color: #f9f9f9;
		}

		@media print {
			body {
				margin: 0;
			}
		}
	</style>
</head>

<body onload="window.print();">

	<!-- Logo dan Judul Fusion -->
	<div class="header">
		<img src="<?= base_url('admin/img/logo.png') ?>" alt="Fusion Logo">
		<p class="title-fusion">FUSION</p>
		<p class="subtitle-futsal">FUTSAL RECOMMENDATION</p>
	</div>

	<!-- Judul Cetak -->
	<h4>Rekomendasi Lapangan Futsal Menggunakan Metode AHP-TOPSIS</h4>

	<!-- Tabel Data -->
	<table>
		<thead>
			<tr>
				<th>Nama Lapangan Futsal</th>
				<th>Nilai</th>
				<th>Rank</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Noel Futsal</td>
				<td>Contoh Nilai</td>
				<td>Contoh Rank</td>
			</tr>
		</tbody>
	</table>

</body>

</html>