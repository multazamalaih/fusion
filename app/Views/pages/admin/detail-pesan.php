<?php
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-envelope"></i> Data Pesan</h1>
    <a href="list-pesan.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-magnifying-glass"></i> Detail Data Pesan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="w-50">Nama User</td>
                    <td class="font-weight-bold w-50">User</td>
                </tr>
                <tr>
                    <td class="w-50">Email</td>
                    <td class="font-weight-bold w-50">User@gmail.com</td>
                </tr>
                <tr>
                    <td class="w-50">Pesan</td>
                    <td class="font-weight-bold w-50" align="justify">Tolong ditingkatkan lagi websitenya dengan menambahkan beberapa fitur seperti dapat menemukan teman/tim untuk sparing.</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <a type="delete" class="btn btn-danger" href="hapus-pesan.php" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fa fa-trash"></i> Hapus</a>
    </div>
</div>
<?php
require_once('template/footer.php');
?>