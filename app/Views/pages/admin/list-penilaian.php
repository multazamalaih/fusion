<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('success') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<div class="card shadow mb-4">
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
					<?php $no = 1; ?>
					<?php foreach ($lapanganList as $lap): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= esc($lap['nama']) ?></td>
							<td><?= 'Rp. ' . number_format($lap['harga'], 0, ',', '.') ?></td>
							<td><?= esc($lap['jenis_lantai']) ?></td>
							<td><?= esc($lap['no_hp']) ?></td>
							<td>
								<?php
								// Mengecek apakah ada penilaian untuk lapangan dan kriteria tertentu
								$penilaian = $penilaianData[$lap['id_lapangan']] ?? null;
								$penilaianExist = false;

								if ($penilaian) {
									foreach ($penilaian as $kriteriaId => $penilaianItem) {
										if ($penilaianItem && $penilaianItem['nilai'] !== null) {
											$penilaianExist = true;  // Jika ada nilai penilaian
											break;
										}
									}
								}

								// Menampilkan tombol Input atau Edit
								if ($penilaianExist):
								?>
									<a data-toggle="modal" href="#edit<?= $lap['id_lapangan'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
								<?php else: ?>
									<a data-toggle="modal" href="#input<?= $lap['id_lapangan'] ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Input -->
<?php foreach ($lapanganList as $lap): ?>
	<div class="modal fade" id="input<?= $lap['id_lapangan'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?= base_url('admin/simpan-penilaian') ?>" method="post">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-plus"></i> Input Penilaian</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id_lapangan" value="<?= $lap['id_lapangan'] ?>">

						<?php foreach ($kriteriaList as $k): ?>
							<input type="hidden" name="id_kriteria[]" value="<?= $k['id_kriteria'] ?>">

							<div class="form-group">
								<label class="font-weight-bold">(<?= $k['kode_kriteria'] ?>) <?= $k['nama'] ?></label>

								<?php if ($k['pilihan'] == 'Sub Kriteria'): ?>
									<!-- Dropdown untuk sub-kriteria jika pilihan kriteria adalah 'Sub Kriteria' -->
									<select name="nilai[]" class="form-control" required>
										<option value="">--Pilih--</option>
										<?php
										// Mengambil sub-kriteria dari controller
										$subKriteria = $subKriteriaData[$k['id_kriteria']] ?? [];
										foreach ($subKriteria as $sk):
										?>
											<option value="<?= $sk['id_sub_kriteria'] ?>"><?= $sk['nama'] ?> </option>
										<?php endforeach; ?>
									</select>
								<?php else: ?>
									<!-- Input angka jika kriteria tidak memiliki sub-kriteria -->
									<input type="number" name="nilai[]" class="form-control" step="0.01" required>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<!-- Modal Edit -->
<?php foreach ($lapanganList as $lap): ?>
	<?php if (isset($penilaianData[$lap['id_lapangan']])): ?>
		<div class="modal fade" id="edit<?= $lap['id_lapangan'] ?>" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="<?= base_url('admin/update-penilaian/' . $lap['id_lapangan']) ?>" method="post">
						<div class="modal-header">
							<h5 class="modal-title"><i class="fa fa-edit"></i> Edit Penilaian</h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="id_lapangan" value="<?= $lap['id_lapangan'] ?>">

							<?php foreach ($kriteriaList as $k): ?>
								<input type="hidden" name="id_kriteria[]" value="<?= $k['id_kriteria'] ?>">

								<div class="form-group">
									<label class="font-weight-bold">(<?= $k['kode_kriteria'] ?>) <?= $k['nama'] ?></label>

									<?php
									// Ambil data penilaian untuk lapangan dan kriteria
									$penilaian = isset($penilaianData[$lap['id_lapangan']][$k['id_kriteria']]) ? $penilaianData[$lap['id_lapangan']][$k['id_kriteria']] : null;
									$nilai = $penilaian ? $penilaian['nilai'] : '';
									?>

									<?php if ($k['pilihan'] == 'Sub Kriteria'): ?>
										<!-- Dropdown untuk sub-kriteria jika pilihan kriteria adalah 'Sub Kriteria' -->
										<select name="nilai[]" class="form-control" required>
											<option value="">--Pilih--</option>
											<?php
											// Mengambil sub-kriteria yang sudah diurutkan berdasarkan nilai
											$subKriteria = $subKriteriaData[$k['id_kriteria']] ?? [];
											foreach ($subKriteria as $sk):
												// Cek apakah nilai penilaian sama dengan nilai sub-kriteria
												$selected = ($sk['nilai'] == $nilai) ? 'selected' : '';
											?>
												<option value="<?= $sk['id_sub_kriteria'] ?>" <?= $selected ?>>
													<?= $sk['nama'] ?>
												</option>
											<?php endforeach; ?>
										</select>
									<?php else: ?>
										<!-- Input angka jika kriteria tidak memiliki sub-kriteria -->
										<input type="number" name="nilai[]" class="form-control" step="0.01" value="<?= (float)$nilai == floor($nilai) ? number_format($nilai, 0, '.', '') : number_format($nilai, 2, '.', '') ?>" required autocomplete="off">
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>


<?= view('pages/admin/template/footer') ?>