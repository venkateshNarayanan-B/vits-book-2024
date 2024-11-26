<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRememberTokensTable extends Migration
{
    public function up()
    {
        // Create the remember_tokens table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'expires_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                //'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('remember_tokens');
    }

    public function down()
    {
        // Drop the remember_tokens table
        $this->forge->dropTable('remember_tokens', true);
    }
}
