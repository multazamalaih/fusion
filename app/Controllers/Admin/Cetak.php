<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HasilModel;
use App\Models\LapanganModel;

class Cetak extends BaseController
{
    protected $hasilModel;
    protected $lapanganModel;

    public function __construct()
    {
        $this->hasilModel = new HasilModel();
        $this->lapanganModel = new LapanganModel();
    }

    public function cetak()
    {
        $hasil = $this->hasilModel->orderBy('nilai', 'DESC')->findAll();
        if (empty($hasil)) {
            session()->setFlashdata('errorhasil', 'Tidak ada data untuk dicetak.');
            return redirect()->to(base_url('admin/hasil'));
        }

        $lapanganList = $this->lapanganModel->findAll();
        $namaLapanganMap = [];
        foreach ($lapanganList as $lap) {
            $namaLapanganMap[$lap['id_lapangan']] = $lap['nama'];
        }

        return view('pages/admin/cetak', [
            'hasil' => $hasil,
            'namaLapanganMap' => $namaLapanganMap,
        ]);
    }
}
