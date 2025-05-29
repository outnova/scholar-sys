<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordsTypes extends Model
{
    protected $table            = 'records_types';
    protected $primaryKey       = 'id';
 
    protected $allowedFields    = ['name', 'description'];

    protected $validationRules = [
        'category' => 'in_list[estudiante,empleado,representante,tercero]',
    ];
}
