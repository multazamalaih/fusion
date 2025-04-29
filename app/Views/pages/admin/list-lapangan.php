<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
	<a href="<?= base_url('admin/tambah-lapangan') ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Lapangan Futsal</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Lapangan</th>
						<th>Harga Sewa/Jam</th>
						<th>Jenis Lantai</th>
						<th>Nomor Handphone</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td>1</td>
						<td>Noel Futsal</td>
						<td>Rp. 100.000</td>
						<td>Vinyl</td>
						<td>081234567890</td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('admin/detail-lapangan') ?>" class="btn btn-info btn-sm"><i class="fa fa-magnifying-glass"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?= base_url('admin/edit-lapangan') ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('admin/hapus-lapangan') ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>