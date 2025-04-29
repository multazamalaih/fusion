<?= view('pages/admin/template/header') ?>

<style>
    .hari {
        display: inline-block;
        min-width: 80px;
    }

    .card-img-top {
        width: 100%;
        height: auto;
        max-width: 100%;
        max-height: 100%;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Lapangan Futsal</h1>
    <a href="<?= base_url('admin/list-lapangan') ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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
                    <td class="font-weight-bold w-50">Noel Futsal</td>
                </tr>
                <tr>
                    <td class="w-50">Harga Sewa</td>
                    <td class="font-weight-bold w-50">150000</td>
                </tr>
                <tr>
                    <td class="w-50">Jenis Lantai</td>
                    <td class="font-weight-bold w-50">Interlock</td>
                </tr>
                <tr>
                    <td class="w-50">Nomor Handphone</td>
                    <td class="font-weight-bold w-50">085770483252</td>
                </tr>
                <tr>
                    <td class="w-50">Latitude</td>
                    <td class="font-weight-bold w-50">-6.347004</td>
                </tr>
                <tr>
                    <td class="w-50">Longitude</td>
                    <td class="font-weight-bold w-50">106.7060121</td>
                </tr>
                <tr>
                    <td class="w-50">Alamat</td>
                    <td class="font-weight-bold w-50">Jl. Raya Puspitek No.58, Buaran, Kec. Serpong, Kota Tangerang Selatan, Banten 15316</td>
                </tr>
                <tr>
                    <td class="w-50">Fasilitas Pendukung</td>
                    <td class="font-weight-bold w-50">Papan Skor, Kipas Angin / AC, Loker Barang, Toilet / WC, Mushola, Kantin, Tribun Penonton, Tempat Parkir</td>
                </tr>
                <tr>
                    <td class="w-50" rowspan="7">Jam Operasional</td>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Senin</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Selasa</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Rabu</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Kamis</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Jum'at</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Sabtu</span> 07:00 - 22:00
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-50">
                        <span class="hari">Minggu</span> 07:00 - 22:00
                    </td>
                </tr>
            </table>
        </div>
        <div class="row justify-content-center mt-4">
            <!-- Spacer kiri untuk offset visual di layar besar -->
            <div class="col-1 d-none d-lg-block"></div>

            <!-- Konten utama 10 kolom -->
            <div class="col-10">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                            <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto Lapangan</h6>
                            </div>
                            <div class="card-body p-0">
                                <img src="<?= base_url('admin/img/contoh.png') ?>" alt="Foto Lapangan" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                            <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto Bangku</h6>
                            </div>
                            <div class="card-body p-0">
                                <img src="<?= base_url('admin/img/contoh.png') ?>" alt="Foto Bangku" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                            <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto Toilet</h6>
                            </div>
                            <div class="card-body p-0">
                                <img src="<?= base_url('admin/img/contoh.png') ?>" alt="Foto Toilet" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                            <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto Mushola</h6>
                            </div>
                            <div class="card-body p-0">
                                <img src="<?= base_url('admin/img/contoh.png') ?>" alt="Foto Mushola" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col">
                        <div class="card mb-3" style="height: 400px; border: 1px solid #ddd;">
                            <div class="card-header text-center p-2" style="border-bottom: 1px solid #ccc;">
                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">Foto Parkir</h6>
                            </div>
                            <div class="card-body p-0">
                                <img src="<?= base_url('admin/img/contoh.png') ?>" alt="Foto Parkir" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Spacer kanan untuk offset visual di layar besar -->
            <div class="col-1 d-none d-lg-block"></div>
        </div>
    </div>
    <div class="card-footer text-right">
        <a type="edit" class="btn btn-warning" href="<?= base_url('admin/edit-lapangan') ?>"><i class="fa fa-edit"></i> Edit</a>
        <a type="delete" class="btn btn-danger" href="<?= base_url('hapus/list-lapangan') ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fa fa-trash"></i> Hapus</a>
    </div>
</div>
<?= view('pages/admin/template/footer') ?>