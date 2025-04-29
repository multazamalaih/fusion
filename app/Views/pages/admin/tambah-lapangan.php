<?= view('pages/admin/template/header') ?>

<style type="text/css">
	.jam-input {
		display: none;
		margin-left: 10px;
		align-items: center;
		gap: 10px;
	}
</style>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Ambil semua checkbox hari
		let checkboxes = document.querySelectorAll(".form-check-input");

		checkboxes.forEach(function(checkbox) {
			checkbox.addEventListener("change", function() {
				let jamInput = this.closest(".form-check").querySelector(".jam-input");
				if (this.checked) {
					jamInput.style.display = "flex";
				} else {
					jamInput.style.display = "none";
				}
			});
		});
	});
</script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
	<a href="<?= base_url('admin/list-lapangan') ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data Lapangan Futsal</h6>
	</div>

	<form action="<?= base_url('admin/tambah-lapangan') ?>" method="post">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="font-weight-bold text-secondary">Nama Lapangan</label>
					<input autocomplete="off" type="text" name="nama" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Harga Sewa per Jam</label>
					<input autocomplete="off" type="text" name="harga" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Jenis Lantai</label>
					<select name="jenis_lantai" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="Vinyl">Vinyl</option>
						<option value="Rumput sintetis">Rumput Sintetis</option>
						<option value="Semen">Semen</option>
						<option value="Parquette">Parquette</option>
						<option value="Taraflex">Taraflex</option>
						<option value="interlock">Interlock</option>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nomor Handphone</label>
					<input autocomplete="off" type="text" name="no_hp" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Latitude</label>
					<input autocomplete="off" type="text" name="latitude" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Longitude</label>
					<input autocomplete="off" type="text" name="longitude" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Alamat</label>
					<textarea autocomplete="off" name="alamat" required class="form-control" style="height: 100px; text-align: left; vertical-align: top; word-break: break-word; overflow-wrap: break-word;"></textarea>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Foto Lapangan</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoLapangan" name="foto_utama" required>
						<label class="custom-file-label" for="fotoLapangan">Pilih file...</label>
						<div class="invalid-feedback">File wajib diunggah.</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Foto Bangku Cadangan</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoCadangan" name="foto[]" required>
						<label class="custom-file-label" for="fotoCadangan">Pilih file...</label>
						<div class="invalid-feedback">File wajib diunggah.</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Foto Toilet/WC</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoToilet" name="foto[]" required>
						<label class="custom-file-label" for="fotoToilet">Pilih file...</label>
						<div class="invalid-feedback">File wajib diunggah.</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Foto Mushola</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoMushola" name="foto[]" required>
						<label class="custom-file-label" for="fotoMushola">Pilih file...</label>
						<div class="invalid-feedback">File wajib diunggah.</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Foto Tempat Parkir</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="fotoParkir" name="foto[]" required>
						<label class="custom-file-label" for="fotoParkir">Pilih file...</label>
						<div class="invalid-feedback">File wajib diunggah.</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Fasilitas Pendukung</label>
					<div class="row">
						<!-- Kolom 1 -->
						<div class="col-md-6">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="papanskor">
								<label class="form-check-label" for="papanskor">Papan Skor</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="kipasangin/ac">
								<label class="form-check-label" for="kipasangin/ac">Kipas Angin / AC</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="bangkucadangan">
								<label class="form-check-label" for="bangkusadangan">Bangku Cadangan</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="lokerbarang">
								<label class="form-check-label" for="lokerbarang">Loker Barang</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="toilet/wc">
								<label class="form-check-label" for="toilet/wc">Toilet / WC</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="ruangganti">
								<label class="form-check-label" for="ruangganti">Ruang Ganti</label>
							</div>
						</div>

						<!-- Kolom 2 -->
						<div class="col-md-6">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="mushola">
								<label class="form-check-label" for="mushola">Mushola</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="kantin">
								<label class="form-check-label" for="kantin">Kantin</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="tribunpenonton">
								<label class="form-check-label" for="tribunpenonton">Tribun Penonton</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="tempatparkir">
								<label class="form-check-label" for="tempatparkir">Tempat Parkir</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="satpam">
								<label class="form-check-label" for="satpam">Keamanan (Satpam)</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="wifigratis">
								<label class="form-check-label" for="wifigratis">WiFi Gratis</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Jam Operasional</label>
					<div class="row">
						<!-- Kolom 1 -->
						<div class="col-md-12">
							<?php
							$hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
							foreach ($hari as $h) { ?>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="<?= $h ?>" name="<?= $h ?>">
									<label class="form-check-label" for="<?= $h ?>"><?= ucfirst($h) ?></label>
									<div class="jam-input">
										<div class="d-flex flex-wrap align-items-center">
											<span class="mr-2 mb-2">Jam Buka:</span>
											<input type="time" name="<?= $h ?>_buka" class="form-control form-control-sm bg-light mr-3 mb-2" style="width: 100px; min-width: 90px;">
											<span class="mr-2 mb-2">-</span>
											<span class="mr-2 mb-2">Jam Tutup:</span>
											<input type="time" name="<?= $h ?>_tutup" class="form-control form-control-sm bg-light mb-2" style="width: 100px; min-width: 90px;">
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</form>
</div>

<?php
require_once('template/footer.php');
?>