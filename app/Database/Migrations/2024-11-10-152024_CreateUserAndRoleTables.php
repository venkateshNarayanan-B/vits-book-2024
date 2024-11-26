<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAndRoleTables extends Migration
{
    public function up()
    {
        // Create 'roles' table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                //'default' => 'CURRENT_TIMESTAMP',  // Remove this line if it still causes issues
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                //'default' => 'CURRENT_TIMESTAMP', // Remove this line if it still causes issues
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');

        // Create 'users' table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'role_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                //'default' => 'CURRENT_TIMESTAMP', // Same as above, can be removed if issue persists
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                //'default' => 'CURRENT_TIMESTAMP', // Same as above, can be removed if issue persists
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Drop the 'users' and 'roles' tables if we roll back the migration
        $this->forge->dropTable('users');
        $this->forge->dropTable('roles');
    }
}
