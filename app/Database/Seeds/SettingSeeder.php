<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('settings')->truncate();

        $data = [
            [
                'key' => 'system_name', 
                'value' => 'Scholar Sys',
            ],
            [
                'key' => 'school_name',
                'value' => 'My School',
            ],
            [
                'key' => 'school_address', 
                'value' => 'Scholar Street',
            ],
            [
                'key' => 'school_phone', 
                'value' => '04261234567',
            ],
            [
                'key' => 'school_email', 
                'value' => 'schoolsys@example.com',
            ],
            [
                'key' => 'principal_name', 
                'value' => 'Pablo Pérez',
            ],
            [
                'key' => 'principal_ci', 
                'value' => '12345678',
            ],
            [
                'key' => 'dea_code', 
                'value' => 'ABC12345678',
            ],
            [
                'key' => 'depend_code', 
                'value' => '00123456789',
            ],
        ];

        // Simple Queries
        //$this->db->query('INSERT INTO settings (key, value) VALUES (:key:, :value:)', $data);

        // Using Query Builder
        $this->db->table('settings')->insertBatch($data);
        //
    }
}
