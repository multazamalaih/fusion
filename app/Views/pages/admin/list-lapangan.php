<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
	<a href="<?= base_url('admin/tambah-lapangan') ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('success') ?>
	</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('error') ?>
	</div>
<?php endif; ?>

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
					<?php $no = 1;
					foreach ($lapangan as $l): ?>
						<tr align="center">
							<td><?= $no++ ?></td>
							<td><?= esc($l['nama']) ?></td>
							<td>Rp <?= number_format($l['harga'], 0, ',', '.') ?></td>
							<td><?= esc($l['jenis_lantai']) ?></td>
							<td><?= esc($l['no_hp']) ?></td>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" title="Detail Data" href="<?= base_url('admin/detail-lapangan/' . $l['id_lapangan']) ?>" class="btn btn-info btn-sm"><i class="fa fa-magnifying-glass"></i></a>
									<a data-toggle="tooltip" title="Edit Data" href="<?= base_url('admin/edit-lapangan/' . $l['id_lapangan']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<a data-toggle="tooltip" title="Hapus Data" href="<?= base_url('admin/hapus-lapangan/' . $l['id_lapangan']) ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>