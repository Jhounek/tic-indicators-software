<?php


namespace App\Controllers\Api;

use App\Traits\ValidationsTrait;
use CodeIgniter\RESTful\ResourceController;

class EmployeeController extends ResourceController
{
    use ValidationsTrait;

    protected $modelName    = 'App\Models\Employee';
    protected $format       = 'json';



    public function index()
    {
        $data = $this->model
        ->asObject()
        ->get()
        ->getResult();
        
        return $this->respond(['status' => 200, 'data' => $data]);
    }


    public function create()
    {
        $input = $this->getRequestInput($this->request);
        $validate = $this->validateRequest($input, [
            'role_id'                           => 'required|integer',
            'team_id'                           => 'required|integer',
            'type_document_identification_id'   => 'required|integer',
            'identification_number'             => 'required|max_length[45]|is_unique[employees.identification_number,id]',
            'name'                              => 'required|max_length[191]'
        ]);

        if(!$validate) {
            return $this->respondHTTP422();
        }else {
            $json = $this->request->getJSON();
            $json->id = $this->model->insert($json);

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