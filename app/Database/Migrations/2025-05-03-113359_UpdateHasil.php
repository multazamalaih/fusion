<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateHasil extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('hasil', [
            'nilai' => [
                'type' => 'FLOAT',
                'constraint' => '10,5',
            ],
        ]);

        $this->forge->addColumn('hasil', [
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
    }

    public function down()
    {
        $this->forge->dropColumn('hasil', ['created_at', 'updated_at', 'deleted_at']);

        $this->forge->modifyColumn('hasil', [
            'nilai' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
            ],
        ]);
    }
}
