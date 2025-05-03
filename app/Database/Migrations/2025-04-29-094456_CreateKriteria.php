<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'kode_kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique' => true,
                'null' => false,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
            ],
            'tipe' => [
                'type' => 'ENUM',
                'constraint' => ['Benefit', 'Cost'],
                'default' => 'Benefit',
            ],
            'bobot' => [
                'type' => 'FLOAT',
                'null' => true,
                'default' => 0,
            ],
            'pilihan' => [
                'type' => 'ENUM',
                'constraint' => ['Langsung', 'Sub Kriteria'],
                'default' => 'Langsung',
            ],
            'slogan' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 225,
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
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kriteria', true);
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
