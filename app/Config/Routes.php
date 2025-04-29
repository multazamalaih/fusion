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
$routes->get('/admin/list-kriteria', 'Admin::listKriteria');
$routes->get('/admin/tambah-kriteria', 'Admin::tambahKriteria');
$routes->get('/admin/detail-kriteria', 'Admin::detailKriteria');
$routes->get('/admin/edit-kriteria', 'Admin::editKriteria');
$routes->get('/admin/tambah-bobot', 'Admin::tambahBobot');
$routes->get('/admin/list-sub-kriteria', 'Admin::listSubKriteria');
$routes->get('/admin/list-lapangan', 'Admin::listLapangan');
$routes->get('/admin/tambah-lapangan', 'Admin::tambahLapangan');
$routes->get('/admin/detail-lapangan', 'Admin::detailLapangan');
$routes->get('/admin/edit-lapangan', 'Admin::editLapangan');
$routes->get('/admin/list-penilaian', 'Admin::listPenilaian');
$routes->get('/admin/perhitungan', 'Admin::perhitungan');
$routes->get('/admin/hasil', 'Admin::hasil');
$routes->get('/admin/cetak', 'Admin::cetak');
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
