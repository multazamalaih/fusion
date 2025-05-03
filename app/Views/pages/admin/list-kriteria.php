<?= view('pages/admin/template/header') ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4 flex-column flex-sm-row">
	<h1 class="h3 text-gray-800 mb-3 mb-sm-0"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
	<div class="d-flex flex-column flex-sm-row">
		<?php if ($bisa_tambah_bobot): ?>
			<a href="<?= base_url('admin/tambah-bobot') ?>" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2">
				<i class="fa fa-sync"></i> Bobot Preferensi AHP
			</a>
		<?php else: ?>
			<button class="btn btn-secondary mb-2 mb-sm-0 mr-sm-2" disabled title="Minimal 3 kriteria dibutuhkan">
				<i class="fa fa-sync"></i> Bobot Preferensi AHP
			</button>
		<?php endif; ?>

		<a href="<?= base_url('admin/tambah-kriteria') ?>" class="btn btn-success mb-2 mb-sm-0">
			<i class="fa fa-plus"></i> Tambah Data
		</a>
	</div>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('success') ?>
	</div>
<?php endif; ?>

<?php if (session()->getFlashdata('errorkriteria')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?= session()->getFlashdata('errorkriteria') ?>
	</div>
<?php endif; ?>

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
						<th>Tipe</th>
						<th>Bobot</th>
						<th>Cara Penilaian</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($kriteria as $krit): ?>
						<tr align="center">
							<td><?= $no++ ?></td>
							<td><?= esc($krit['kode_kriteria']) ?></td>
							<td><?= esc($krit['nama']) ?></td>
							<td><?= esc($krit['tipe']) ?></td>
							<td><?= ($krit['bobot'] == 0) ? '-' : esc($krit['bobot']) ?></td>
							<td>
								<?= esc($krit['pilihan'] === 'Langsung' ? 'Input Langsung' : 'Pilih Sub Kriteria') ?>
							</td>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" data-placement="bottom" title="Detail Data"
										href="<?= base_url('admin/detail-kriteria/' . $krit['id_kriteria']) ?>" class="btn btn-info btn-sm">
										<i class="fa fa-magnifying-glass"></i>
									</a>
									<a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
										href="<?= base_url('admin/edit-kriteria/' . $krit['id_kriteria']) ?>" class="btn btn-warning btn-sm">
										<i class="fa fa-edit"></i>
									</a>
									<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
										href="<?= base_url('admin/hapus-kriteria/' . $krit['id_kriteria']) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini ?')" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"></i></a>
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