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
                'slug' => 'constancia-de-estudio',
            ],
            [
                'name' => 'Buena Conducta',
                'description' => 'Certificado de Buena Conducta',
                'category' => 'estudiante',
                'slug' => 'certificado-de-buena-conducta',
            ],
            [
                'name' => 'Inscripción',
                'description' => 'Constancia de Inscripción',
                'category' => 'estudiante',
                'slug' => 'constancia-de-inscripcion',
            ],
            [
                'name' => 'Retiro',
                'description' => 'Constancia de Retiro',
                'category' => 'estudiante',
                'slug' => 'constancia-de-retiro',
            ],
            [
                'name' => 'Aceptación de Cupo',
                'description' => 'Constancia de Aceptación de Cupo',
                'category' => 'representante',
                'slug' => 'constancia-de-aceptacion-de-cupo',
            ],
            [
                'name' => 'Trabajo',
                'description' => 'Constancia de Trabajo',
                'category' => 'empleado',
                'slug' => 'constancia-de-trabajo',
            ],
            [
                'name' => 'Pasantías',
                'description' => 'Constancia de Pasantías',
                'category' => 'tercero',
                'slug' => 'constancia-de-pasantias',
            ],
            [
                'name' => 'Retiro y Buena Conducta',
                'description' => 'Constancia de Retiro y Buena Conducta',
                'category' => 'estudiante',
                'slug' => 'constancia-de-retiro-y-buena-conducta',
            ],
            [
                'name' => 'Aceptación de Recurso',
                'description' => 'Constancia de Aceptación de Recurso',
                'category' => 'tercero',
                'slug' => 'constancia-de-aceptacion-de-recurso',
            ],
        ]; 

        $this->db->table('records_types')->insertBatch($data);
        //
    }
}
