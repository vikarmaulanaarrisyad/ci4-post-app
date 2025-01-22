<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarangmasuk extends Model
{
    protected $table            = 'barangmasuk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'faktur',
        'tglfaktur',
        'totalharga'
    ];

    // Fungsi untuk mengambil data berdasarkan faktur
    public function getDataByFaktur($faktur)
    {
        return $this->where('faktur', $faktur)->findAll();
    }
}
