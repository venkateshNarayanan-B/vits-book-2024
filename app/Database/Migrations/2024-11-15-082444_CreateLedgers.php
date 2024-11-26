<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLedgers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'ledger_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'group_id' => [
                'type' => 'INT',
            ],
            'opening_balance' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('group_id', 'account_groups', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ledgers');
    }

    public function down()
    {
        $this->forge->dropTable('ledgers');
    }
}
