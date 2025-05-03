<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJamOperasional extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jam_operasional' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_lapangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'hari' => [
                'type' => 'ENUM',
                'constraint' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Tutup', 'Buka'],
                'default' => 'Tutup',
                'null' => false,
            ],
            'jam_buka' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'jam_tutup' => [
                'type' => 'TIME',
                'null' => true,
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
        $this->forge->addKey('id_jam_operasional', true);
        $this->forge->addForeignKey('id_lapangan', 'lapangan', 'id_lapangan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jam_operasional');
    }

    public function down()
    {
        $this->forge->dropTable('jam_operasional');
    }
}
