<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsatuan extends Model
{
    protected $table            = 'satuan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'satuan_nama'
    ];
}
