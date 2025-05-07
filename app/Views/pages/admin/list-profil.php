<?= view('pages/admin/template/header') ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user"></i> Data Profil</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?= session()->getFlashdata('success') ?>
	</div>
<?php endif; ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Profil</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="10%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>Nama</th>
						<th>Email</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td><?= esc($user['nama']) ?></td>
						<td><?= esc($user['email']) ?></td>
						<td>
							<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?= base_url('admin/edit-profil') ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>