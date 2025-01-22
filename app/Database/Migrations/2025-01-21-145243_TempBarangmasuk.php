<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempBarangmasuk extends Migration
{
    public function up()
    {
        // Membuat tabel temp_barangmasuk
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'barangmasuk_id'  => ['type' => 'INT', 'constraint' => 11],
            'barang_kode'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'harga_masuk'     => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'harga_jual'      => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'jumlah'          => ['type' => 'INT', 'constraint' => 11],
            'subtotal'        => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('barangmasuk_id', 'barangmasuk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('temp_barangmasuk');
    }

    public function down()
    {
        $this->forge->dropTable('temp_barangmasuk');
    }
}
