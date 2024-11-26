<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateVoucherEntries extends Migration
{
    public function up()
    {
        $this->forge->addColumn('voucher_entries', [
            'date' => [
                'type' => 'DATE',
                'null' => false,
                'after' => 'voucher_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('voucher_entries', 'date');
    }
}
