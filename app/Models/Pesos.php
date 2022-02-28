<?php


namespace App\Models;


use CodeIgniter\Model;

class Peso extends Model
{
    protected $primaryKey       = 'id';
    protected $table            = 'pesos';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'id',
        'employee_id',
        'period_id',
        'cumplimiento_actividades',
    ];


}