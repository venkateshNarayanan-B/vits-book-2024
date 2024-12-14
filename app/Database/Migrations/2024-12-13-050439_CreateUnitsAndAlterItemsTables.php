<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnitsAndAlterItemsTables extends Migration
{
    public function up()
    {
        // Create units table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'unit_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'conversion_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'null' => true,
                'default' => 1.0000,
                'comment' => 'Conversion rate to the base unit (default is 1)',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('units');

        // Add primary_unit_id to stock_items table
        $this->forge->addColumn('stock_items', [
            'primary_unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'opening_stock',
            ],
        ]);
        $this->forge->addForeignKey('primary_unit_id', 'units', 'id', 'CASCADE', 'CASCADE');

        // Add secondary_unit_id and secondary_unit_total to purchase_items table
        $this->forge->addColumn('purchase_items', [
            'secondary_unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'secondary_unit_total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'null' => true,
                'comment' => 'Total in secondary unit for reference calculation',
            ],
        ]);
        $this->forge->addForeignKey('secondary_unit_id', 'units', 'id', 'CASCADE', 'CASCADE');

        // Add secondary_unit_id and secondary_unit_total to sale_items table
        $this->forge->addColumn('sale_items', [
            'secondary_unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'secondary_unit_total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'null' => true,
                'comment' => 'Total in secondary unit for reference calculation',
            ],
        ]);
        $this->forge->addForeignKey('secondary_unit_id', 'units', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key and column from sale_items table
        $this->forge->dropForeignKey('sale_items', 'sale_items_secondary_unit_id_foreign');
        $this->forge->dropColumn('sale_items', 'secondary_unit_id');
        $this->forge->dropColumn('sale_items', 'secondary_unit_total');

        // Drop foreign key and column from purchase_items table
        $this->forge->dropForeignKey('purchase_items', 'purchase_items_secondary_unit_id_foreign');
        $this->forge->dropColumn('purchase_items', 'secondary_unit_id');
        $this->forge->dropColumn('purchase_items', 'secondary_unit_total');

        // Drop foreign key and column from stock_items table
        $this->forge->dropForeignKey('stock_items', 'stock_items_primary_unit_id_foreign');
        $this->forge->dropColumn('stock_items', 'primary_unit_id');

        // Drop units table
        $this->forge->dropTable('units');
    }
}
