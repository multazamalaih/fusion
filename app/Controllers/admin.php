<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('pages/admin/dashboard');
    }
    public function listKriteria()
    {
        return view('pages/admin/list-kriteria');
    }
    public function tambahKriteria()
    {
        return view('pages/admin/tambah-kriteria');
    }
    public function detailKriteria()
    {
        return view('pages/admin/detail-kriteria');
    }

    public function editKriteria()
    {
        return view('pages/admin/edit-kriteria');
    }
    public function tambahBobot()
    {
        return view('pages/admin/tambah-bobot');
    }
    public function listSubKriteria()
    {
        return view('pages/admin/list-sub-kriteria');
    }
    public function listLapangan()
    {
        return view('pages/admin/list-lapangan');
    }
    public function tambahLapangan()
    {
        return view('pages/admin/tambah-lapangan');
    }
    public function detailLapangan()
    {
        return view('pages/admin/detail-lapangan');
    }
    public function editLapangan()
    {
        return view('pages/admin/edit-lapangan');
    }
    public function listPenilaian()
    {
        return view('pages/admin/list-penilaian');
    }
    public function perhitungan()
    {
        return view('pages/admin/perhitungan');
    }
    public function hasil()
    {
        return view('pages/admin/hasil');
    }
    public function cetak()
    {
        return view('pages/admin/cetak');
    }
    public function listRekomendasi()
    {
        return view('pages/admin/list-rekomendasi');
    }
    public function detailRekomendasi()
    {
        return view('pages/admin/detail-rekomendasi');
    }
    public function listPesan()
    {
        return view('pages/admin/list-pesan');
    }
    public function detailPesan()
    {
        return view('pages/admin/detail-pesan');
    }
    public function listInformasiKontak()
    {
        return view('pages/admin/list-informasi-kontak');
    }
    public function listProfil()
    {
        return view('pages/admin/list-profil');
    }
    public function editProfil()
    {
        return view('pages/admin/edit-profil');
    }
}
