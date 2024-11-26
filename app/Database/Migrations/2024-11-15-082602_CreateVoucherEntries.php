<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVoucherEntries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'voucher_id' => [
                'type' => 'INT',
            ],
            'ledger_id' => [
                'type' => 'INT',
            ],
            'debit' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
            ],
            'credit' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
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
        $this->forge->addForeignKey('voucher_id', 'vouchers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ledger_id', 'ledgers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('voucher_entries');
    }

    public function down()
    {
        $this->forge->dropTable('voucher_entries');
    }
}
