<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKontak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kontak' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'facebook'   => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'twitter'    =>
            [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'tiktok'     =>
            [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'whatsapp'   =>
            [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'created_at' =>
            [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' =>
            [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id_kontak');
        $this->forge->createTable('kontak');
    }

    public function down()
    {
        $this->forge->dropTable('kontak');
    }
}
