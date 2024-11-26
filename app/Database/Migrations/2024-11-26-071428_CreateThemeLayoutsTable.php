<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThemeLayoutsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'theme_id'     => ['type' => 'INT'],
            'layout_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'layout_file'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('theme_id', 'themes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('theme_layouts');
    }


    public function down()
    {
        $this->forge->dropTable('theme_layouts');
    }
}
