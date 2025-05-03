<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_lapangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'jenis_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addKey('id_foto', true);
        $this->forge->addForeignKey('id_lapangan', 'lapangan', 'id_lapangan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_lapangan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_lapangan');
    }
}
