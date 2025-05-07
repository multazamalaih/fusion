<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Fusion</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets-admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <!-- Font Awesome 6 (Terbaru) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets-admin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets-admin/css/sb-admin-2.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets-admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <script src="<?= base_url('assets-admin/vendor/jquery/jquery.min.js') ?>"></script>
  <link rel="shortcut icon" href="<?= base_url('assets-admin/img/logo.png') ?>" type="image/x-icon">
  <link rel="icon" href="<?= base_url('assets-admin/img/logo.png') ?>" type="image/x-icon">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/admin') ?>">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url('assets-admin/img/logo.png') ?>" alt="Logo Fusion" style="height: 50px;">
        </div>
        <div class="sidebar-brand-text">
          <div style="font-size: 20px; letter-spacing: 5px; line-height: 1;">FUSION</div>
          <div style="font-size: 20px; letter-spacing: 5px; line-height: 1;">DATABASE</div>
        </div>
      </a>


      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/admin') ?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master Data
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-kriteria') ?>">
          <i class="fas fa-fw fa-cube"></i>
          <span>Data Kriteria</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-sub-kriteria') ?>">
          <i class="fas fa-fw fa-cubes"></i>
          <span>Data Sub Kriteria</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-lapangan') ?>">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Lapangan Futsal</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-penilaian') ?>">
          <i class="fas fa-fw fa-edit"></i>
          <span>Data Penilaian</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/perhitungan') ?>">
          <i class="fas fa-fw fa-calculator"></i>
          <span>Data Perhitungan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/hasil') ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Data Hasil Akhir</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master Konten
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-rekomendasi') ?>">
          <i class="fas fa-fw fa-message"></i>
          <span>Data Rekomendasi</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-pesan') ?>">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Data Pesan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-informasi-kontak') ?>">
          <i class="fas fa-fw fa-phone"></i>
          <span>Data Informasi Kontak</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master User
      </div>


      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-user') ?>">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Data User</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list-profil') ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Profil</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn text-success d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
                  <?= esc(getUser()['nama'] ?? 'Admin') ?>
                </span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets-admin/img/user.png') ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('admin/list-profil') ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">