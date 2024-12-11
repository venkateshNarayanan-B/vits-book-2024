<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockItemSerialNumbers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'stock_item_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'serial_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'unique'     => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('stock_item_id', 'stock_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stock_item_serial_numbers');
    }

    public function down()
    {
        $this->forge->dropTable('stock_item_serial_numbers');
    }
}
