<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LapanganModel;
use App\Models\KontakModel;
use App\Models\UlasanModel;


class InformasiKontak extends BaseController
{
    protected $lapanganModel;
    protected $kontakModel;
    protected $ulasanModel;

    public function __construct()
    {
        $this->lapanganModel = new LapanganModel();
        $this->kontakModel   = new KontakModel();
        $this->ulasanModel   = new UlasanModel();
    }
    public function listInformasiKontak()
    {
        $kontak = $this->kontakModel->first();
        $ulasan = $this->ulasanModel->orderBy('nama', 'ASC')->findAll();
        $lapangan = $this->lapanganModel->orderBy('nama', 'ASC')->findAll();
        $namaLapanganMap = [];
        foreach ($lapangan as $l) {
            $namaLapanganMap[$l['id_lapangan']] = $l['nama'];
        }
        return view('pages/admin/list-informasi-kontak', [
            'kontak'           => $kontak,
            'ulasan'           => $ulasan,
            'lapanganList'     => $lapangan,
            'namaLapanganMap'  => $namaLapanganMap,
        ]);
    }
    public function simpanKontak()
    {
        $rules = [
            'instagram' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Instagram maksimal 255 karakter.',
                    'required' => 'Link Instagram tidak boleh kosong.',
                ]
            ],
            'facebook' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Facebook maksimal 255 karakter.',
                    'required' => 'Link Facebook tidak boleh kosong.',
                ]
            ],
            'twitter' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Twitter maksimal 255 karakter.',
                    'required' => 'Link Twitter tidak boleh kosong.',
                ]
            ],
            'tiktok' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'TikTok maksimal 255 karakter.',
                    'required' => 'Link Tiktok tidak boleh kosong.'
                ]
            ],
            'whatsapp' => [
                'rules' => 'numeric|max_length[20]|required',
                'errors' => [
                    'numeric' => 'WhatsApp harus berupa angka.',
                    'max_length' => 'WhatsApp maksimal 20 karakter.',
                    'required' => 'Nomor WhatsApp tidak boleh kosong.'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'instagram' => $this->request->getPost('instagram'),
            'facebook'  => $this->request->getPost('facebook'),
            'twitter'   => $this->request->getPost('twitter'),
            'tiktok'    => $this->request->getPost('tiktok'),
            'whatsapp'  => $this->request->getPost('whatsapp'),
        ];
        $this->kontakModel->insert($data);
        session()->setFlashdata('success', 'Informasi Kontak berhasil disimpan.');
        return redirect()->to(base_url('admin/list-informasi-kontak'));
    }
    public function updateKontak()
    {
        $rules = [
            'instagram' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Instagram maksimal 255 karakter.',
                    'required' => 'Link Instagram tidak boleh kosong.',
                ]
            ],
            'facebook' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Facebook maksimal 255 karakter.',
                    'required' => 'Link Facebook tidak boleh kosong.',
                ]
            ],
            'twitter' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'Twitter maksimal 255 karakter.',
                    'required' => 'Link Twitter tidak boleh kosong.',
                ]
            ],
            'tiktok' => [
                'rules' => 'max_length[255]|required',
                'errors' => [
                    'max_length' => 'TikTok maksimal 255 karakter.',
                    'required' => 'Link Tiktok tidak boleh kosong.'
                ]
            ],
            'whatsapp' => [
                'rules' => 'numeric|max_length[20]|required',
                'errors' => [
                    'numeric' => 'WhatsApp harus berupa angka.',
                    'max_length' => 'WhatsApp maksimal 20 karakter.',
                    'required' => 'Nomor WhatsApp tidak boleh kosong.'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $id = $this->request->getPost('id_kontak');
        $data = [
            'instagram' => $this->request->getPost('instagram'),
            'facebook'  => $this->request->getPost('facebook'),
            'twitter'   => $this->request->getPost('twitter'),
            'tiktok'    => $this->request->getPost('tiktok'),
            'whatsapp'  => $this->request->getPost('whatsapp'),
        ];
        $this->kontakModel->update($id, $data);
        session()->setFlashdata('success', 'Informasi Kontak berhasil diperbarui.');
        return redirect()->to(base_url('admin/list-informasi-kontak'));
    }
    public function simpanUlasan()
    {
        $rules = [
            'id_lapangan' => [
                'rules' => 'is_not_unique[lapangan.id_lapangan]',
                'errors' => [
                    'is_not_unique' => 'Lapangan Futsal tidak ditemukan.',

                ]
            ],
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]|required',
                'errors' => [
                    'min_length' => 'Nama Manajemen minimal 3 karakter.',
                    'max_length' => 'Nama Manajemen maksimal 100 karakter.',
                    'required' => 'Nama Manajemen tidak boleh kosong.',

                ]
            ],
            'ulasan' => [
                'rules' => 'min_length[10]|required',
                'errors' => [
                    'min_length' => 'Ulasan Minimal 10 karakter.',
                    'required' => 'Ulasan Manajemen maksimal 100 karakter.',

                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_lapangan' => $this->request->getPost('id_lapangan'),
            'nama'        => $this->request->getPost('nama'),
            'ulasan'      => $this->request->getPost('ulasan'),
        ];

        $this->ulasanModel->insert($data);
        session()->setFlashdata('success', 'Ulasan Manajemen berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-informasi-kontak'));
    }
    public function updateUlasan($id)
    {
        // Validasi
        $rules = [
            'id_lapangan' => [
                'rules' => 'is_not_unique[lapangan.id_lapangan]',
                'errors' => [
                    'is_not_unique' => 'Lapangan tidak valid.',
                ]
            ],
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]|required',
                'errors' => [
                    'min_length' => 'Nama Manajemen minimal 3 karakter.',
                    'max_length' => 'Nama Manajemen maksimal 100 karakter.',
                    'required' => 'Nama Manajemen tidak boleh kosong.',

                ]
            ],
            'ulasan' => [
                'rules' => 'min_length[10]|required',
                'errors' => [
                    'min_length' => 'Ulasan Minimal 10 karakter.',
                    'required' => 'Ulasan Manajemen maksimal 100 karakter.',

                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_lapangan' => $this->request->getPost('id_lapangan'),
            'nama'        => $this->request->getPost('nama'),
            'ulasan'      => $this->request->getPost('ulasan'),
        ];

        $this->ulasanModel->update($id, $data);
        session()->setFlashdata('success', 'Ulasan Manajemen berhasil diperbarui.');
        return redirect()->to(base_url('admin/list-informasi-kontak'));
    }
    public function hapusUlasan($id)
    {
        $ulasan = $this->ulasanModel->find($id);
        if (!$ulasan) {
            session()->setFlashdata('error', 'Data ulasan tidak ditemukan.');
            return redirect()->to(base_url('admin/list-informasi-kontak'));
        }
        $this->ulasanModel->delete($id);
        session()->setFlashdata('success', 'Ulasan Manajemen berhasil dihapus.');
        return redirect()->to(base_url('admin/list-informasi-kontak'));
    }
}
