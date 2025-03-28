<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Administrador',
            ],
            [
                'name' => 'Usuario',
            ]
        ];

        $this->db->table('roles')->insertBatch($data);
        //
    }
}
