<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        $fields = [
            'role_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'password', // Adjust position as needed
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at',
            ],
        ];

        // Add columns
        $this->forge->addColumn('users', $fields);

        // Add foreign key constraint to role_id
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        // Remove the columns and foreign key
        $this->forge->dropForeignKey('users', 'users_role_id_foreign');
        $this->forge->dropColumn('users', ['role_id', 'updated_at', 'deleted_at']);
    }
}
