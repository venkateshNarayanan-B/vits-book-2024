<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBrandColorSizeToStockItems extends Migration
{
    public function up()
    {
        $this->forge->addColumn('stock_items', [
            'brand' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'tax_rate',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'brand',
            ],
            'size' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'color',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('stock_items', 'brand');
        $this->forge->dropColumn('stock_items', 'color');
        $this->forge->dropColumn('stock_items', 'size');
    }
}
