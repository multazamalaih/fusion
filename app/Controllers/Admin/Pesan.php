<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pesan extends BaseController
{
    protected $pesanModel;
    public function __construct()
    {
        $this->pesanModel = new PesanModel();
    }
    public function listPesan()
    {
        $pesan = $this->pesanModel->findAll();
        return view('pages/admin/list-pesan', [
            'pesan' => $pesan,
        ]);
    }
    public function detailPesan($id_pesan)
    {
        $pesan = $this->pesanModel->find($id_pesan);
        if (!$pesan) {
            return redirect()->to(base_url('admin/list-pesan'))->with('error', 'Data Pesan tidak ditemukan.');
        }
        return view('pages/admin/detail-pesan', [
            'pesan' => $pesan,
        ]);
    }
    public function hapusPesan($id_pesan)
    {
        $this->pesanModel->delete($id_pesan);
        return redirect()->to(base_url('/admin/list-pesan'))->with('success', 'Data berhasil dihapus');
    }
}
