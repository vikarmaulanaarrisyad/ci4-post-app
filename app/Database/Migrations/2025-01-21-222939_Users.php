<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        // Membuat tabel temp_barangmasuk
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'username'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'level'     => ['type' => 'INT', 'constraint' => 11],
            'useraktif'     => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
