<?= view('pages/admin/template/header') ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
	<a href="<?= base_url('admin/list-kriteria') ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="alert alert-info">
	Silahkan isi terlebih dahulu nilai kriteria menggunakan perbandingan berpasangan berdasarkan skala perbandingan 1-9
	(<span class="highlight-text" data-bs-toggle="modal" href="#teori" data-toggle="modal">sesuai teori</span>) kemudian klik
	<b>SIMPAN</b>. Setelah itu klik <b>CEK KONSISTENSI</b> untuk melakukan pembobotan preferensi dengan menggunakan metode AHP.
</div>

<div class="modal fade" id="teori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center w-100 font-weight-bold" id="myModalLabel">Skala Perbandingan 1-9</h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="Table" width="100%" cellspacing="0">
						<thead class="bg-success text-white">
							<tr align="center">
								<th>Skala</th>
								<th>Tingkat Kepentingan</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center">1</td>
								<td>Sama penting</td>
								<td>Kedua kriteria sama penting atau memiliki pengaruh yang sama besar</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">2</td>
								<td>Mendekati sedikit lebih penting</td>
								<td>Satu kriteria sedikit lebih penting dibandingkan yang lain, tetapi perbedaannya kecil</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">3</td>
								<td>Sedikit lebih penting</td>
								<td>Berdasarkan pengalaman atau penilaian, satu kriteria lebih dominan</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">4</td>
								<td>Mendekati lebih penting</td>
								<td>Satu kriteria lebih penting, tetapi belum signifikan</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">5</td>
								<td>Lebih penting</td>
								<td>Satu kriteria jelas lebih penting dibandingkan yang lain</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">6</td>
								<td>Mendekati jauh lebih penting</td>
								<td>Satu kriteria jauh lebih dominan dibandingkan yang lain</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">7</td>
								<td>Jauh lebih penting</td>
								<td>Satu kriteria sangat dominan berdasarkan bukti atau penilaian yang kuat</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">8</td>
								<td>Mendekati sangat penting</td>
								<td>Satu kriteria hampir mendominasi sepenuhnya dibandingkan yang lain</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td align="center">9</td>
								<td>Sangat penting</td>
								<td>Satu kriteria benar-benar dominan atau sangat penting dibandingkan yang lain</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success">
			<i class="fas fa-fw fa-table"></i> Perbandingan Data Antar Kriteria
		</h6>
	</div>

	<form action="" method="post">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-right" width="25%">Nama Kriteria</th>
							<th class="text-center" width="50%">Skala Perbandingan</th>
							<th class="text-left" width="25%">Nama Kriteria</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-right">Nama Kriteria 1</td>
							<td class="text-center">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<?php for ($i = 9; $i >= 2; $i--): ?>
										<label class="btn btn-success">
											<input type="radio" name="nilai_" value="-<?= $i ?>"> <?= $i ?>
										</label>
									<?php endfor; ?>
									<label class="btn btn-success">
										<input type="radio" name="nilai_" value="1"> 1
									</label>
									<?php for ($i = 2; $i <= 9; $i++): ?>
										<label class="btn btn-success">
											<input type="radio" name="nilai_" value="<?= $i ?>"> <?= $i ?>
										</label>
									<?php endfor; ?>
								</div>
							</td>
							<td class="text-left">Nama Kriteria 2</td>
						</tr>
						<tr>
							<td class="text-center" colspan="3">
								<button type="submit" name="save" class="btn btn-primary">
									<i class="fas fa-fw fa-save mr-1"></i> Simpan
								</button>
								<button type="submit" name="check" class="btn btn-success">
									<i class="fas fa-fw fa-check mr-1"></i> Cek Konsistensi
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- close table-responsive -->
		</div> <!-- close card-body -->
	</form>
</div>


<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Perbandingan Berpasangan</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				Isinya Matriks Perbandingan Berpasangan
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Nilai Kriteria (Normalisasi)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				Matriks Nilai Kriteria (Normalisasi)
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Matriks Penjumlahan Setiap Baris</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				Matriks Penjumlahan Setiap Baris
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-table"></i> Perhitungan Rasio Konsistensi</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				Perhitungan Rasio Konsistensi
			</table>
			Hasil Perhitungan AHP
		</div>
	</div>
</div>

<?= view('pages/admin/template/footer') ?>