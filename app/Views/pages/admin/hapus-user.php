<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users-cog"></i> Data User</h1>
	<a href="<?= base_url('admin/tambah-user') ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data User. Nantinya diedit karena full php</h6>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>