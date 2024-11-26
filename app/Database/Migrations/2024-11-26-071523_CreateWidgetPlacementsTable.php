<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWidgetPlacementsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'layout_id'   => ['type' => 'INT'],
            'widget_id'   => ['type' => 'INT'],
            'position'    => ['type' => 'INT'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('layout_id', 'theme_layouts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('widget_id', 'content_blocks', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('widget_placements');
    }


    public function down()
    {
        $this->forge->dropTable('widget_placements');
    }
}
