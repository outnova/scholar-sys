<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RecordTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Estudio',
                'description' => 'Constancia de Estudio',
                'category' => 'estudiante',
                'slug' => 'estudio',
            ],
            [
                'name' => 'Buena Conducta',
                'description' => 'Certificado de Buena Conducta',
                'category' => 'estudiante',
                'slug' => 'buena-conducta',
            ],
            [
                'name' => 'Inscripción',
                'description' => 'Constancia de Inscripción',
                'category' => 'estudiante',
                'slug' => 'inscription',
            ],
            [
                'name' => 'Retiro',
                'description' => 'Constancia de Retiro',
                'category' => 'estudiante',
                'slug' => 'retiro',
            ],
            [
                'name' => 'Aceptación de Cupo',
                'description' => 'Constancia de Aceptación de Cupo',
                'category' => 'representante',
                'slug' => 'aceptacion-cupo',
            ],
            [
                'name' => 'Trabajo',
                'description' => 'Constancia de Trabajo',
                'category' => 'empleado',
                'slug' => 'trabajo',
            ],
            [
                'name' => 'Pasantías',
                'description' => 'Constancia de Pasantías',
                'category' => 'tercero',
                'slug' => 'pasantias',
            ],
            [
                'name' => 'Retiro y Buena Conducta',
                'description' => 'Constancia de Retiro y Buena Conducta',
                'category' => 'estudiante',
                'slug' => 'retiro-conducta',
            ],
            [
                'name' => 'Aceptación de Recurso',
                'description' => 'Constancia de Aceptación de Recurso',
                'category' => 'tercero',
                'slug' => 'aceptacion-recurso',
            ],
        ]; 

        $this->db->table('records_types')->insertBatch($data);
        //
    }
}
