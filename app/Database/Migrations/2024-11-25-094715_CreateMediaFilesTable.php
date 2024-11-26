<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaFilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'file_size' => [
                'type' => 'BIGINT',
            ],
            'uploaded_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('media_files');
    }

    public function down()
    {
        $this->forge->dropTable('media_files');
    }
}
