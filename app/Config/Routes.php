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

$routes->get('/hasil-rekomendasi', 'Home::hasilRekomendasi');
$routes->get('/kontak-kami', 'Home::kontakKami');
$routes->get('/detail-lapangan/(:num)', 'Home::detailLapangan/$1');

// admin view
$routes->group('admin', ['filter' => 'checkAdmin'], function ($routes) {
    // $routes->get("/", function () {
    //     echo "Test";
    //     return;
    // });
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('list-kriteria', 'Admin\Kriteria::listKriteria');
    $routes->get('tambah-kriteria', 'Admin\Kriteria::tambahKriteria');
    $routes->post('simpan-kriteria', 'Admin\Kriteria::simpanKriteria');
    $routes->get('detail-kriteria/(:num)', 'Admin\Kriteria::detailKriteria/$1');
    $routes->get('edit-kriteria/(:num)', 'Admin\Kriteria::editKriteria/$1');
    $routes->post('update-kriteria/(:num)', 'Admin\Kriteria::updateKriteria/$1');
    $routes->delete('hapus-kriteria/(:num)', 'Admin\Kriteria::hapusKriteria/$1');
    $routes->get('tambah-bobot', 'Admin\Kriteria::tambahBobot');
    $routes->post('simpan-bobot', 'Admin\Kriteria::simpanBobot');
    $routes->post('cek-konsistensi', 'Admin\Kriteria::cekKonsistensi');
    $routes->get('list-sub-kriteria', 'Admin\SubKriteria::listSubKriteria');
    $routes->post('simpan-sub-kriteria', 'Admin\SubKriteria::simpanSubKriteria');
    $routes->post('update-sub-kriteria/(:num)', 'Admin\SubKriteria::updateSubKriteria/$1');
    $routes->delete('hapus-sub-kriteria/(:num)', 'Admin\SubKriteria::hapusSubKriteria/$1');
    $routes->get('list-lapangan', 'Admin\Lapangan::listLapangan');
    $routes->get('tambah-lapangan', 'Admin\Lapangan::tambahLapangan');
    $routes->post('simpan-lapangan', 'Admin\Lapangan::simpanLapangan');
    $routes->get('detail-lapangan/(:num)', 'Admin\Lapangan::detailLapangan/$1');
    $routes->get('edit-lapangan/(:num)', 'Admin\Lapangan::editLapangan/$1');
    $routes->post('update-lapangan/(:num)', 'Admin\Lapangan::updateLapangan/$1');
    $routes->delete('hapus-lapangan/(:num)', 'Admin\Lapangan::hapusLapangan/$1');
    $routes->get('list-penilaian', 'Admin\Penilaian::listPenilaian');
    $routes->post('simpan-penilaian', 'Admin\Penilaian::simpanPenilaian');
    $routes->post('update-penilaian/(:num)', 'Admin\Penilaian::updatePenilaian/$1');
    $routes->get('perhitungan', 'Admin\Perhitungan::perhitungan');
    $routes->get('hasil', 'Admin\Hasil::hasil');
    $routes->get('cetak', 'Admin\Cetak::cetak');
    $routes->get('list-rekomendasi', 'Admin::listRekomendasi'); //belom
    $routes->get('detail-rekomendasi', 'Admin::detailRekomendasi'); //belom
    $routes->get('list-pesan', 'Admin::listPesan'); //belom
    $routes->get('detail-pesan', 'Admin::detailPesan'); //belom
    $routes->get('list-informasi-kontak', 'Admin\InformasiKontak::listInformasiKontak');
    $routes->post('simpan-kontak', 'Admin\InformasiKontak::simpanKontak');
    $routes->post('update-kontak', 'Admin\InformasiKontak::updateKontak');
    $routes->post('simpan-ulasan', 'Admin\InformasiKontak::simpanUlasan');
    $routes->post('update-ulasan/(:num)', 'Admin\InformasiKontak::updateUlasan/$1');
    $routes->delete('hapus-ulasan/(:num)', 'Admin\InformasiKontak::hapusUlasan/$1');
    $routes->get('list-user', 'Admin\User::listUser');
    $routes->get('tambah-user', 'Admin\User::tambahUser');
    $routes->post('simpan-user', 'Admin\User::simpanUser');
    $routes->delete('hapus-user/(:num)', 'Admin\User::hapusUser/$1');
    $routes->get('edit-user/(:num)', 'Admin\User::editUser/$1');
    $routes->post('update-user/(:num)', 'Admin\User::updateUser/$1');
    $routes->get('list-profil', 'Admin\Profile::listProfil');
    $routes->get('edit-profil', 'Admin\Profile::editProfil');
    $routes->put('update-profil', 'Admin\Profile::updateProfil');
});
