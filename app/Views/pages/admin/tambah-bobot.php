<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Perbandingan Kriteria</h1>
	<a href="<?= base_url('admin/list-kriteria') ?>" class="btn btn-secondary btn-icon-split">
		<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?php
$successMessage = session()->getFlashdata('success') ?: ($success ?? null);
$errorMessage  = session()->getFlashdata('error') ?: ($error ?? null);
?>

<?php if ($successMessage): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= esc($successMessage) ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<?php if ($errorMessage): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= esc($errorMessage) ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
<?php endif; ?>

<div class="alert alert-success">
	Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9
	(<span class="highlight-text" data-toggle="modal" href="#teori">sesuai teori</span>) kemudian klik
	<b>SIMPAN</b> atau <b>CEK KONSISTENSI</b> untuk menghitung bobot AHP.
</div>

<!-- Modal Skala -->
<div class="modal fade" id="teori" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title w-100 text-center">Skala Perbandingan 1–9</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="bg-success text-white text-center">
							<tr>
								<th>Skala</th>
								<th>Tingkat Kepentingan</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$skala = [
								1 => 'Sama penting',
								2 => 'Mendekati sedikit lebih penting',
								3 => 'Sedikit lebih penting',
								4 => 'Mendekati lebih penting ',
								5 => 'Lebih penting',
								6 => 'Mendekati sangat lebih penting ',
								7 => 'Sangat lebih penting',
								8 => 'Mendekati mutlak lebih penting',
								9 => 'Mutlak lebih penting'
							];

							$deskripsi = [
								1 => 'Kedua kriteria memiliki tingkat kepentingan yang sama.',
								2 => 'Satu kriteria mendekati sedikit lebih penting daripada kriteria lainnya.',
								3 => 'Satu kriteria sedikit lebih penting daripada kriteria lainnya.',
								4 => 'Satu kriteria mendekati lebih penting daripada kriteria lainnya.',
								5 => 'Satu kriteria lebih penting daripada kriteria lainnya.',
								6 => 'Satu kriteria mendekati sangat lebih penting daripada kriteria lainnya.',
								7 => 'Satu kriteria sangat lebih penting daripada kriteria lainnya.',
								8 => 'Satu kriteria mendekati mutlak lebih penting daripada kriteria lainnya.',
								9 => 'Satu kriteria mutlak lebih penting daripada kriteria lainnya.'
							];
							foreach ($skala as $i => $label): ?>
								<tr>
									<td class="text-center"><?= $i ?></td>
									<td><?= $label ?></td>
									<td><?= $deskripsi[$i] ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<form action="<?= base_url('admin/simpan-bobot') ?>" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Perbandingan Kriteria</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="text-center">
						<tr>
							<th>Kriteria 1</th>
							<th>Skala</th>
							<th>Kriteria 2</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0;
						foreach ($kriteria as $k1): $j = 0;
							foreach ($kriteria as $k2):
								if ($i < $j):
									$inputName = 'nilai_' . $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
									$nilai = isset($nilai_input_sementara[$k1['id_kriteria']][$k2['id_kriteria']])
										? $nilai_input_sementara[$k1['id_kriteria']][$k2['id_kriteria']]
										: ($nilaiBobot[$k1['id_kriteria']][$k2['id_kriteria']] ?? 1);
						?>
									<tr>
										<td class="text-right"><?= esc($k1['kode_kriteria']) ?> - <?= esc($k1['nama']) ?></td>
										<td class="text-center">
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<?php for ($n = 9; $n >= 2; $n--): ?>
													<label class="btn btn-success <?= ($nilai == -$n) ? 'active' : '' ?>">
														<input type="radio" name="<?= $inputName ?>" value="-<?= $n ?>" <?= ($nilai == -$n) ? 'checked' : '' ?>><?= $n ?>
													</label>
												<?php endfor; ?>
												<label class="btn btn-success <?= ($nilai == 1) ? 'active' : '' ?>">
													<input type="radio" name="<?= $inputName ?>" value="1" <?= ($nilai == 1) ? 'checked' : '' ?>>1
												</label>
												<?php for ($n = 2; $n <= 9; $n++): ?>
													<label class="btn btn-success <?= ($nilai == $n) ? 'active' : '' ?>">
														<input type="radio" name="<?= $inputName ?>" value="<?= $n ?>" <?= ($nilai == $n) ? 'checked' : '' ?>><?= $n ?>
													</label>
												<?php endfor; ?>
											</div>
										</td>
										<td class="text-left"><?= esc($k2['kode_kriteria']) ?> - <?= esc($k2['nama']) ?></td>
									</tr>
						<?php endif;
								$j++;
							endforeach;
							$i++;
						endforeach; ?>
						<tr>
							<td class="text-center" colspan="3">
								<button type="submit" name="save" class="btn btn-primary mr-2"><i class="fas fa-fw fa-save mr-1"></i> Simpan</button>
								<button type="submit" formaction="<?= base_url('admin/cek-konsistensi') ?>" name="check" class="btn btn-success"><i class="fas fa-fw fa-check mr-1"></i> Cek Konsistensi</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
