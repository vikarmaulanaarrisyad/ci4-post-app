<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldetailbarangmasuk extends Model
{
    protected $table            = 'detail_barangmasuk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'barangmasuk_id',
        'barang_kode',
        'harga_masuk',
        'harga_jual',
        'jumlah',
        'subtotal',
    ];
}
