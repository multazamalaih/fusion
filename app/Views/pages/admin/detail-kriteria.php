<?php
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
    <a href="list-kriteria.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-magnifying-glass"></i> Detail Data Kriteria</h6>
    </div>

    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="w-50">Kode Kriteria</td>
                    <td class="font-weight-bold w-50">Kode 1</td>
                </tr>
                <tr>
                    <td class="w-50">Nama Kriteria</td>
                    <td class="font-weight-bold w-50">Harga Sewa</td>
                </tr>
                <tr>
                    <td class="w-50">Tipe Kriteria</td>
                    <td class="font-weight-bold w-50">Cost</td>
                </tr>
                <tr>
                    <td class="w-50">Cara Penilaian</td>
                    <td class="font-weight-bold w-50">Pilihan Sub Kriteria</td>
                </tr>
                <tr>
                    <td class="w-50">Slogan Kriteria</td>
                    <td class="font-weight-bold w-50" align="justify">Semakin murah harga sewa, semakin baik penilaian lapangan di mata pengguna</td>
                </tr>
                <tr>
                    <td class="w-50">Keterangan Kriteria</td>
                    <td class="font-weight-bold w-50" align="justify">
                        Harga sewa adalah biaya yang harus dikeluarkan pengguna untuk menyewa lapangan futsal dalam satuan waktu tertentu (biasanya per jam). Kriteria ini termasuk kategori cost, yang berarti semakin kecil nilainya, semakin baik bagi pengguna. Harga yang murah memberikan keuntungan ekonomis, terutama bagi kelompok pemain yang sering menyewa lapangan. Namun, harga harus tetap seimbang dengan kualitas layanan dan fasilitas yang ditawarkan.
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <div class="card-footer text-right">
        <a type="edit" class="btn btn-warning" href="edit-kriteria.php"><i class="fa fa-edit"></i> Edit</a>
        <a type="delete" class="btn btn-danger" href="hapus-kriteria.php" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fa fa-trash"></i> Hapus</a>
    </div>
</div>

<?php
require_once('template/footer.php');
?>