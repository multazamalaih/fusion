<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Penilaian Lapangan Futsal</h6>
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
				<tbody align="center">
					<td>1</td>
					<td>Noel Futsal</td>
					<td>Rp. 100.000</td>
					<td>Vinyl</td>
					<td>081234567890</td>
					<td>
						<a data-toggle="modal" href="#edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
					</td>

					<!-- Modal -->
					<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<form action="" method="post">
									<div class="modal-body">
										<input type="text" name="id_lapangan" value="lapangan" hidden>
										<input type="text" name="id_kriteria" value="kriteria" hidden>
										<div class="form-group">
											<label class="font-weight-bold">Kualitas Lapangan</label>
											<select name="nilai" class="form-control" required>
												<option value="">--Pilih--</option>
												<option value="Sangat Buruk">Sangat Buruk</option>
												<option value="Buruk">Buruk</option>
												<option value="Cukup" selected>Cukup</option>
												<option value="Baik">Baik</option>
												<option value="Sangat Baik">Sangat Baik</option>
											</select>
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

<?= view('pages/admin/template/footer') ?>