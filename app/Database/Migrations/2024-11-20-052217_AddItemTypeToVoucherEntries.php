<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddItemTypeToVoucherEntries extends Migration
{
    public function up()
    {
        // Add new fields to the voucher_entries table
        $this->forge->addColumn('voucher_entries', [
            'entry_type' => [
                'type' => 'ENUM',
                'constraint' => ['Ledger', 'Service', 'Inventory'],
                'default' => 'Ledger',
            ],
            'related_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Drop the new fields if this migration is rolled back
        $this->forge->dropColumn('voucher_entries', 'related_id');
    }
}
