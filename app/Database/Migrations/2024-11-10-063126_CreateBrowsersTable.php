<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBrowsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'engine' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'browser' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'platform' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'version' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'css_grade' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('browsers');
    }

    public function down()
    {
        $this->forge->dropTable('browsers');
    }
}
