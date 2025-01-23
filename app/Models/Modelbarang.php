<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'barang_kode',
        'barang_nama',
        'kategori_id',
        'barang_harga',
        'barang_stok',
        'barang_gambar',
    ];

    public function tampildata()
    {
        return $this->table('barang')
            ->join('kategori', 'barang.kategori_id = kategori.id')
            ->join('satuan', 'barang.satuan_id = satuan.id')
            ->get();
    }
}
