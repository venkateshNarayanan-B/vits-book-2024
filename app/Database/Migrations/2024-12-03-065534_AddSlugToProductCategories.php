<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugToProductCategories extends Migration
{
    public function up()
    {
        $fields = [
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'name', // Adjust the position if necessary
            ],
        ];

        $this->forge->addColumn('product_categories', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('product_categories', 'slug');
    }
}
