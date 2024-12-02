<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToProductCategories extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product_categories', [
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Allows NULL values if no image is uploaded
                'after'      => 'name', // Places the column after the 'name' column
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('product_categories', 'image');
    }
}
