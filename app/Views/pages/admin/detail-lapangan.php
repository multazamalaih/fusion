<?= view('pages/admin/template/header') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
    <a href="javascript:history.back()" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-magnifying-glass"></i> Detail Data Lapangan Futsal</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="w-50">Nama Lapangan</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['nama']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Harga Sewa</td>
                    <td class="font-weight-bold w-50">Rp <?= number_format($lapangan['harga'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td class="w-50">Jenis Lantai</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['jenis_lantai']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Nomor Handphone</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['no_hp']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Latitude</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['latitude']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Longitude</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['longitude']) ?></td>
                </tr>
                <tr>
                    <td class="w-50">Alamat</td>
                    <td class="font-weight-bold w-50"><?= esc($lapangan['alamat']) ?></td>
                </tr>
                <tr>
                    <td>Fasilitas Pendukung</td>
                    <td class="font-weight-bold w-50">
                        <?= esc(implode(', ', $fasilitas)) ?>
                    </td>
                </tr>
                <tr>
                    <td class="w-50" rowspan="<?= count($jamOperasional) + 1 ?>">Jam Operasional</td>
                </tr>
                <?php foreach ($jamOperasional as $hari => $j): ?>
                    <tr>
                        <td class="font-weight-bold w-50">
                            <span class="hari"><?= ucfirst($hari) ?></span>
                            <?php if ($j['status'] === 'Buka'): ?>
                                <?= date('H:i', strtotime($j['jam_buka'])) ?> - <?= date('H:i', strtotime($j['jam_tutup'])) ?>
                            <?php else: ?>
                                <span class="text-muted">Tutup</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-1 d-none d-lg-block"></div>
            <div class="col-10">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
                    <?php foreach ($foto as $f): ?>
                        <?php if (isset($f['jenis_foto'], $f['file'])): ?>
                            <div class="col">
                                <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                                    <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                        <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto <?= esc($f['jenis_foto']) ?></h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <img src="<?= base_url('uploads/' . $f['file']) ?>" alt="Foto <?= esc($f['jenis_foto']) ?>" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-1 d-none d-lg-block"></div>
        </div>
    </div>

    <div class="card-footer text-right">
        <a href="<?= base_url('admin/edit-lapangan/' . $lapangan['id_lapangan']) ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
        <a href="#" data-toggle="modal" data-target="#modalHapus" data-hapus-url="<?= base_url('admin/hapus-lapangan/' . $lapangan['id_lapangan']) ?>"
            class="btn btn-danger" title="Hapus Data">
            <i class="fa fa-trash"></i> Hapus
        </a>
    </div>

    <?= view('pages/admin/template/footer') ?>