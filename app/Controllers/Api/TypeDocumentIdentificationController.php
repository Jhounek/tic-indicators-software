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
        ->asObject()
        ->get()
        ->getResult();
        
        return $this->respond(['status' => 200, 'data' => $data]);
    }

}