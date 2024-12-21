<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBrandColorSizeToPurchaseItems extends Migration
{
    public function up()
    {
        // Add new columns: brand, color, size to purchase_items table
        $fields = [
            'brand' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'secondary_unit_total',
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'brand',
            ],
            'size' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'color',
            ],
        ];

        $this->forge->addColumn('purchase_items', $fields);
    }

    public function down()
    {
        // Remove the columns if the migration is rolled back
        $this->forge->dropColumn('purchase_items', 'brand');
        $this->forge->dropColumn('purchase_items', 'color');
        $this->forge->dropColumn('purchase_items', 'size');
    }
}
