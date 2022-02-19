<?php


namespace App\Models;


use CodeIgniter\Model;

class TypeDocumentIdentification extends Model
{
    protected $primaryKey       = 'id';
    protected $table            = 'type_document_identifications';
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