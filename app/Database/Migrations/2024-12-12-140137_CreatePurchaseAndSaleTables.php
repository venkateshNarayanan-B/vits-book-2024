<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseAndSaleTables extends Migration
{
    public function up()
    {
        // Create purchase_details table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'voucher_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tax_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'discount_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'net_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('voucher_id', 'vouchers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('purchase_details');

        // Create purchase_items table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'purchase_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'stock_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tax' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'total_weight' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'unit_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'average_weight' => [
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('purchase_id', 'purchase_details', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('stock_item_id', 'stock_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('purchase_items');

        // Create sale_details table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'voucher_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tax_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'discount_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'net_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('voucher_id', 'vouchers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sale_details');

        // Create sale_items table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sale_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'stock_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tax' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'total_weight' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'unit_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'average_weight' => [
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sale_id', 'sale_details', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('stock_item_id', 'stock_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sale_items');
    }

    public function down()
    {
        $this->forge->dropTable('sale_items');
        $this->forge->dropTable('sale_details');
        $this->forge->dropTable('purchase_items');
        $this->forge->dropTable('purchase_details');
    }
}
