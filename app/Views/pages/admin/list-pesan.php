<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-envelope"></i> Data Pesan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Pesan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <tr align="center">
                        <td>1</td>
                        <td>Contoh Nama User</td>
                        <td>Contoh Email</td>
                        <td>Contoh Pesan</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('admin/detail-pesan') ?>" class="btn btn-info btn-sm"><i class="fa fa-magnifying-glass"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('admin/hapus-pesan') ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('pages/admin/template/footer') ?>