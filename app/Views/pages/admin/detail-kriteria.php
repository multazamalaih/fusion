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
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-fw fa-magnifying-glass"></i> Detail Data Kriteria
        </h6>
    </div>

    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="w-50">Kode Kriteria</td>
                    <td class="font-weight-bold w-50"><?= esc($kriteria['kode_kriteria']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Nama Kriteria</td>
                    <td class="font-weight-bold w-50"><?= esc($kriteria['nama']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Tipe Kriteria</td>
                    <td class="font-weight-bold w-50"><?= esc($kriteria['tipe']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Cara Penilaian</td>
                    <td class="font-weight-bold w-50"><?= esc($kriteria['pilihan']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Slogan Kriteria</td>
                    <td class="font-weight-bold w-50" align="justify"><?= esc($kriteria['slogan']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Keterangan Kriteria</td>
                    <td class="font-weight-bold w-50 text-justify" style="white-space: normal; word-break: break-word;">
                        <?= esc($kriteria['keterangan']) ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card-footer text-right">
        <a class="btn btn-warning" href="<?= base_url('admin/edit-kriteria/' . $kriteria['id_kriteria']) ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <a href="#" data-toggle="modal" data-target="#modalHapus" data-hapus-url="<?= base_url('admin/hapus-kriteria/' . $kriteria['id_kriteria']) ?>"
            class="btn btn-danger" title="Hapus Data">
            <i class="fa fa-trash"></i> Hapus
        </a>
    </div>
</div>

<?= view('pages/admin/template/footer') ?>