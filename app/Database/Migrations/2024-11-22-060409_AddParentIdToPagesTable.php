<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParentIdToPagesTable extends Migration
{
    public function up()
    {
        $fields = [
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'status', // Position the field after the `status` column
            ],
        ];

        // Add `parent_id` column to the `pages` table
        $this->forge->addColumn('pages', $fields);

        // Add foreign key constraint
        $this->forge->addForeignKey('parent_id', 'pages', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        // Drop the foreign key and the column
        $this->forge->dropForeignKey('pages', 'pages_parent_id_foreign');
        $this->forge->dropColumn('pages', 'parent_id');
    }
}
