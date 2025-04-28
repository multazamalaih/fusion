<?php
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users-cog"></i> Data User</h1>

	<a href="list-user.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<form action="tambah-user.php" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data User</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama User</label>
					<input autocomplete="off" type="text" name="nama" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">E-Mail</label>
					<input autocomplete="off" type="email" name="email" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Password</label>
					<input autocomplete="off" type="password" name="password" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Ulangi Password</label>
					<input autocomplete="off" type="password" name="password2" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Role</label>
					<select name="role" required class="form-control">
						<option value="">--Pilih--</option>
						<option value="1">Administrator</option>
						<option value="2">User</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</div>
</form>
<?php
require_once('template/footer.php');
?>