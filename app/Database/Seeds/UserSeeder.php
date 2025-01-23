<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => '$2y$10$ttxP60JGjbpq68tbMwv/k.r3M7GxcIUxHfSc0JW300ohxqbQKb6TK',
                'level_id' => 1,
                'useraktif' => 1
            ],
            [
                'nama' => 'Customer',
                'username' => 'customer',
                'password' => '$2y$10$ttxP60JGjbpq68tbMwv/k.r3M7GxcIUxHfSc0JW300ohxqbQKb6TK',
                'level_id' => 2,
                'useraktif' => 1
            ],
        ];

        // Insert data into the 'levels' table
        $this->db->table('users')->insertBatch($data);
    }
}
