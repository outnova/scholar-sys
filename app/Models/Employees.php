<?php

namespace App\Models;

use CodeIgniter\Model;

class Employees extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    /*
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    */
    protected $allowedFields    = ['cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_ingreso', 'nivel', 'position', 'turn', 'active'];

    // Dates
    protected $useTimestamps = true;

    // Validation
    protected $validationRules      = [
        'nivel' => 'in_list[Inicial, Primaria, Media General]',
        'position' => 'in_list[Directivo,Subdirectivo,Coordinador,Administrativo,Docente,Obrero]',
        'turn' => 'in_list[Mañana,Tarde]',
    ];
}
