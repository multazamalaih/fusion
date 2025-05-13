<?= view('pages/admin/template/header') ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-message"></i> Data Rekomendasi</h1>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Rekomendasi</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Jenis Rekomendasi</th>
                        <th>Nama Rekomendasi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $rekomendasi) : ?>
                        <tr align="center">
                            <td><?= $i++; ?></td>
                            <td><?= $rekomendasi['nama'] ?></td>
                            <td><?= $rekomendasi['jenis_rekomendasi'] ?></td>
                            <td><?= $rekomendasi['nama_rekomendasi'] ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('admin/detail-rekomendasi/' . $rekomendasi['id_rekomendasi']) ?>" class="btn btn-info btn-sm"><i class="fa fa-magnifying-glass"></i></a>
                                    <a data-toggle="modal" data-placement="bottom" title="Hapus Data" data-target="#modalHapus" data-hapus-url="<?= base_url('/admin/hapus-rekomendasi/' . $rekomendasi['id_rekomendasi']) ?>" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('pages/admin/template/footer') ?>