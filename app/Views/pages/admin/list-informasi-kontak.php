<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-phone"></i> Data Informasi Kontak</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Informasi Kontak -->
<div class="card shadow mb-4">
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
                        <?php if (!$kontak): ?>
                            <td colspan="5">Belum ada data Informasi Kontak.</td>
                            <td><a href="#inputKontak" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a></td>
                        <?php else: ?>
                            <td><?= esc($kontak['instagram']) ?></td>
                            <td><?= esc($kontak['facebook']) ?></td>
                            <td><?= esc($kontak['twitter']) ?></td>
                            <td><?= esc($kontak['tiktok']) ?></td>
                            <td><?= esc($kontak['whatsapp']) ?></td>
                            <td><a href="#editKontak" data-toggle="modal" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Input -->
<div class="modal fade" id="inputKontak" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/simpan-kontak') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Input Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php foreach (['instagram', 'facebook', 'twitter', 'tiktok', 'whatsapp'] as $field): ?>
                        <div class="form-group">
                            <label class="font-weight-bold text-capitalize"><?= $field ?></label>
                            <input type="text" name="<?= $field ?>" class="form-control" autocomplete="off">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php if ($kontak): ?>
    <div class="modal fade" id="editKontak" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('admin/update-kontak') ?>" method="post">
                    <input type="hidden" name="id_kontak" value="<?= $kontak['id_kontak'] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Kontak</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <?php foreach (['instagram', 'facebook', 'twitter', 'tiktok', 'whatsapp'] as $field): ?>
                            <div class="form-group">
                                <label class="font-weight-bold text-capitalize"><?= $field ?></label>
                                <input type="text" name="<?= $field ?>" class="form-control" value="<?= esc($kontak[$field]) ?>" autocomplete="off">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fa fa-table"></i> Daftar Ulasan Manajemen
        </h6>
        <a href="#tambahUlasan" data-toggle="modal" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Manajemen</th>
                        <th>Nama Lapangan</th>
                        <th>Ulasan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($ulasan as $row): ?>
                        <tr align="center">
                            <td><?= $no++ ?></td>
                            <td><?= esc($row['nama']) ?></td>
                            <td><?= esc($namaLapanganMap[$row['id_lapangan']] ?? '-') ?></td>
                            <td><?= esc($row['ulasan']) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="#editUlasan<?= $row['id_ulasan'] ?>" data-toggle="modal" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus-ulasan/' . $row['id_ulasan']) ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editUlasan<?= $row['id_ulasan'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?= base_url('admin/update-ulasan/' . $row['id_ulasan']) ?>" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Ulasan</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Manajemen</label>
                                                <input type="text" name="nama" class="form-control" value="<?= esc($row['nama']) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Lapangan</label>
                                                <select name="id_lapangan" class="form-control" required>
                                                    <?php foreach ($lapanganList as $lap): ?>
                                                        <option value="<?= $lap['id_lapangan'] ?>" <?= $row['id_lapangan'] == $lap['id_lapangan'] ? 'selected' : '' ?>>
                                                            <?= esc($lap['nama']) ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Ulasan</label>
                                                <textarea name="ulasan" class="form-control" rows="4" required><?= esc($row['ulasan']) ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Ulasan -->
<div class="modal fade" id="tambahUlasan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/simpan-ulasan') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ulasan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Manajemen</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Lapangan</label>
                        <select name="id_lapangan" class="form-control" required>
                            <option value="">-- Pilih Lapangan --</option>
                            <?php foreach ($lapanganList as $lap): ?>
                                <option value="<?= $lap['id_lapangan'] ?>"><?= esc($lap['nama']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ulasan</label>
                        <textarea name="ulasan" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('pages/admin/template/footer') ?>