<?php if (isset($hasil_ahp)) {
	extract($hasil_ahp); // ini akan membuat $matrik, $jumlahKolom, dst tersedia
} ?>

<?php if (isset($from_cek_konsistensi) && isset($matrik) && isset($jumlahKolom)): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Perbandingan Berpasangan</h6>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Kriteria</th>
						<?php foreach ($kriteria as $k): ?>
							<th><?= esc($k['kode_kriteria']) ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kriteria as $i => $baris): ?>
						<tr>
							<th><?= esc($baris['kode_kriteria']) ?></th>
							<?php foreach ($kriteria as $j => $kolom): ?>
								<td><?= $matrik[$i][$j] ?? '-' ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
					<tr>
						<th>Jumlah</th>
						<?php foreach ($jumlahKolom as $jumlah): ?>
							<td class="font-weight-bold"><?= $jumlah ?></td>
						<?php endforeach; ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (isset($from_cek_konsistensi) && isset($normalisasi) && isset($prioritas)): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Normalisasi & Bobot</h6>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Kriteria</th>
						<?php foreach ($kriteria as $k): ?>
							<th><?= esc($k['kode_kriteria']) ?></th>
						<?php endforeach; ?>
						<th>Jumlah</th>
						<th>Prioritas</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kriteria as $i => $row): ?>
						<tr>
							<th><?= esc($row['kode_kriteria']) ?></th>
							<?php
							$jumlah = 0;
							foreach ($kriteria as $j => $col):
								$val = $normalisasi[$i][$j];
								$jumlah += $val;
							?>
								<td><?= $val ?></td>
							<?php endforeach; ?>
							<td class="font-weight-bold"><?= round($jumlah, 5) ?></td>
							<td class="font-weight-bold"><?= $prioritas[$i] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (isset($from_cek_konsistensi) && isset($matrikBaris) && isset($jumlahBaris)): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Penjumlahan Baris</h6>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Kriteria</th>
						<?php foreach ($kriteria as $k): ?>
							<th><?= esc($k['kode_kriteria']) ?></th>
						<?php endforeach; ?>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kriteria as $i => $row): ?>
						<tr>
							<th><?= esc($row['kode_kriteria']) ?></th>
							<?php foreach ($kriteria as $j => $col): ?>
								<td><?= $matrikBaris[$i][$j] ?></td>
							<?php endforeach; ?>
							<td class="font-weight-bold"><?= $jumlahBaris[$i] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (isset($from_cek_konsistensi) && isset($hasilKonsistensi)): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Rasio Konsistensi</h6>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th>Kriteria</th>
						<th>Jumlah Baris</th>
						<th>Prioritas</th>
						<th>Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kriteria as $i => $k): ?>
						<tr>
							<td><?= esc($k['kode_kriteria']) ?></td>
							<td><?= $jumlahBaris[$i] ?></td>
							<td><?= $prioritas[$i] ?></td>
							<td class="font-weight-bold"><?= $hasilKonsistensi[$i] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (isset($from_cek_konsistensi) && isset($lambdaMax)): ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Detail Rasio Konsistensi</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<td width="150">Jumlah</td>
					<td>= <?= round($lambdaMax * count($kriteria), 5) ?></td>
				</tr>
				<tr>
					<td>n</td>
					<td>= <?= count($kriteria) ?></td>
				</tr>
				<tr>
					<td>&#955; maks</td>
					<td>= <?= round($lambdaMax, 5) ?></td>
				</tr>
				<tr>
					<td>CI</td>
					<td>= <?= round($ci, 5) ?></td>
				</tr>
				<tr>
					<td>IR</td>
					<td>= <?= $ir[count($kriteria) - 1] ?></td>
				</tr>
				<tr>
					<td>CR</td>
					<td>= <?= round($cr, 5) ?></td>
				</tr>
				<tr>
					<td>CR &le; 0.1</td>
					<td class="font-weight-bold"><?= ($cr <= 0.1) ? 'Konsisten' : 'Tidak Konsisten' ?></td>
				</tr>
			</table>
		</div>
	</div>
<?php endif; ?>


<?= view('pages/admin/template/footer') ?>