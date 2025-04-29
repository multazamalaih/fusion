<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

	<a href="<?= base_url('admin/cetak') ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>Nama Lapangan Futsal</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
				</thead>
				<tbody>
					<tr align="center">
						<td>Noel Futsal</td>
						<td>Contoh Nilai</td>
						<td>Contoh Rank</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>