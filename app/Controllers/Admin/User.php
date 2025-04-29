<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Users;

class User extends BaseController
{
    protected $userModel;

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
        $errors = [];

        $nama       = $this->request->getPost('nama');
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        $konfirmasi = $this->request->getPost('konfirmasi');
        $role       = $this->request->getPost('role');

        // Validasi Nama
        if (!$nama) {
            $errors[] = 'Nama tidak boleh kosong';
        } elseif (strlen($nama) < 3) {
            $errors[] = 'Nama minimal 3 karakter';
        } elseif (strlen($nama) > 100) {
            $errors[] = 'Nama maksimal 100 karakter';
        } else {
            $userModel = new Users();
            if ($userModel->where('nama', $nama)->first()) {
                $errors[] = 'Nama sudah terdaftar';
            }
        }

        // Validasi Email
        if (!$email) {
            $errors[] = 'Email tidak boleh kosong';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email tidak valid';
        } else {
            $userModel = new Users();
            if ($userModel->where('email', $email)->first()) {
                $errors[] = 'Email sudah terdaftar';
            }
        }

        // Validasi Password
        if (!$password) {
            $errors[] = 'Password tidak boleh kosong';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password minimal 6 karakter';
        } elseif (strlen($password) > 255) {
            $errors[] = 'Password maksimal 255 karakter';
        }

        // Validasi Konfirmasi
        if (!$konfirmasi) {
            $errors[] = 'Konfirmasi password tidak boleh kosong';
        } elseif ($password !== $konfirmasi) {
            $errors[] = 'Konfirmasi password tidak sama';
        }

        // Validasi Role
        if (!$role) {
            $errors[] = 'Role tidak boleh kosong';
        }

        // Kalau ada error, kembali ke form
        if (!empty($errors)) {
            session()->setFlashdata('errors', $errors);
            return redirect()->to(base_url('admin/tambah-user'))->withInput();
        }

        // Simpan data
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->save([
            'nama'     => $nama,
            'email'    => $email,
            'password' => $passwordHash,
            'role'     => $role,
        ]);

        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-user'));
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
        $errors = [];

        $nama       = $this->request->getPost('nama');
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        $konfirmasi = $this->request->getPost('konfirmasi');
        $role       = $this->request->getPost('role');

        // Validasi Nama
        if (!$nama) {
            $errors[] = 'Nama tidak boleh kosong';
        } elseif (strlen($nama) < 3) {
            $errors[] = 'Nama minimal 3 karakter';
        } elseif (strlen($nama) > 100) {
            $errors[] = 'Nama maksimal 100 karakter';
        } else {
            $userModel = new Users();
            $user = $userModel->where('nama', $nama)->where('id_user !=', $id)->first();
            if ($user) {
                $errors[] = 'Nama sudah terdaftar';
            }
        }

        // Validasi Email
        if (!$email) {
            $errors[] = 'Email tidak boleh kosong';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email tidak valid';
        } else {
            $userModel = new Users();
            $user = $userModel->where('email', $email)->where('id_user !=', $id)->first();
            if ($user) {
                $errors[] = 'Email sudah terdaftar';
            }
        }

        // Validasi Password (opsional saat edit)
        if ($password) {
            if (strlen($password) < 6) {
                $errors[] = 'Password minimal 6 karakter';
            } elseif (strlen($password) > 255) {
                $errors[] = 'Password maksimal 255 karakter';
            }
            if ($password !== $konfirmasi) {
                $errors[] = 'Konfirmasi password tidak sama';
            }
        }

        // Validasi Role
        if (!$role) {
            $errors[] = 'Role tidak boleh kosong';
        }

        // Kalau ada error, kembali ke form
        if (!empty($errors)) {
            session()->setFlashdata('errors', $errors);
            return redirect()->to(base_url('admin/edit-user/' . $id))->withInput();
        }

        // Simpan update data
        $dataUpdate = [
            'id_user' => $id,
            'nama'    => $nama,
            'email'   => $email,
            'role'    => $role,
        ];

        if ($password) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUpdate);

        session()->setFlashdata('success', 'Data berhasil diupdate.');
        return redirect()->to(base_url('admin/list-user'));
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
