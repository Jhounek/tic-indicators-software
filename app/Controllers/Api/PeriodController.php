<?php


namespace App\Controllers\Api;

use App\Traits\ValidationsTrait;
use CodeIgniter\RESTful\ResourceController;

class PeriodController extends ResourceController
{

    use ValidationsTrait;

    protected $modelName    = 'App\Models\Period';
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
            'month'                      => 'required|max_length[45]',
            'year'                       => 'required|max_length[45]',
        ]);

        if(!$validate) {
            return $this->respondHTTP422();
        }else {
            $json = $this->request->getJSON();
            $this->model->save($json);
        }
    }


    public function show($id = null)
    {
    
    }


    public function update($id = null)
    {
    
    }


}