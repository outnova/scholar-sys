<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    //protected $useAutoIncrement = true;
    //protected $returnType       = 'array';
    //protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['cedula', 'username', 'email', 'password', 'active', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'must_change_password', 'id_role', 'position', 'turn'];

    // Dates
    protected $useTimestamps = true;

    protected $validationRules = [
        'position' => 'in_list[Directivo,Subdirectivo,Coordinador,Administrativo]',
        'turn' => 'in_list[Mañana,Tarde]',
    ];
}
