<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'parent_group_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('account_groups');
    }

    public function down()
    {
        $this->forge->dropTable('account_groups');
    }
}
