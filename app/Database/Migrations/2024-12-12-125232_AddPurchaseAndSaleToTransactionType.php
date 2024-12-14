<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPurchaseAndSaleToTransactionType extends Migration
{
    public function up()
    {
        $this->db->query("
            ALTER TABLE `inventory_transactions` 
            MODIFY `transaction_type` ENUM('Inward', 'Outward', 'Purchase', 'Sale') NOT NULL;
        ");
    }

    public function down()
    {
        $this->db->query("
            ALTER TABLE `inventory_transactions` 
            MODIFY `transaction_type` ENUM('Inward', 'Outward') NOT NULL;
        ");
    }
}
