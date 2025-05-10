<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class Profile extends BaseController
{
    protected $helpers = ['form'];
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new Users();
    }

    public function listProfil()
    {
        $data = [
            'user' => getUser()
        ];
        return view('pages/admin/list-profil', $data);
    }
    public function editProfil()
    {
        $data = [
            'user' => getUser()
        ];
        return view('pages/admin/edit-profil', $data);
    }

    public function updateProfil()
    {
        $id = getUser()['id_user']; // Ambil ID dari session
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $konfirmasi = $this->request->getPost('konfirmasi');

        $rules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => "min_length[3]|max_length[100]|is_unique[users.nama,id_user,{$id}]|required",
                'errors' => [
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique' => 'Nama sudah terdaftar',
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "valid_email|is_unique[users.email,id_user,{$id}]|required",
                'errors' => [
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
                    'required' => 'Email tidak boleh kosong'
                ]
            ]
        ];

        if ($password) {
            $rules['password'] = [
                'label' => 'Password',
                'rules' => 'min_length[6]|max_length[255]|required',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter',
                    'max_length' => 'Password maksimal 255 karakter',
                    'required' => 'Password tidak boleh kosong'

                ]
            ];
            $rules['konfirmasi'] = [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password]|required',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama',
                    'required' => 'Password tidak boleh kosong'

                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/edit-profil'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $dataUpdate = [
            'id_user' => $id,
            'nama'    => $this->request->getPost('nama'),
            'email'   => $this->request->getPost('email'),
        ];

        if ($password) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUpdate);
        // Ambil data user terbaru dari DB
        $userBaru = $this->userModel->find($id);

        // Update session login
        session()->set('user', $userBaru);

        return redirect()->to(base_url('admin/list-profil'))->with('success', 'Profil berhasil diperbarui.');
    }
}
