<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-phone"></i> Data Informasi Kontak</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Informasi Kontak</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>Instagram</th>
                        <th>Facebook</th>
                        <th>Twitter</th>
                        <th>TikTok</th>
                        <th>WhatsApp</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        <td>Contoh Instagram</td>
                        <td>Contoh FB</td>
                        <td>Contoh Twitter</td>
                        <td>Contoh TikTok</td>
                        <td>Contoh WhatsApp</td>
                        <td>
                            <a data-toggle="modal" href="#editik" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="editik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Informasi Kontak</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="" method="post">
                                    <input type="text" name="informasi-kontak" value="informasi-kontak" hidden>
                                    <div class="modal-body">
                                        <input type="text" name="informasi-kontak" value="informasi-kontak" hidden>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Instagram</label>
                                            <input type="text" autocomplete="off" class="form-control" value="nama ig lama" name="instagram" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Facebook</label>
                                            <input type="text" step="0.001" autocomplete="off" name="facebook" class="form-control" value="nama fb lama" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Twitter</label>
                                            <input type="text" step="0.001" autocomplete="off" name="twitter" class="form-control" value="nama twitter lama" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">TikTok</label>
                                            <input type="text" step="0.001" autocomplete="off" name="tiktok" class="form-control" value="nama tiktok lama" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">WhatsApp</label>
                                            <input type="number" step="0.001" autocomplete="off" name="whatsapp" class="form-control" value="028464747" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                        <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Ulasan Manajemen</h6>
            <a href="#tambah" data-toggle="modal" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
        </div>
    </div>

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Ulasan Manajemen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="text" name="id_ulasan" value="id_ulasan" hidden>
                        <div class="form-group">
                            <label class="font-weight-bold">Pihak Manajemen</label>
                            <input autocomplete="off" type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Lapangan</label>
                            <select name="nilai" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="Noel Futsal">Noel Futsal</option>
                                <option value="Taruna Mandiri">Taruna Mandiri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Ulasan</label>
                            <textarea autocomplete="off" name="keterangan" required class="form-control" style="height: 200px; text-align: left; vertical-align: top; word-break: break-word; overflow-wrap: break-word;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" name="tambah" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Pihak Manajemen</th>
                        <th>Nama Lapangan</th>
                        <th>Ulasan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        <td>1</td>
                        <td>contoh Pihak Manajemen</td>
                        <td>Contoh Nama Lapangan</td>
                        <td>contoh Ulasan</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a data-toggle="modal" title="Edit Data" href="#editulasan" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="list-informasi-kontak.php" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="editulasan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Ulasan Manajemen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <input type="text" name="id_ulasan" hidden>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Pihak Manajemen</label>
                                            <input autocomplete="off" type="text" class="form-control" name="nama" value="nama lama" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Lapangan</label>
                                            <select name="nilai" class="form-control" required>
                                                <option value="">--Pilih--</option>
                                                <option value="Noel Futsal">Noel Futsal</option>
                                                <option value="Taruna Mandiri" selected>Taruna Mandiri</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Ulasan</label>
                                            <textarea autocomplete="off" name="keterangan" required class="form-control"
                                                style="height: 200px; text-align: left; vertical-align: top; word-break: break-word; overflow-wrap: break-word;">keterangan lama</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                            <button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= view('pages/admin/template/footer') ?>