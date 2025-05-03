<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan TOPSIS</h1>
</div>
<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('success') ?>
	</div>
<?php endif; ?>
<?php if (session()->getFlashdata('errorpenilaian')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('errorpenilaian') ?>
	</div>
<?php endif; ?>

<!-- Matriks Keputusan (X) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>No</th>
						<th>Nama Lapangan Futsal</th>
						<?php foreach ($kriteriaList as $kriteria): ?>
							<th><?= esc($kriteria['kode_kriteria']) ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($lapanganList as $lapangan): ?>
						<tr align="center">
							<td><?= $no++ ?></td> <!-- Nomor urut dimulai dari 1 -->
							<td align="center"><?= esc($lapangan['nama']) ?></td>
							<?php foreach ($kriteriaList as $kriteria): ?>
								<td><?= esc($matriksX[$lapangan['id_lapangan']][$kriteria['id_kriteria']]) ?></td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Bobot Preferensi (W) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Bobot Preferensi (W)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<?php foreach ($kriteriaList as $kriteria): ?>
							<th><?= esc($kriteria['kode_kriteria']) ?> (<?= esc($kriteria['tipe']) ?>)</th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriteriaList as $kriteria): ?>
							<td><?= esc($kriteria['bobot']) ?></td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Matriks Normalisasi (R) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matriks Normalisasi (R)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>No</th>
						<th>Nama Lapangan Futsal</th>
						<?php foreach ($kriteriaList as $kriteria): ?>
							<th><?= esc($kriteria['kode_kriteria']) ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($lapanganList as $lapangan): ?>
						<tr align="center">
							<td><?= $no++ ?></td>
							<td align="center"><?= esc($lapangan['nama']) ?></td>
							<?php foreach ($kriteriaList as $kriteria): ?>
								<td><?= esc($matriksR[$lapangan['id_lapangan']][$kriteria['id_kriteria']]) ?></td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Matriks Y -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matriks Normalisasi Terbobot (Y)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>No</th>
						<th>Nama Lapangan Futsal</th>
						<?php foreach ($kriteriaList as $kriteria): ?>
							<th><?= esc($kriteria['kode_kriteria']) ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($lapanganList as $lapangan): ?>
						<tr align="center">
							<td><?= $no++ ?></td>
							<td align="center"><?= esc($lapangan['nama']) ?></td>
							<?php foreach ($kriteriaList as $kriteria): ?>
								<td><?= esc($matriksY[$lapangan['id_lapangan']][$kriteria['id_kriteria']]) ?></td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Solusi Ideal Positif (A+) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Solusi Ideal Positif (A<sup>+</sup>)</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered text-center">
			<thead class="bg-success text-white">
				<tr>
					<?php foreach ($kriteriaList as $k): ?>
						<th><?= esc($k['kode_kriteria']) ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ($kriteriaList as $k): ?>
						<td><?= esc($solusiIdealPositif[$k['id_kriteria']]) ?></td>
					<?php endforeach ?>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<!-- Solusi Ideal Negatif (A-) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Solusi Ideal Negatif (A<sup>-</sup>)</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered text-center">
			<thead class="bg-success text-white">
				<tr>
					<?php foreach ($kriteriaList as $k): ?>
						<th><?= esc($k['kode_kriteria']) ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach ($kriteriaList as $k): ?>
						<td><?= esc($solusiIdealNegatif[$k['id_kriteria']]) ?></td>
					<?php endforeach ?>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- Jarak Ideal Positif (D+) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Jarak ke Solusi Ideal Positif (D<sup>+</sup>)</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered text-center">
			<thead class="bg-success text-white">
				<tr>
					<th>No</th>
					<th>Nama Lapangan Futsal</th>
					<th>Jarak Ideal Positif</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($lapanganList as $l): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td align="center"><?= esc($l['nama']) ?></td>
						<td><?= $jarakIdealPositif[$l['id_lapangan']] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Jarak Ideal Negatif (D-) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Jarak ke Solusi Ideal Negatif (D<sup>-</sup>)</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered text-center">
			<thead class="bg-success text-white">
				<tr>
					<th>No</th>
					<th>Nama Lapangan Futsal</th>
					<th>Jarak Ideal Negatif</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($lapanganList as $l): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td align="center"><?= esc($l['nama']) ?></td>
						<td><?= $jarakIdealNegatif[$l['id_lapangan']] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<!-- Nilai Preferensi (V) -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Kedekatan Relatif Terhadap Solusi Ideal (V)</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered text-center">
			<thead class="bg-success text-white">
				<tr>
					<th>Peringkat</th>
					<th>Nama Lapangan Futsal</th>
					<th>Nilai Preferensi (V<sub>i</sub>)</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($nilaiPreferensi as $data): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td align="center"><?= esc($data['nama']) ?></td>
						<td><?= $data['nilai'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>