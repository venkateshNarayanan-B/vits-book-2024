<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateDatabaseTables extends Migration
{
    public function up()
    {
        // Modify purchase_items table
        $this->forge->modifyColumn('purchase_items', [
            'tax' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
                'comment' => 'Calculated on amount before discount'
            ]
        ]);

        // Modify stock_items table to add constraints
        $this->forge->modifyColumn('stock_items', [
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
                'default' => 0.00,
                'comment' => 'Ensure rate > 0',
            ],
            'tax_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => false,
                'default' => 0.00,
                'comment' => 'Ensure tax rate between 0 and 100'
            ]
        ]);

        // Add foreign key constraint for stock_item_serial_numbers table
        $this->db->query('
            ALTER TABLE stock_item_serial_numbers
            ADD CONSTRAINT fk_stock_item_id
            FOREIGN KEY (stock_item_id)
            REFERENCES stock_items(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ');

        // Add foreign key constraint for ledgers table
        $this->db->query('
            ALTER TABLE ledgers
            ADD CONSTRAINT fk_group_id
            FOREIGN KEY (group_id)
            REFERENCES account_groups(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ');
    }

    public function down()
    {
        // Revert changes to purchase_items table
        $this->forge->modifyColumn('purchase_items', [
            'tax' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
                'comment' => null
            ]
        ]);

        // Revert changes to stock_items table
        $this->forge->modifyColumn('stock_items', [
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'tax_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => false,
                'default' => 0.00
            ]
        ]);

        // Drop foreign key constraint for stock_item_serial_numbers table
        $this->db->query('ALTER TABLE stock_item_serial_numbers DROP FOREIGN KEY fk_stock_item_id');

        // Drop foreign key constraint for ledgers table
        $this->db->query('ALTER TABLE ledgers DROP FOREIGN KEY fk_group_id');
    }
}
