<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVouchers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'voucher_type' => [
                'type' => 'ENUM',
                'constraint' => ['Sales', 'Purchase', 'Receipt', 'Payment', 'Contra', 'Journal'],
            ],
            'reference_no' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('vouchers');
    }

    public function down()
    {
        $this->forge->dropTable('vouchers');
    }
}