<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersRolesTables extends Migration
{
    public function up()
    {
        // Create roles table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');
        
        // Create users table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                //'default' => 'CURRENT_TIMESTAMP',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
        
        // Create user_roles table
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addPrimaryKey(['user_id', 'role_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
        $this->forge->dropTable('users');
        $this->forge->dropTable('roles');
    }
}