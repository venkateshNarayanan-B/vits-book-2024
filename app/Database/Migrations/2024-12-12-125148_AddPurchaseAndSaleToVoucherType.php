<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPurchaseAndSaleToVoucherType extends Migration
{
    public function up()
    {
        $this->db->query("
            ALTER TABLE `vouchers` 
            MODIFY `voucher_type` ENUM('Sales', 'Purchase', 'Receipt', 'Payment', 'Contra', 'Journal') NOT NULL;
        ");
    }

    public function down()
    {
        $this->db->query("
            ALTER TABLE `vouchers` 
            MODIFY `voucher_type` ENUM('Sales', 'Receipt', 'Payment', 'Contra', 'Journal') NOT NULL;
        ");
    }
}
