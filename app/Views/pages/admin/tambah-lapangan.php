<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
	<a href="javascript:history.back()" class="btn btn-secondary btn-icon-split">
		<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data Lapangan Futsal</h6>
	</div>
	<form action="<?= base_url('admin/simpan-lapangan') ?>" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="row">
				<!-- Nama -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama Lapangan</label>
					<input type="text" name="nama" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>" required>
					<?php if (session('errors.nama')): ?><div class="invalid-feedback text-danger"><?= session('errors.nama') ?></div><?php endif; ?>
				</div>

				<!-- Harga -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Harga Sewa per Jam</label>
					<input type="text" name="harga" class="form-control <?= session('errors.harga') ? 'is-invalid' : '' ?>" value="<?= old('harga') ?>" required>
					<?php if (session('errors.harga')): ?><div class="invalid-feedback text-danger"><?= session('errors.harga') ?></div><?php endif; ?>
				</div>

				<!-- Jenis Lantai -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Jenis Lantai</label>
					<select name="jenis_lantai" class="form-control <?= session('errors.jenis_lantai') ? 'is-invalid' : '' ?>" required>
						<option value="">--Pilih--</option>
						<?php $opsi = ['Vinyl', 'Rumput Sintetis', 'Semen', 'Parquette', 'Taraflex', 'Interlock'];
						foreach ($opsi as $o): ?>
							<option value="<?= $o ?>" <?= old('jenis_lantai') == $o ? 'selected' : '' ?>><?= $o ?></option>
						<?php endforeach; ?>
					</select>
					<?php if (session('errors.jenis_lantai')): ?><div class="invalid-feedback text-danger"><?= session('errors.jenis_lantai') ?></div><?php endif; ?>
				</div>

				<!-- No HP -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nomor Handphone</label>
					<input type="text" name="no_hp" class="form-control <?= session('errors.no_hp') ? 'is-invalid' : '' ?>" value="<?= old('no_hp') ?>" required>
					<?php if (session('errors.no_hp')): ?><div class="invalid-feedback text-danger"><?= session('errors.no_hp') ?></div><?php endif; ?>
				</div>

				<!-- Latitude & Longitude -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Latitude</label>
					<input type="text" name="latitude" class="form-control <?= session('errors.latitude') ? 'is-invalid' : '' ?>" value="<?= old('latitude') ?>" required>
					<?php if (session('errors.latitude')): ?><div class="invalid-feedback text-danger"><?= session('errors.latitude') ?></div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Longitude</label>
					<input type="text" name="longitude" class="form-control <?= session('errors.longitude') ? 'is-invalid' : '' ?>" value="<?= old('longitude') ?>" required>
					<?php if (session('errors.longitude')): ?><div class="invalid-feedback text-danger"><?= session('errors.longitude') ?></div><?php endif; ?>
				</div>

				<!-- Alamat -->
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Alamat</label>
					<textarea name="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" required><?= old('alamat') ?></textarea>
					<?php if (session('errors.alamat')): ?><div class="invalid-feedback text-danger"><?= session('errors.alamat') ?></div><?php endif; ?>
				</div>

				<!-- Foto -->
				<?php $fotoLabel = [
					'lapangan' => 'Lapangan',
					'bangku_cadangan' => 'Bangku Cadangan',
					'toilet_wc' => 'Toilet/WC',
					'mushola' => 'Mushola',
					'tempat_parkir' => 'Tempat Parkir'
				];
				foreach ($fotoLabel as $key => $label): ?>
					<div class="form-group col-md-6">
						<label class="font-weight-bold">Foto <?= $label ?></label>
						<div class="custom-file">
							<input type="file" class="custom-file-input <?= session("errors.foto.$key") ? 'is-invalid' : '' ?>" name="foto[<?= $key ?>]" id="foto_<?= $key ?>" required>
							<label class="custom-file-label" for="foto_<?= $key ?>">Pilih file...</label>
							<?php if (session("errors.foto.$key")): ?><div class="invalid-feedback text-danger"><?= session("errors.foto.$key") ?></div><?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Fasilitas Pendukung</label>
					<div class="row">
						<?php
						$fasilitasLengkap = [
							"Papan Skor",
							"Kipas Angin / AC",
							"Bangku Cadangan",
							"Loker Barang",
							"Toilet / WC",
							"Ruang Ganti",
							"Mushola",
							"Kantin",
							"Tribun Penonton",
							"Tempat Parkir",
							"Keamanan (Satpam)",
							"WiFi Gratis"
						];
						foreach ($fasilitasLengkap as $i => $f): ?>
							<div class="col-md-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="fasilitas[]" value="<?= $f ?>" id="f<?= $i ?>" <?= in_array($f, old('fasilitas') ?? []) ? 'checked' : '' ?>>
									<label class="form-check-label" for="f<?= $i ?>"><?= $f ?></label>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Jam Operasional</label>
					<div class="row">
						<div class="col-md-12">
							<?php foreach (["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"] as $hari):
								$checked = old($hari) ? 'checked' : '';
								$buka = old($hari . '_buka');
								$tutup = old($hari . '_tutup');
							?>
								<div class="form-check mb-2">
									<input class="form-check-input toggle-jam" type="checkbox" id="<?= $hari ?>" name="<?= $hari ?>" <?= $checked ?>>
									<label class="form-check-label font-weight-bold" for="<?= $hari ?>"><?= ucfirst($hari) ?></label>
									<div class="jam-input mt-2 ml-4" style="display:<?= $checked ? 'flex' : 'none' ?>;">
										<span class="mr-2 mb-2">Jam Buka:</span>
										<input type="time" name="<?= $hari ?>_buka" value="<?= $buka ?>" class="form-control form-control-sm bg-light mr-3 mb-2" style="width: 100px;">
										<span class="mr-2 mb-2">-</span>
										<span class="mr-2 mb-2">Jam Tutup:</span>
										<input type="time" name="<?= $hari ?>_tutup" value="<?= $tutup ?>" class="form-control form-control-sm bg-light mb-2" style="width: 100px;">
									</div>
								</div>
							<?php endforeach; ?>
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

<?php require_once('template/footer.php'); ?>