<?= view('pages/admin/template/header') ?>



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-message"></i> Data Rekomendasi</h1>
    <a href="<?= base_url('admin/list-rekomendasi') ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-magnifying-glass"></i> Detail Data Rekomendasi</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="w-50">Nama User</td>
                    <td class="font-weight-bold w-50"><?= $rekomendasi['nama'] ?></td>
                </tr>
                <tr>
                    <td class="w-50">Jenis Rekomendasi</td>
                    <td class="font-weight-bold w-50"><?= $rekomendasi['jenis_rekomendasi'] ?></td>
                </tr>
                <tr>
                    <td class="w-50">Nama Rekomendasi</td>
                    <td class="font-weight-bold w-50"><?= $rekomendasi['nama_rekomendasi'] ?></td>
                </tr>
                <tr>
                    <td class="w-50">Keterangan</td>
                    <td class="font-weight-bold w-50" align="justify"><?= $rekomendasi['keterangan'] ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <a type="delete" class="btn btn-danger text-white" data-toggle="modal" data-target="#modalHapus" data-hapus-url="<?= base_url('/admin/hapus-rekomendasi' . $rekomendasi['id_rekomendasi']) ?>"><i class="fa fa-trash"></i> Hapus</a>
    </div>
</div>
<?= view('pages/admin/template/footer') ?>