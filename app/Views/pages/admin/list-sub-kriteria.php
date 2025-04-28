<?php
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Data Sub Kriteria</h1>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<div class="d-sm-flex align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Nama Kriteria (Kode Kriteria)</h6>
			<a href="#tambah" data-toggle="modal" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
		</div>
	</div>

	<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah (Nama Kriteria)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<input type="text" name="id_kriteria" value="id_kriteria" hidden>
						<div class="form-group">
							<label class="font-weight-bold">Nama Sub Kriteria</label>
							<input autocomplete="off" type="text" class="form-control" name="nama" required>
						</div>
						<div class="form-group">
							<label class="font-weight-bold">Nilai</label>
							<input autocomplete="off" step="0.001" type="number" name="nilai" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" name="tambah" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Sub Kriteria</th>
						<th>Nilai</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td>1</td>
						<td>Nama Sub Kriteria</td>
						<td>5</td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="modal" title="Edit Data" href="#editsk" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-sub-kriteria.php" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>

					<!-- Modal -->
					<div class="modal fade" id="editsk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit (Nama Kriteria)</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<form action="list-sub-kriteria.php" method="post">
									<input type="text" name="id_sub_kriteria" value="id_sub_kriteria" hidden>
									<div class="modal-body">
										<input type="text" name="id_kriteria" value="id_kriteria" hidden>
										<div class="form-group">
											<label class="font-weight-bold">Nama Sub Kriteria</label>
											<input type="text" autocomplete="off" class="form-control" value="nama lama" name="nama" required>
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Nilai</label>
											<input type="number" autocomplete="off" value="5" name="nilai" class="form-control" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
										<button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
?>