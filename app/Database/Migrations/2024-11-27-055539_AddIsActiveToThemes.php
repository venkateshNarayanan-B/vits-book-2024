<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsActiveToThemes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('themes', [
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('themes', 'is_active');
    }
}
