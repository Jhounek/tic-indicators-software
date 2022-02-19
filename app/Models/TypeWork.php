<?php


namespace App\Models;


use CodeIgniter\Model;

class TypeWork extends Model
{
    protected $primaryKey       = 'id';
    protected $table            = 'type_works';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'id',
        'name',
        'description'
    ];


}