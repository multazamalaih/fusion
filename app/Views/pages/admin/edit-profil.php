<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user"></i> Data Profil</h1>

    <a href="<?= base_url('admin/list-profil') ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<form action="<?= base_url('admin/edit-profil') ?>" method="post">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Profil</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama User</label>
                    <input autocomplete="off" type="text" name="nama" required class="form-control" value="nama lama" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">E-Mail</label>
                    <input autocomplete="off" type="email" name="email" required class="form-control" value="email lama" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Password</label>
                    <input autocomplete="off" type="password" name="password" required class="form-control" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Ulangi Password</label>
                    <input autocomplete="off" type="password" name="password2" required class="form-control" />
                </div>

            </div>
        </div>
        <div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
    </div>
</form>

<?= view('pages/admin/template/footer') ?>