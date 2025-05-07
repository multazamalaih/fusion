<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKriteriaAhp extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_kriteria_ahp' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_kriteria_1' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_kriteria_2' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nilai_1' => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
                'null' => false,
            ],
            'nilai_2' => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
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

        $this->forge->addKey('id_kriteria_ahp', true);
        $this->forge->addForeignKey('id_kriteria_1', 'kriteria', 'id_kriteria', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria_2', 'kriteria', 'id_kriteria', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kriteria_ahp');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria_ahp');
    }
}
