<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteria extends BaseController
{
    protected $subKriteriaModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->subKriteriaModel = new SubKriteriaModel();
        $this->kriteriaModel    = new KriteriaModel();
    }

    public function listSubKriteria()
    {
        $kriteriaList = $this->kriteriaModel
            ->where('pilihan', 'Sub Kriteria')
            ->orderBy('kode_kriteria', 'ASC')
            ->findAll();

        if (empty($kriteriaList)) {
            $data['sub_kriteria'] = null;
        } else {
            $Grouped = [];
            foreach ($kriteriaList as $kriteria) {
                $sub = $this->subKriteriaModel
                    ->where('id_kriteria', $kriteria['id_kriteria'])
                    ->orderBy('nilai', 'DESC')
                    ->findAll();

                $Grouped[$kriteria['id_kriteria']] = [
                    'nama_kriteria' => $kriteria['nama'],
                    'kode_kriteria' => $kriteria['kode_kriteria'],
                    'data' => $sub
                ];
            }
            $data['sub_kriteria'] = $Grouped;
        }

        return view('pages/admin/list-sub-kriteria', $data);
    }

    public function simpanSubKriteria()
    {
        $rules = [
            'id_kriteria' => [
                'rules' => 'is_not_unique[kriteria.id_kriteria]',
                'errors' => [
                    'is_not_unique' => 'Kriteria tidak ditemukan.',
                ]
            ],
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]',
                'errors' => [
                    'min_length' => 'Nama Sub Kriteria minimal 3 karakter.',
                    'max_length' => 'Nama Sub Kriteria maksimal 100 karakter.',
                ]
            ],
            'nilai' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Nilai Sub Kriteria harus berupa angka.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_kriteria = $this->request->getPost('id_kriteria');
        $nama        = $this->request->getPost('nama');
        $nilai       = $this->request->getPost('nilai');

        // Cek apakah kriteria bertipe 'Sub Kriteria'
        $kriteria = $this->kriteriaModel->find($id_kriteria);
        if ($kriteria['pilihan'] !== 'Sub Kriteria') {
            return redirect()->back()->withInput()->with('errors', ['Kriteria harus bertipe Sub Kriteria.']);
        }

        // Cek duplikat nama per kriteria (manual karena is_unique tidak bisa digabung dengan kondisi)
        $duplikat = $this->subKriteriaModel
            ->where('id_kriteria', $id_kriteria)
            ->where('nama', $nama)
            ->first();
        if ($duplikat) {
            return redirect()->back()->withInput()->with('errors', ['Nama Sub Kriteria sudah ada untuk kriteria ini.']);
        }

        $this->subKriteriaModel->insert([
            'id_kriteria' => $id_kriteria,
            'nama'        => $nama,
            'nilai'       => $nilai
        ]);

        session()->setFlashdata('success', 'Sub Kriteria berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-sub-kriteria'));
    }

    public function updateSubKriteria($id)
    {
        $rules = [
            'id_kriteria' => [
                'rules' => 'is_not_unique[kriteria.id_kriteria]',
                'errors' => [
                    'is_not_unique' => 'Kriteria tidak ditemukan.',
                ]
            ],
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]',
                'errors' => [
                    'min_length' => 'Nama Sub Kriteria minimal 3 karakter.',
                    'max_length' => 'Nama Sub Kriteria maksimal 100 karakter.',
                ]
            ],
            'nilai' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Nilai Sub Kriteria harus berupa angka.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id_kriteria = $this->request->getPost('id_kriteria');
        $nama        = $this->request->getPost('nama');
        $nilai       = $this->request->getPost('nilai');

        $kriteria = $this->kriteriaModel->find($id_kriteria);
        if (!$kriteria || $kriteria['pilihan'] !== 'Sub Kriteria') {
            return redirect()->back()->withInput()->with('errors', ['Kriteria tidak valid atau bukan Sub Kriteria.']);
        }

        // Ambil sub-kriteria lama
        $existing = $this->subKriteriaModel->find($id);
        if (!$existing) {
            return redirect()->back()->with('errors', ['Data Sub Kriteria tidak ditemukan.']);
        }

        // Cek duplikat nama jika nama berubah
        if ($existing['nama'] !== $nama) {
            $duplikat = $this->subKriteriaModel
                ->where('id_kriteria', $id_kriteria)
                ->where('nama', $nama)
                ->where('id_sub_kriteria !=', $id)
                ->first();
            if ($duplikat) {
                return redirect()->back()->withInput()->with('errors', ['Nama Sub Kriteria sudah ada untuk kriteria ini.']);
            }
        }

        $this->subKriteriaModel->update($id, [
            'id_kriteria' => $id_kriteria,
            'nama'        => $nama,
            'nilai'       => $nilai
        ]);

        session()->setFlashdata('success', 'Sub Kriteria berhasil diperbarui.');
        return redirect()->to(base_url('admin/list-sub-kriteria'));
    }

    public function hapusSubKriteria($id_sub_kriteria)
    {
        $subKriteria = $this->subKriteriaModel->find($id_sub_kriteria);
        if (!$subKriteria) {
            session()->setFlashdata('error', 'Sub Kriteria tidak ditemukan.');
            return redirect()->to(base_url('admin/list-sub-kriteria'));
        }

        $this->subKriteriaModel->delete($id_sub_kriteria);
        session()->setFlashdata('success', 'Sub Kriteria berhasil dihapus.');
        return redirect()->to(base_url('admin/list-sub-kriteria'));
    }
}
