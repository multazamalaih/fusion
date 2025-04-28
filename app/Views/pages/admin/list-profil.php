<?php
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user"></i> Data Profile</h1>
</div>

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
						<td>Contoh Nama User</td>
						<td>Contoh Nama Email</td>
						<td>
							<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="edit-profil.php" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
?>