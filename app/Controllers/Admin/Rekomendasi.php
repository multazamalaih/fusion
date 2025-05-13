<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RekomendasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Rekomendasi extends BaseController
{
    protected $rekomendasiModel;
    public function __construct()
    {
        $this->rekomendasiModel = new RekomendasiModel();
    }
    public function listRekomendasi()
    {
        $rekomendasi = $this->rekomendasiModel->join('users', 'rekomendasi.id_user = users.id_user')->findAll();
        return view('pages/admin/list-rekomendasi', [
            'data' => $rekomendasi,
        ]);
    }
    public function detailRekomendasi($id_rekomendasi)
    {
        $rekomendasi = $this->rekomendasiModel->join('users', 'rekomendasi.id_user = users.id_user')->find($id_rekomendasi);
        if (!$rekomendasi) {
            return redirect()->to(base_url('admin/list-rekomendasi'))->with('error', 'Data Rekomendasi tidak ditemukan.');
        }
        return view('pages/admin/detail-rekomendasi', [
            'rekomendasi' => $rekomendasi,
        ]);
    }
    public function hapusRekomendasi($id_rekomendasi)
    {
        $this->rekomendasiModel->delete($id_rekomendasi);
        return redirect()->to(base_url('/admin/list-rekomendasi'));
    }
}
