<?php


namespace App\Controllers\Api;

use App\Traits\ValidationsTrait;
use CodeIgniter\RESTful\ResourceController;

class EmployeePeriodController extends ResourceController
{

    
    use ValidationsTrait;
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


    public function create()
    {
        $input = $this->getRequestInput($this->request);
        $validate = $this->validateRequest($input, [
            'employee_id'                               => 'required|integer',
            'period_id'                                 => 'required|integer',
            'type_work_id'                              => 'required|integer',
            'projected_activity'                        => 'required|max_length[45]|is_unique[employees.identification_number,id]',
            'activity_executed'                         => 'required|max_length[191]',
            'standard_value'                            =>  '', 
            'critical_value'                            =>  '',
        ]);

        if(!$validate) {
            return $this->respondHTTP422();
        }else {
            $json       = $this->request->getJSON();
            $json->id   = $this->model->insert($json);

            return $this->respond(['status' => 201 ,'data' => $json ]);
        }
    }


    public function show($id = null)
    {
    
    }


    public function update($id = null)
    {
    
    }


}