<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Data Sub Kriteria</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('success') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if (empty($sub_kriteria)): ?>
	<div class="alert alert-danger">
		Tidak Ada Kriteria yang memiliki Sub Kriteria sebagai cara penilaian. Silahkan pilih Sub Kriteria saat pemilihan Kriteria.
	</div>
<?php else: ?>
	<?php foreach ($sub_kriteria as $id_kriteria => $k): ?>
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex justify-content-between align-items-center">
				<h6 class="m-0 font-weight-bold text-success">
					<i class="fa fa-table"></i> <?= esc($k['nama_kriteria']) ?> (<?= esc($k['kode_kriteria']) ?>)
				</h6>
				<a href="#tambah<?= $id_kriteria ?>" data-toggle="modal" class="btn btn-sm btn-success">
					<i class="fa fa-plus"></i> Tambah Data
				</a>
			</div>

			<!-- Modal Tambah -->
			<div class="modal fade" id="tambah<?= $id_kriteria ?>" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="<?= base_url('admin/simpan-sub-kriteria') ?>" method="post">
							<div class="modal-header">
								<h5 class="modal-title"><i class="fa fa-plus"></i> Tambah (<?= esc($k['nama_kriteria']) ?>)</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<input type="hidden" name="mode" value="tambah">
								<input type="hidden" name="id_kriteria" value="<?= esc($id_kriteria) ?>">
								<div class="form-group">
									<label class="font-weight-bold">Nama Sub Kriteria</label>
									<input type="text" name="nama"
										value="<?= old('id_kriteria') == $id_kriteria ? old('nama') : '' ?>"
										class="form-control <?= session('errors.nama') && old('id_kriteria') == $id_kriteria ? 'is-invalid' : '' ?>" required>
									<?php if (session('errors.nama') && old('id_kriteria') == $id_kriteria): ?>
										<div class="invalid-feedback text-danger"> <?= session('errors.nama') ?> </div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Nilai</label>
									<input type="number" name="nilai" step="0.001"
										value="<?= old('id_kriteria') == $id_kriteria ? old('nilai') : '' ?>"
										class="form-control <?= session('errors.nilai') && old('id_kriteria') == $id_kriteria ? 'is-invalid' : '' ?>" required>
									<?php if (session('errors.nilai') && old('id_kriteria') == $id_kriteria): ?>
										<div class="invalid-feedback text-danger"> <?= session('errors.nilai') ?> </div>
									<?php endif; ?>

								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead class="bg-success text-white text-center">
							<tr>
								<th width="5%">No</th>
								<th>Nama Sub Kriteria</th>
								<th>Nilai</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($k['data'] as $i => $sub): ?>
								<tr class="text-center">
									<td><?= $i + 1 ?></td>
									<td><?= esc($sub['nama']) ?></td>
									<td><?= esc($sub['nilai']) ?></td>
									<td>
										<div class="btn-group" role="group">
											<a data-toggle="modal" data-placement="bottom" title="Edit Data"
												href="#edit<?= $sub['id_sub_kriteria'] ?>" class="btn btn-warning btn-sm">
												<i class="fa fa-edit"></i>
											</a>
											<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
												href="<?= base_url('admin/hapus-sub-kriteria/' . $sub['id_sub_kriteria']) ?>"
												onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"
												class="btn btn-danger btn-sm">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</td>
								</tr>
								<!-- Modal Edit -->
								<div class="modal fade" id="edit<?= $sub['id_sub_kriteria'] ?>" tabindex="-1" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="<?= base_url('admin/update-sub-kriteria/' . $sub['id_sub_kriteria']) ?>" method="post">
												<div class="modal-header">
													<h5 class="modal-title"><i class="fa fa-edit"></i> Edit (<?= esc($k['nama_kriteria']) ?>)</h5>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<input type="hidden" name="mode" value="edit">
													<input type="hidden" name="id_kriteria" value="<?= esc($id_kriteria) ?>">
													<input type="hidden" name="id_sub_kriteria" value="<?= esc($sub['id_sub_kriteria']) ?>">

													<div class="form-group">
														<label class="font-weight-bold">Nama Sub Kriteria</label>
														<input type="text" name="nama"
															value="<?= old('id_sub_kriteria') == $sub['id_sub_kriteria'] ? old('nama') : esc($sub['nama']) ?>"
															class="form-control <?= session('errors.nama') && old('id_sub_kriteria') == $sub['id_sub_kriteria'] ? 'is-invalid' : '' ?>" required>
														<?php if (session('errors.nama') && old('id_sub_kriteria') == $sub['id_sub_kriteria']): ?>
															<div class="invalid-feedback text-danger"> <?= session('errors.nama') ?> </div>
														<?php endif; ?>
													</div>

													<div class="form-group">
														<label class="font-weight-bold">Nilai</label>
														<input type="number" name="nilai" step="0.001"
															value="<?= old('id_sub_kriteria') == $sub['id_sub_kriteria'] ? old('nilai') : esc($sub['nilai']) ?>"
															class="form-control <?= session('errors.nilai') && old('id_sub_kriteria') == $sub['id_sub_kriteria'] ? 'is-invalid' : '' ?>" required>
														<?php if (session('errors.nilai') && old('id_sub_kriteria') == $sub['id_sub_kriteria']): ?>
															<div class="invalid-feedback text-danger"> <?= session('errors.nilai') ?> </div>
														<?php endif; ?>
													</div>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
													<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif; ?>
<?php if (session('errors') && old('mode') === 'edit' && old('id_sub_kriteria')): ?>
	<script>
		$(document).ready(function() {
			$('#edit<?= old('id_sub_kriteria') ?>').modal('show');
		});
	</script>
<?php elseif (session('errors') && old('mode') === 'tambah' && old('id_kriteria')): ?>
	<script>
		$(document).ready(function() {
			$('#tambah<?= old('id_kriteria') ?>').modal('show');
		});
	</script>
<?php endif; ?>
<?= view('pages/admin/template/footer') ?>