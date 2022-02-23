<?php


namespace App\Models;


use CodeIgniter\Model;

class Employee extends Model
{
    protected $primaryKey       = 'id';
    protected $table            = 'employees';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'role_id',
        'team_id',
        'id',
        'type_document_identification_id',
        'name',
        'description'
    ];


}