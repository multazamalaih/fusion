<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
	<?php if (isset($hasilLengkap) && $hasilLengkap): ?>
		<a href="<?= base_url('admin/cetak') ?>" target="_blank" class="btn btn-primary">
			<i class="fa fa-print"></i> Cetak Data
		</a>
	<?php else: ?>
		<button class="btn btn-secondary" disabled>
			<i class="fa fa-print"></i> Cetak Data
		</button>
	<?php endif; ?>
</div>
<?php if (session()->getFlashdata('errorhasil')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('errorhasil') ?>
	</div>
<?php endif; ?>
<?php if (isset($hasilLengkap) && $hasilLengkap): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered text-center">
				<thead class="bg-success text-white">
					<tr>
						<th>Nama Lapangan</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
					</tr>
				</thead>
				<tbody>
					<?php $rank = 1;
					foreach ($hasil as $row): ?>
						<tr>
							<td><?= esc($namaLapanganMap[$row['id_lapangan']] ?? '-') ?></td>
							<td align="center"><?= $row['nilai'] ?></td>
							<td align="center"><?= $rank++ ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?= view('pages/admin/template/footer') ?>