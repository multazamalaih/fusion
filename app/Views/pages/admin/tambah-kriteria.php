<?php
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
	<a href="list-kriteria.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data Kriteria</h6>
	</div>

	<form action="tambah-kriteria.php" method="post">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Kode Kriteria</label>
					<input autocomplete="off" type="text" name="kode" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama Kriteria</label>
					<input autocomplete="off" type="text" name="nama" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Tipe Kriteria</label>
					<select name="type" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="Benefit">Benefit</option>
						<option value="Cost">Cost</option>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Cara Penilaian</label>
					<select name="ada_pilihan" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="0">Inputan Langsung</option>
						<option value="1">Pilihan Sub Kriteria</option>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Slogan Kriteria</label>
					<textarea autocomplete="off" name="slogan" required class="form-control" style="height: 100px; text-align: left; vertical-align: top; word-break: break-word; overflow-wrap: break-word;"></textarea>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Keterangan Kriteria</label>
					<textarea autocomplete="off" name="keterangan" required class="form-control" style="height: 200px; text-align: left; vertical-align: top; word-break: break-word; overflow-wrap: break-word;"></textarea>
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