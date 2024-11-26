<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBalanceToLedgers extends Migration
{
   // Create a migration: php spark make:migration AddBalanceToLedgers

    public function up()
    {
        $this->forge->addColumn('ledgers', [
            'balance' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
                'default' => 0.00,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('ledgers', 'balance');
    }

}
