<?php
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-message"></i> Data Rekomendasi</h1>
    <a href="list-rekomendasi.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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
                    <td class="font-weight-bold w-50">User @gmail.com</td>
                </tr>
                <tr>
                    <td class="w-50">Jenis Rekomendasi</td>
                    <td class="font-weight-bold w-50">Kriteria</td>
                </tr>
                <tr>
                    <td class="w-50">Nama Rekomendasi</td>
                    <td class="font-weight-bold w-50">Tipe Lapangan (Indoor / Outdoor)</td>
                </tr>
                <tr>
                    <td class="w-50">Keterangan</td>
                    <td class="font-weight-bold w-50" align="justify">Tipe Lapangan Indoor adalah lapangan yang berada di dalam ruangan tertutup, dirancang untuk memberikan kenyamanan dan perlindungan dari cuaca seperti hujan, panas matahari, atau angin.
                        Tipe Lapangan Outdoor, di sisi lain, adalah lapangan terbuka yang berada di luar ruangan. Lapangan ini mengandalkan cahaya matahari di siang hari dan memberikan pengalaman olahraga yang lebih alami dengan udara segar.</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <a type="delete" class="btn btn-danger" href="hapus-rekomendasi.php" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fa fa-trash"></i> Hapus</a>
    </div>
</div>
<?php
require_once('template/footer.php');
?>