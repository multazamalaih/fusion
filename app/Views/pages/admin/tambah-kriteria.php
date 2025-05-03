<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
	<a href="javascript:history.back()" class="btn btn-secondary btn-icon-split">
		<span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data Kriteria</h6>
	</div>

	<form action="<?= base_url('admin/simpan-kriteria') ?>" method="post">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Kode Kriteria</label>
					<input type="text" name="kode_kriteria" value="<?= old('kode_kriteria') ?>" class="form-control <?= session('errors.kode_kriteria') ? 'is-invalid' : '' ?>" required>
					<?php if (session('errors.kode_kriteria')): ?><div class="invalid-feedback text-danger"> <?= session('errors.kode_kriteria') ?> </div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama Kriteria</label>
					<input type="text" name="nama" value="<?= old('nama') ?>" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" required>
					<?php if (session('errors.nama')): ?><div class="invalid-feedback text-danger"> <?= session('errors.nama') ?> </div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Tipe Kriteria</label>
					<select name="tipe" class="form-control <?= session('errors.tipe') ? 'is-invalid' : '' ?>" required>
						<option value="">--Pilih--</option>
						<option value="Benefit" <?= old('tipe') == 'Benefit' ? 'selected' : '' ?>>Benefit</option>
						<option value="Cost" <?= old('tipe') == 'Cost' ? 'selected' : '' ?>>Cost</option>
					</select>
					<?php if (session('errors.tipe')): ?><div class="invalid-feedback text-danger"> <?= session('errors.tipe') ?> </div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Cara Penilaian</label>
					<select name="pilihan" class="form-control <?= session('errors.pilihan') ? 'is-invalid' : '' ?>" required>
						<option value="">--Pilih--</option>
						<option value="Langsung" <?= old('pilihan') == 'Langsung' ? 'selected' : '' ?>>Input Langsung</option>
						<option value="Sub Kriteria" <?= old('pilihan') == 'Sub Kriteria' ? 'selected' : '' ?>>Pilih Sub Kriteria</option>
					</select>
					<?php if (session('errors.pilihan')): ?><div class="invalid-feedback text-danger"> <?= session('errors.pilihan') ?> </div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Slogan Kriteria</label>
					<textarea name="slogan" class="form-control <?= session('errors.slogan') ? 'is-invalid' : '' ?>" style="height: 100px;" required><?= old('slogan') ?></textarea>
					<?php if (session('errors.slogan')): ?><div class="invalid-feedback text-danger"> <?= session('errors.slogan') ?> </div><?php endif; ?>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Keterangan Kriteria</label>
					<textarea name="keterangan" class="form-control <?= session('errors.keterangan') ? 'is-invalid' : '' ?>" style="height: 200px;" required><?= old('keterangan') ?></textarea>
					<?php if (session('errors.keterangan')): ?><div class="invalid-feedback text-danger"> <?= session('errors.keterangan') ?> </div><?php endif; ?>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</form>
</div>

<?= view('pages/admin/template/footer') ?>