<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'barang_kode' => [
                'type' => 'char',
                'constraint' => 10
            ],
            'barang_nama' => [
                'type' => 'varchar',
                'constraint' => 120
            ],
            'kategori_id' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'satuan_id' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'barang_harga' => [
                'type' => 'double',
            ],
            'barang_stok' => [
                'type' => 'int',
            ],
            'barang_gambar' => [
                'type' => 'varchar',
                'constraint' => 200
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id');
        $this->forge->addForeignKey('satuan_id', 'satuan', 'id');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
