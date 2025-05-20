<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUlasan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ulasan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,

            ],
            'id_lapangan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false

            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'ulasan' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id_ulasan');
        $this->forge->addForeignKey('id_lapangan', 'lapangan', 'id_lapangan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ulasan');
    }

    public function down()
    {
        $this->forge->dropTable('ulasan');
    }
}
