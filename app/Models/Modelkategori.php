<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkategori extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kategori_nama'
    ];

    public function cariData($cari)
    {
        return $this->table('kategori')->like('kategori_nama', $cari);
    }
}
