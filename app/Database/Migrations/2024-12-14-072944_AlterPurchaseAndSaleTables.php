<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPurchaseAndSaleTables extends Migration
{
    public function up()
    {
        // Add vendor_id to purchase_details
        $this->forge->addColumn('purchase_details', [
            'vendor_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'id' // Adjust position if needed
            ],
        ]);

        // Add foreign key for vendor_id
        $this->db->query('ALTER TABLE `purchase_details` ADD CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `ledgers`(`id`) ON DELETE SET NULL ON UPDATE CASCADE');

        // Add customer_id to sale_details
        $this->forge->addColumn('sale_details', [
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'id' // Adjust position if needed
            ],
        ]);

        // Add foreign key for customer_id
        $this->db->query('ALTER TABLE `sale_details` ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `ledgers`(`id`) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        // Drop foreign key and column from purchase_details
        $this->db->query('ALTER TABLE `purchase_details` DROP FOREIGN KEY `fk_vendor_id`');
        $this->forge->dropColumn('purchase_details', 'vendor_id');

        // Drop foreign key and column from sale_details
        $this->db->query('ALTER TABLE `sale_details` DROP FOREIGN KEY `fk_customer_id`');
        $this->forge->dropColumn('sale_details', 'customer_id');
    }
}
