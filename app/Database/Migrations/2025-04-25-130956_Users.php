<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_user" => [
                "type" => "INT",
                "auto_increment" => true,
                "null" => true,
                "constraint" => 11,
            ],
            "nama" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100,
            ],
            "email" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100,
            ],
            "password" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255,
            ],
            "role" => [
                "type" => "ENUM",
                "constraint" => ["Admin", "User"],
                "default" => "User",
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "deleted_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
        ]);
        $this->forge->addKey("id_user", true);
        $this->forge->addUniqueKey("nama");
        $this->forge->addUniqueKey("email");
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
