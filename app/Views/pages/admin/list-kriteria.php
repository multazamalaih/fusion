<?= view('pages/admin/template/header') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4 flex-column flex-sm-row">
	<h1 class="h3 text-gray-800 mb-3 mb-sm-0"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
	<div class="d-flex flex-column flex-sm-row">
		<a href="<?= base_url('admin/tambah-bobot') ?>" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2"><i class="fa fa-sync"></i> Bobot Preferensi AHP</a>
		<a href="<?= base_url('admin/tambah-kriteria') ?>" class="btn btn-success mb-2 mb-sm-0"><i class="fa fa-plus"></i> Tambah Data</a>
	</div>
</div>


<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Kriteria</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>No</th>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Type</th>
						<th>Bobot</th>
						<th>Cara Penilaian</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>

					<tr align="center">
						<td>1</td>
						<td>C1</td>
						<td>Harga Sewa</td>
						<td>Cost</td>
						<td>-</td>
						<td>Pilihan Sub Kriteria</td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('admin/detail-kriteria') ?>" class="btn btn-info btn-sm"><i class="fa fa-magnifying-glass"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?= base_url('admin/edit-kriteria') ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('admin/hapus-kriteria') ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>