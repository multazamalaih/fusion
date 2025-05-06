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
        $data['users'] = $this->userModel->findAll();
        return view('pages/admin/list-user', $data);
    }

    public function tambahUser()
    {
        return view('pages/admin/tambah-user');
    }

    public function simpanUser()
    {
        // Aturan validasi
        $validationRules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[3]|max_length[100]|is_unique[users.nama]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique' => 'Nama sudah terdaftar',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[255]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 6 karakter',
                    'max_length' => 'Password maksimal 255 karakter',
                ]
            ],
            'konfirmasi' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Konfirmasi password tidak sama',
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

        // Proses validasi
        if (!$this->validate($validationRules)) {
            return redirect()->to(base_url('admin/tambah-user'))
                ->withInput();
        }

        // Simpan data jika valid
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $this->userModel->save([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => $passwordHash,
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to(base_url('admin/list-user'))->with('success', 'Data berhasil ditambahkan.');
    }


    public function editUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
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
        $validationRules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => "required|min_length[3]|max_length[100]|is_unique[users.nama,id_user,{$id}]",
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique' => 'Nama sudah terdaftar',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "required|valid_email|is_unique[users.email,id_user,{$id}]",
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
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
            $validationRules['password'] = [
                'label' => 'Password',
                'rules' => 'min_length[6]|max_length[255]',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter',
                    'max_length' => 'Password maksimal 255 karakter',
                ]
            ];
            $validationRules['konfirmasi'] = [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama',
                ]
            ];
        }

        // Proses validasi
        if (!$this->validate($validationRules)) {
            return redirect()->to(base_url('admin/edit-user/' . $id))
                ->withInput();
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

        return redirect()->to(base_url('admin/list-user'))->with('success', 'Data berhasil diupdate.');
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
