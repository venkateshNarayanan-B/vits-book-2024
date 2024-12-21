<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPurchaseDetailsTable extends Migration
{
    public function up()
    {
        $fields = [
            'voucher_no' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'after' => 'voucher_id', // Place after `voucher_id`
            ],
            'voucher_discount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'discount_amount', // Place after `discount_amount`
            ],
            'total_expenses' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'voucher_discount', // Place after `voucher_discount`
            ],
            'grand_total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
                'after' => 'total_expenses', // Place after `total_expenses`
            ],
            'payments_made' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'grand_total', // Place after `grand_total`
            ],
            'outstanding_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'payments_made', // Place after `payments_made`
            ],
            'payment_mode' => [
                'type' => 'ENUM',
                'constraint' => ['Cash', 'Credit', 'UPI', 'Bank Transfer', 'Cheque'],
                'default' => 'Credit',
                'after' => 'outstanding_amount', // Place after `outstanding_amount`
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'payment_mode', // Place after `payment_mode`
            ],
            'payment_terms' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'due_date', // Place after `due_date`
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'payment_terms', // Place after `payment_terms`
            ],
        ];

        $this->forge->addColumn('purchase_details', $fields);
    }

    public function down()
    {
        // Remove the newly added fields
        $this->forge->dropColumn('purchase_details', [
            'voucher_no',
            'voucher_discount',
            'total_expenses',
            'grand_total',
            'payments_made',
            'outstanding_amount',
            'payment_mode',
            'due_date',
            'payment_terms',
            'notes',
        ]);
    }
}
