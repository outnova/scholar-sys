<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'cedula' => 'V-99999999',
            'username' => 'admin',
            'email'    => 'example@domain.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'active' => 1,
        ];

        // Simple Queries
        //$this->db->query('INSERT INTO users (cedula, username, email, password, active) VALUES(:cedula:, :username:, :email:, :password:, :active:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
        //
    }
}