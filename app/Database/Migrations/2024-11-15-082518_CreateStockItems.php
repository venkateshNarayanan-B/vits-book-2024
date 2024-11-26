<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'category_id' => [
                'type' => 'INT',
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'opening_stock' => [
                'type' => 'INT',
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
        $this->forge->addForeignKey('category_id', 'stock_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stock_items');
    }

    public function down()
    {
        $this->forge->dropTable('stock_items');
    }
}
