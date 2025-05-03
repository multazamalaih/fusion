<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFasilitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_fasilitas' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_lapangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->addKey('id_fasilitas', true);
        $this->forge->addForeignKey('id_lapangan', 'lapangan', 'id_lapangan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('fasilitas_lapangan');
    }

    public function down()
    {
        $this->forge->dropTable('fasilitas_lapangan');
    }
}
