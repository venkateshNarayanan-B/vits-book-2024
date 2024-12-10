<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPrimaryGroupsToAccountGroups extends Migration
{
    public function up()
    {
        // Step 1: Insert Primary Groups
        $primaryGroups = [
            ['id' => 1, 'group_name' => 'Assets', 'parent_group_id' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'group_name' => 'Liabilities', 'parent_group_id' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'group_name' => 'Income', 'parent_group_id' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'group_name' => 'Expense', 'parent_group_id' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'group_name' => 'Bank', 'parent_group_id' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('account_groups')->insertBatch($primaryGroups);

        // Step 2: Update Auto-Increment Value
        $this->db->query('ALTER TABLE account_groups AUTO_INCREMENT = 101');
    }

    public function down()
    {
        // Remove Primary Groups
        $this->db->table('account_groups')->whereIn('id', [1, 2, 3, 4, 5])->delete();

        // Reset Auto-Increment Value (optional, depending on your use case)
        $this->db->query('ALTER TABLE account_groups AUTO_INCREMENT = 1');
    }
}
