<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMenuTypeAndThemeLocationToMenus extends Migration
{
    public function up()
    {
        // Add new columns to the menus table
        $this->forge->addColumn('menus', [
            'menu_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'Type of the menu (e.g., header, footer, sidebar)',
            ],
            'theme_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'Assigned location for the menu in the theme',
            ],
        ]);
    }

    public function down()
    {
        // Remove the added columns
        $this->forge->dropColumn('menus', 'menu_type');
        $this->forge->dropColumn('menus', 'theme_location');
    }
}
