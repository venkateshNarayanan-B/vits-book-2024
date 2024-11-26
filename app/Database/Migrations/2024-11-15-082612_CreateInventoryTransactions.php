<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryTransactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'stock_item_id' => [
                'type' => 'INT',
            ],
            'quantity' => [
                'type' => 'INT',
            ],
            'transaction_type' => [
                'type' => 'ENUM',
                'constraint' => ['Inward', 'Outward'],
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
        $this->forge->addForeignKey('stock_item_id', 'stock_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_transactions');
    }
}
