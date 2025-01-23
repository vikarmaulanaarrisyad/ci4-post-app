<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellogin extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id','username','password','level_id','useraktif'
    ];
}
