<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Users;

class User extends BaseController
{
    protected $userModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->userModel = new Users();
    }

    public function listUser()
    {
        $data['users'] = $this->userModel->orderBy('nama', 'ASC')->findAll();
        return view('pages/admin/list-user', $data);
    }

    public function tambahUser()
    {
        return view('pages/admin/tambah-user');
    }

    public function simpanUser()
    {
        // Aturan validasi
        $rules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'min_length[3]|max_length[100]|is_unique[users.nama]|required',
                'errors' => [
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                    'is_unique' => 'Nama sudah terdaftar.',
                    'required' => 'Nama tidak boleh kosong.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'valid_email|is_unique[users.email]|required',
                'errors' => [
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.',
                    'required' => 'Email tidak boleh kosong.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'min_length[6]|max_length[255]|required',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter.',
                    'max_length' => 'Password maksimal 255 karakter.',
                    'required' => 'Password tidak boleh kosong.',
                ]
            ],
            'konfirmasi' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password]|required',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama.',
                    'required' => 'Password tidak boleh kosong.',
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong.',
                ]
            ]
        ];

        // Proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data jika valid
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $this->userModel->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => $passwordHash,
            'role'     => $this->request->getPost('role'),
        ]);

        session()->setFlashdata('success', 'User berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-user'));
    }


    public function editUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('admin/list-kriteria'))->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'user' => $user
        ];

        return view('pages/admin/edit-user', $data);
    }

    public function updateUser($id)
    {
        $userLama = $this->userModel->find($id);
        if (!$userLama) {
            return redirect()->to(base_url('admin/list-user'))->with('error', 'User tidak ditemukan.');
        }

        // Aturan validasi
        $rules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => "min_length[3]|max_length[100]|is_unique[users.nama,id_user,{$id}]|required",
                'errors' => [
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique' => 'Nama sudah terdaftar',
                    'required' => 'Nama tidak boleh kosong.',

                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "valid_email|is_unique[users.email,id_user,{$id}]|required",
                'errors' => [
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
                    'required' => 'Email tidak boleh kosong.',

                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong',
                ]
            ]
        ];

        // Tambahkan validasi password hanya jika diisi
        $password = $this->request->getPost('password');
        $konfirmasi = $this->request->getPost('konfirmasi');
        if ($password) {
            $rules['password'] = [
                'label' => 'Password',
                'rules' => 'min_length[6]|max_length[255]|required',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter',
                    'max_length' => 'Password maksimal 255 karakter',
                    'required' => 'Password tidak boleh kosong.',

                ]
            ];
            $rules['konfirmasi'] = [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password]|required',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama',
                    'required' => 'Password tidak boleh kosong.',

                ]
            ];
        }

        // Proses validasi
        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/edit-user/' . $id))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Simpan update
        $dataUpdate = [
            'id_user' => $id,
            'nama'    => $this->request->getPost('nama'),
            'email'   => $this->request->getPost('email'),
            'role'    => $this->request->getPost('role'),
        ];

        if ($password) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUpdate);

        return redirect()->to(base_url('admin/list-user'))->with('success', 'Data berhasil diperbarui.');
    }

    public function hapusUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url('admin/list-user'));
        }

        $this->userModel->delete($id);

        session()->setFlashdata('success', 'User berhasil dihapus.');
        return redirect()->to(base_url('admin/list-user'));
    }
}
