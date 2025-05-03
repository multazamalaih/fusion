<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hasil' => [
                'type' => 'INT',
                'auto_increment' => true,
                'constraint' => 11
            ],
            'id_lapangan' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'nilai' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
            ],
        ]);
        $this->forge->addPrimaryKey('id_hasil');
        $this->forge->addForeignKey('id_lapangan', 'lapangan', 'id_lapangan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hasil');
    }

    public function down()
    {
        $this->forge->dropTable('hasil');
    }
}
