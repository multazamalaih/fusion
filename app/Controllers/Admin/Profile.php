<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $helpers = ['form'];
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
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if (!$this->validate([
            "nama" => [
                "rules" => "required|min_length[3]|max_length[100]|is_unique[users.nama]",
                "errors" => [
                    "required" => "Nama tidak boleh kosong",
                    "min_length" => "Nama minimal 3 karakter",
                    "max_length" => "Nama maksimal 100 karakter",
                    "is_unique" => "Nama sudah terdaftar",
                ],
            ],
            "email" => [
                "rules" => "required|valid_email|is_unique[users.email]",
                "errors" => [
                    "required" => "Email tidak boleh kosong",
                    "valid_email" => "Email tidak valid",
                    "is_unique" => "Email sudah terdaftar",
                ],
            ],
        ])) {
            return redirect()->to(base_url(''));
        }
    }
}
