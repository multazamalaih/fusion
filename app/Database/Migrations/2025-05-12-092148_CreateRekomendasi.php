<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRekomendasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rekomendasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'jenis_rekomendasi' => [
                'type' => 'ENUM',
                'constraint' => ['Kriteria', 'Lapangan'],
                'null' => false,
            ],
            'nama_rekomendasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'keterangan' => [
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
            ]
        ]);
        $this->forge->addKey('id_rekomendasi', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rekomendasi');
    }

    public function down()
    {
        $this->forge->dropTable('rekomendasi');
    }
}
