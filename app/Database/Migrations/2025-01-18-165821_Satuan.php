<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'satuan_nama' => [
                'type' => 'varchar',
                'constraint' => '50'
            ],
        ]);

        $this->forge->addKey('id');
        $this->forge->createTable('satuan');
    }

    public function down()
    {
        $this->forge->dropTable('satuan');
    }
}
