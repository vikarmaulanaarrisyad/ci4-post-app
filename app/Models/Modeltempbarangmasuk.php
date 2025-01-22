<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeltempbarangmasuk extends Model
{
    protected $table            = 'temp_barangmasuk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'barangmasuk_id',
        'barang_kode',
        'harga_masuk',
        'harga_jual',
        'jumlah',
        'subtotal',
    ];

    public function tampilDataTemp($id)
    {
        return $this->table('temp_barangmasuk')->join('barang', 'barang_kode=barang_kode')->where(['barangmasuk_id' => $id])->get();
    }
}
