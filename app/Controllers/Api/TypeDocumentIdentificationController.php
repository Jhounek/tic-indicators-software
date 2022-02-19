<?php


namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class TypeDocumentIdentificationController extends ResourceController
{

    protected $modelName    = 'App\Models\TypeDocumentIdentification';
    protected $format       = 'json';



    public function index()
    {
        $data = $this->model
        ->select(['id', 'name', 'description'])
        ->asObject()
        ->get()
        ->getResult();
        
        return $this->respond(['status' => 200, 'data' => $data]);
    }

}