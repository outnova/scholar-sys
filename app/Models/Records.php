<?php

namespace App\Models;

use CodeIgniter\Model;

class Records extends Model
{
    protected $table            = 'records';
    protected $primaryKey       = 'id';
    /*
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    */
    protected $allowedFields    = [
        'status',
        'subject',
        'description',
        'observations',
        'anulled_at',
        'employee_id', 
        'created_by',
        'updated_by',
        'position',
        'position_code',
        'dependence',
        'dependence_code',
        'salary',
        'target_pn',
        'target_sn',
        'target_pa',
        'target_sa',
        'cedula',
        'grade',
        'section',
        'level',
        'scholar_period',
        'student_conduct',
        'repre_pn',
        'repre_sn',
        'repre_pa',
        'repre_sa', 
        'repre_cedula',
        'reason',
        'student_age',
        'birth_city',
        'birth_state',
        'if_attends',
        'start_date',
        'end_date',
        'target_school',
    ];

    // Dates
    protected $useTimestamps = true;
    /*
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    */

    // Validation
    protected $validationRules      = [];
}
