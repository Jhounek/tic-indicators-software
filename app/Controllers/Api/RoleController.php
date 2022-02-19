<?php


namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class RoleController extends ResourceController
{

    protected $modelName    = 'App\Models\Role';
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