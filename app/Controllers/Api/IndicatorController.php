<?php


namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class IndicatorController extends ResourceController
{

    protected $modelName    = 'App\Models\Indicator';
    protected $format       = 'json';



    public function index()
    {
        $data = $this->model
        ->asObject()
        ->get()
        ->getResult();
        
        return $this->respond(['status' => 200, 'data' => $data]);
    }


    public function new()
    {
    
    }


    public function show($id = null)
    {
    
    }


    public function update($id = null)
    {
    
    }


}