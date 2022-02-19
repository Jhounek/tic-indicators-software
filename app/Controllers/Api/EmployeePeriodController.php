<?php


namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class EmployeePeriodController extends ResourceController
{

    protected $modelName    = 'App\Models\EmployeePeriod';
    protected $format       = 'json';



    public function index()
    {
        $data = $this->model->asObject();
        
        return $this->respond([
            'status'        => 200, 
            'data'          => $data->paginate(10), 
            'paginate'      => $data->pager->getDetails()
        ]);
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