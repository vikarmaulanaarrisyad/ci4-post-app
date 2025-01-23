<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['levelnama' => 'Admin',],
            ['levelnama' => 'Customer',],
        ];

        // Insert data into the 'levels' table
        $this->db->table('level')->insertBatch($data);
    }
}
