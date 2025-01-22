<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barangmasuk extends Migration
{
    public function up()
    {
        // Membuat tabel barangmasuk
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'faktur'        => ['type' => 'VARCHAR', 'constraint' => 50],
            'tglfaktur'     => ['type' => 'DATE'],
            'totalharga'    => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barangmasuk');
    }

    public function down()
    {
        $this->forge->dropTable('barangmasuk');
    }
}
