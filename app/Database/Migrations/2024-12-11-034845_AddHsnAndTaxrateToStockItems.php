<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHsnAndTaxrateToStockItems extends Migration
{
    public function up()
    {
        // Add new columns to the stock_items table
        $this->forge->addColumn('stock_items', [
            'hsn_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
                'after'      => 'opening_stock',
            ],
            'tax_rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
                'default'    => 0.00,
                'after'      => 'hsn_code',
            ],
        ]);
    }

    public function down()
    {
        // Remove the columns if the migration is rolled back
        $this->forge->dropColumn('stock_items', 'hsn_code');
        $this->forge->dropColumn('stock_items', 'tax_rate');
    }
}
