<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRespondedToProductEnquiries extends Migration
{
    public function up()
    {
        // Add the 'responded' column to the 'product_enquiries' table
        $this->forge->addColumn('product_enquiries', [
            'responded' => [
                'type'       => 'BOOLEAN',
                'default'    => 0,
                'null'       => false,
                'after'      => 'message', // Add the column after 'message'
            ],
        ]);
    }

    public function down()
    {
        // Drop the 'responded' column if the migration is rolled back
        $this->forge->dropColumn('product_enquiries', 'responded');
    }
}
