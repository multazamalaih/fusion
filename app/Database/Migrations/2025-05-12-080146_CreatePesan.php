<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pesan' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'pesan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pesan', true);
        $this->forge->createTable('pesan');
    }

    public function down()
    {
        $this->forge->dropTable('pesan');
    }
}
