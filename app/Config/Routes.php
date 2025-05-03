<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

// auth view
$routes->get('/login', 'Auth::login', ['filter' => 'redirectIfAuthenticated']);
$routes->get('/register', 'Auth::register', ['filter' => 'redirectIfAuthenticated']);

// auth proses
$routes->post('/login', 'Auth::loginProses');
$routes->post('/register', 'Auth::registerProses');
$routes->delete('/logout', 'Auth::logoutProses');

// admin view
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/list-kriteria', 'Admin\Kriteria::listKriteria');
$routes->get('/admin/tambah-kriteria', 'Admin\Kriteria::tambahKriteria');
$routes->post('/admin/simpan-kriteria', 'Admin\Kriteria::simpanKriteria');
$routes->get('/admin/detail-kriteria/(:num)', 'Admin\Kriteria::detailKriteria/$1');
$routes->get('admin/edit-kriteria/(:num)', 'Admin\Kriteria::editKriteria/$1');
$routes->post('admin/update-kriteria/(:num)', 'Admin\Kriteria::updateKriteria/$1');
$routes->get('/admin/hapus-kriteria/(:num)', 'Admin\Kriteria::hapusKriteria/$1');
$routes->get('/admin/tambah-bobot', 'Admin\Kriteria::tambahBobot');
$routes->post('/admin/simpan-bobot', 'Admin\Kriteria::simpanBobot');
$routes->post('/admin/cek-konsistensi', 'Admin\Kriteria::cekKonsistensi');
$routes->get('/admin/list-sub-kriteria', 'Admin\SubKriteria::listSubKriteria');
$routes->post('/admin/simpan-sub-kriteria', 'Admin\SubKriteria::simpanSubKriteria');
$routes->post('/admin/update-sub-kriteria/(:num)', 'Admin\SubKriteria::updateSubKriteria/$1');
$routes->get('/admin/hapus-sub-kriteria/(:num)', 'Admin\SubKriteria::hapusSubKriteria/$1');
$routes->get('/admin/list-lapangan', 'Admin\Lapangan::listLapangan');
$routes->get('/admin/tambah-lapangan', 'Admin\Lapangan::tambahLapangan');
$routes->post('/admin/simpan-lapangan', 'Admin\Lapangan::simpanLapangan');
$routes->get('/admin/detail-lapangan/(:num)', 'Admin\Lapangan::detailLapangan/$1');
$routes->get('/admin/edit-lapangan/(:num)', 'Admin\Lapangan::editLapangan/$1');
$routes->post('/admin/update-lapangan/(:num)', 'Admin\Lapangan::updateLapangan/$1');
$routes->get('/admin/hapus-lapangan/(:num)', 'Admin\Lapangan::hapusLapangan/$1');
$routes->get('/admin/list-penilaian', 'Admin\Penilaian::listPenilaian');
$routes->post('/admin/simpan-penilaian', 'Admin\Penilaian::simpanPenilaian');
$routes->post('/admin/update-penilaian/(:num)', 'Admin\Penilaian::updatePenilaian/$1');
$routes->get('/admin/perhitungan', 'Admin\Perhitungan::perhitungan');
$routes->get('/admin/hasil', 'Admin\Hasil::hasil');
$routes->get('/admin/cetak', 'Admin\Cetak::cetak');
$routes->get('/admin/list-rekomendasi', 'Admin::listRekomendasi');
$routes->get('/admin/detail-rekomendasi', 'Admin::detailRekomendasi');
$routes->get('/admin/list-pesan', 'Admin::listPesan');
$routes->get('/admin/detail-pesan', 'Admin::detailPesan');
$routes->get('/admin/list-informasi-kontak', 'Admin::listInformasiKontak');
$routes->get('admin/list-user', 'Admin\User::listUser');
$routes->get('admin/tambah-user', 'Admin\User::tambahUser');
$routes->post('admin/simpan-user', 'Admin\User::simpanUser');
$routes->get('admin/hapus-user/(:num)', 'Admin\User::hapusUser/$1');
$routes->get('admin/edit-user/(:num)', 'Admin\User::editUser/$1');
$routes->post('admin/update-user/(:num)', 'Admin\User::updateUser/$1');
$routes->get('admin/list-user', 'Admin\User::listUser');
$routes->get('/admin/list-profil', 'Admin::listProfil');
$routes->get('/admin/edit-profil', 'Admin::editProfil');
