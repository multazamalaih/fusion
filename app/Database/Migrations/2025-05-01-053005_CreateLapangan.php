<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLapangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lapangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,0',
                'null' => false,
            ],
            'jenis_lantai' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'latitude' => [
                'type' => 'DECIMAL',
                'constraint' => '10,6',
                'null' => false,
            ],
            'longitude' => [
                'type' => 'DECIMAL',
                'constraint' => '10,6',
                'null' => false,
            ],
            'alamat' => [
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

        $this->forge->addKey('id_lapangan', true);
        $this->forge->createTable('lapangan');
    }

    public function down()
    {
        $this->forge->dropTable('lapangan');
    }
}
