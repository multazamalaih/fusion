<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $usersModel;
    protected $helpers = ["form"];
    public function __construct()
    {
        $this->usersModel = new Users();
    }
    // view
    public function login()
    {
        return view('pages/auth/login');
    }
    public function register()
    {
        return view('pages/auth/register');
    }
    // proses
    public function loginProses()
    {
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");
        $user = $this->usersModel->where("email", $email)->first();
        if (!$user) {
            return redirect()->to(base_url('/login'))->withInput()->with('errorEmail', 'Email atau password salah')->with('errorPassword', 'Email atau password salah');
        }
        if (!password_verify($password, $user["password"])) {
            return redirect()->to(base_url('/login'))->withInput()->with('errorPassword', 'Email atau password salah')->with('errorEmail', 'Email atau password salah');
        }
        if (!$this->validate([
            'email' => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Email tidak boleh kosong",
                    "valid_email" => "Email tidak valid",
                ],
            ]
        ])) {
            return redirect()->to(base_url('/login'))->withInput();
        }
        $user = [
            "id_user" => $user["id_user"],
            "nama" => $user["nama"],
            "email" => $user["email"],
            "role" => $user["role"],
        ];
        session()->set('user', $user);
        if ($user['role'] === "Admin") {
            return redirect()->to(base_url('/admin/'));
        }
        return redirect()->to(base_url('/'))->with('successLogin', 'Berhasil Login ke Akun');
    }
    public function registerProses()
    {
        $nama = $this->request->getVar("nama");
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");
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
            "password" => [
                "rules" => "required|min_length[6]|max_length[255]",
                "errors" => [
                    "required" => "Password tidak boleh kosong",
                    "min_length" => "Password minimal 6 karakter",
                    "max_length" => "Password maksimal 255 karakter",
                ],
            ],
            "konfirmasi" => [
                "rules" => "required|matches[password]",
                "errors" => [
                    "required" => "Konfirmasi password tidak boleh kosong",
                    "matches" => "Konfirmasi password tidak sama",
                ],
            ],
        ])) {
            return redirect()->to(base_url('/register'))->withInput();
        }
        try {
            $this->usersModel->save([
                "nama" => $nama,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "role" => "User",
            ]);
            return redirect()->to(base_url('/login'))->with('successRegister', 'Berhasil Mendaftar, Silahkan Login');
        } catch (\Exception $e) {
            return redirect()->to(base_url('/register'))->with('errorRegister', 'Gagal Mendaftar');
        }
    }
    public function logoutProses()
    {
        session()->remove('user');
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
