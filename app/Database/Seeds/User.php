<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $this->db->table("users")->insert([
            "nama" => "Admin",
            "email" => "admin@fusion.com",
            "password" => password_hash("admin123", PASSWORD_BCRYPT),
            "role" => "Admin",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
}
