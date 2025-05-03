<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LapanganModel;
use App\Models\HasilModel;

class Hasil extends BaseController
{
    protected $hasilModel;
    protected $lapanganModel;

    public function __construct()
    {
        $this->hasilModel = new HasilModel();
        $this->lapanganModel = new LapanganModel();
    }

    public function hasil()
    {
        $hasil = $this->hasilModel->orderBy('nilai', 'DESC')->findAll();

        if (empty($hasil)) {
            session()->setFlashdata('errorhasil', 'Data hasil akhir belum tersedia. Silakan lakukan perhitungan terlebih dahulu.');
            return redirect()->to(base_url('admin/hasil'));
        }

        $lapanganList = $this->lapanganModel->findAll();
        $namaLapanganMap = [];
        foreach ($lapanganList as $lap) {
            $namaLapanganMap[$lap['id_lapangan']] = $lap['nama'];
        }

        return view('pages/admin/hasil', [
            'hasil' => $hasil,
            'namaLapanganMap' => $namaLapanganMap,
        ]);
    }
}
