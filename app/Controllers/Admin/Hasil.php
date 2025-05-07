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

        $lapanganList = $this->lapanganModel->findAll();
        $namaLapanganMap = [];
        foreach ($lapanganList as $lap) {
            $namaLapanganMap[$lap['id_lapangan']] = $lap['nama'];
        }

        // ✅ Jika data hasil kosong, tampilkan view dengan flag
        if (empty($hasil)) {
            session()->setFlashdata('errorhasil', 'Data hasil akhir belum tersedia. Silakan lakukan perhitungan terlebih dahulu.');
            return view('pages/admin/hasil', [
                'hasil' => [],
                'namaLapanganMap' => $namaLapanganMap,
                'hasilLengkap' => false
            ]);
        }

        // ✅ Jika data ada, tampilkan view normal
        return view('pages/admin/hasil', [
            'hasil' => $hasil,
            'namaLapanganMap' => $namaLapanganMap,
            'hasilLengkap' => true
        ]);
    }
}
