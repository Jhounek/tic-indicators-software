<?php


namespace App\Controllers\Api;

use App\Models\Indicator;
use App\Traits\IndicatorTrait;
use App\Traits\ValidationsTrait;
use CodeIgniter\RESTful\ResourceController;

class EmployeePeriodController extends ResourceController
{
    use ValidationsTrait, IndicatorTrait;

    public function __construct()
    {
        $this->indicators = $this->indicators();
    }

    protected $modelName    = 'App\Models\EmployeePeriod';
    protected $format       = 'json';



    public function projects($id = null)
    {   
        $data = $this->model->select([
            'employees.name as employee_name',
            'employees.identification_number',
            'roles.name as role_name',
            'periods.monht',
            'periods.year',
            'projected_activity',
            'activity_executed',
            'standard_value',
            'critical_value'
        ])
        ->where(['type_work_id' => 1])
        ->join('employees', 'employees.id = employee_period.employee_id')
        ->join('periods', 'employee_period.period_id = periods.id')
        ->join('roles', 'employees.role_id = roles.id');

        $employees = [];
        if(!is_null($data) && !is_null($id)) {
            $data = $data
            ->where(['employees.id' => $id])
            ->first();
            $employees = $data;
            $employees['percentage_compliance'] =  number_format($data['activity_executed']/$data['projected_activity'], 2);
            $employees['d']                     =  number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($data['standard_value']  - $data['critical_value']), 2 );
            $employees['c']                     =  number_format(($this->indicators['EST'] - $employees['d'] * $data['standard_value'] )* 0.01, 2 );
            if( ($employees['percentage_compliance']*100) >= $data['critical_value'] && ($employees['percentage_compliance']*100) <= $data['standard_value']) {
                $employees['percentage_obtained']   =  number_format(($employees['c'] + $employees['d'] *   $employees['percentage_compliance']) * 100, 2);
            }else {
                $employees['percentage_obtained']   = 0;
            }
            return json_encode([
                'status'        => 200, 
                'data'          => $employees
            ]);
        }
        //->asObject();

        $i = 0;
        foreach($data->paginate(10) as $item) {
            $employees[$i] = $item;
            $employees[$i]['percentage_compliance'] =  number_format(($item['activity_executed']/$item['projected_activity']), 2);
            $employees[$i]['d']                     =  number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($item['standard_value']  - $item['critical_value']), 2 );
            $employees[$i]['c']                     =  number_format(($this->indicators['EST'] - $employees[$i]['d'] * $item['standard_value'] )* 0.01, 2 );
            if(($employees[$i]['percentage_compliance']*100) >= $item['critical_value'] && ($employees[$i]['percentage_compliance']* 100) <= $item['standard_value']) {
                $employees[$i]['percentage_obtained']   =  number_format(($employees[$i]['c'] + $employees[$i]['d'] *   $employees[$i]['percentage_compliance']) *100, 2);
            }else {
                $employees[$i]['percentage_obtained']  = 0;
            }
            $i++;
        }
        
       
        return json_encode([
            'status'        => 200, 
            'data'          => $employees, 
            'paginate'      => $data->pager->getDetails()
        ]);
    }


    public function helpTable($id = null)
    {   
        $data = $this->model->select([
            'employees.name as employee_name',
            'employees.identification_number',
            'roles.name as role_name',
            'periods.monht',
            'periods.year',
            'projected_activity',
            'activity_executed',
            'standard_value',
            'critical_value'
        ])
        ->where(['type_work_id' => 2])
        ->join('employees', 'employees.id = employee_period.employee_id')
        ->join('periods', 'employee_period.period_id = periods.id')
        ->join('roles', 'employees.role_id = roles.id');
        //->asObject();

        $employees = [];
        if(!is_null($data) && !is_null($id)) {
            $data = $data
            ->where(['employees.id' => $id])
            ->first();
            $employees = $data;
            $employees['percentage_compliance'] =  number_format($data['activity_executed']/$data['projected_activity'], 2);
            $employees['d']                     =  number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($data['standard_value']  - $data['critical_value']), 2 );
            $employees['c']                     =  number_format(($this->indicators['EST'] - $employees['d'] * $data['standard_value'] )* 0.01, 2 );
            if(($employees['percentage_compliance'] * 100) >= $data['critical_value'] && ($employees['percentage_compliance']* 100) <= $data['standard_value']) {
                $employees['percentage_obtained']   =  number_format(($employees['c'] + $employees['d'] *   $employees['percentage_compliance']) * 100, 2);
            }else {
                $employees['percentage_obtained']   = 0;
            }
           
            return json_encode([
                'status'        => 200, 
                'data'          => $employees
            ]);
        }

        $i = 0;
        foreach($data->paginate(10) as $item) {
            $employees[$i] = $item;
            $employees[$i]['percentage_compliance'] =  number_format($item['activity_executed']/$item['projected_activity'], 2);
            $employees[$i]['d']                     =  number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($item['standard_value']  - $item['critical_value']), 2 );
            $employees[$i]['c']                     =  number_format(($this->indicators['EST'] - $employees[$i]['d'] * $item['standard_value'] )* 0.01, 2 );
            if(($employees[$i]['percentage_compliance'] * 100) >= $item['critical_value'] && ($employees[$i]['percentage_compliance']* 100) <= $item['standard_value']) {
                $employees[$i]['percentage_obtained']   =  number_format(($employees[$i]['c'] + $employees[$i]['d'] *   $employees[$i]['percentage_compliance'])*100, 2);
            }else {
                $employees[$i]['percentage_obtained']   = 0;
            }
            $i++;
        }
        
       
        return json_encode([
            'status'        => 200, 
            'data'          => $employees, 
            'paginate'      => $data->pager->getDetails()
        ]);
    }


    public function create()
    {
        $input = $this->getRequestInput($this->request);
        $validate = $this->validateRequest($input, [
            'period_id'                                 => 'required',
            'type_work_id'                              => 'required'
        ]);

        if(!$validate) {
            return $this->respondHTTP422();
        }else {
            $json       = $this->request->getJSON();
            $json->id   = $this->model->insert($json);

            return $this->respond(['status' => 201 ,'data' => $json ]);
        }
    }


    public function provisionServices()
    {


        $data = $this->model->select([
            'periods.monht',
            'periods.year',
            'standard_value',
            'critical_value',
            'total_hours',
            'failures_hours'
        ])
        ->where(['type_work_id' => 4])
        ->join('periods', 'employee_period.period_id = periods.id')
        ->first();


        $provision = $data;
        $provision['achieved_goals'] = number_format((($data['total_hours'] - $data['failures_hours']) / $data['total_hours'])*100, 0);
        $provision['d']              = number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($data['standard_value'] - $data['critical_value']),2);
        $provision['c']              = number_format(($this->indicators['EST'] - $provision['d'] * $data['standard_value']) * 0.01, 2);
        if($provision['achieved_goals'] >= $data['critical_value'] && $provision['achieved_goals'] <= $data['standard_value'] ) {
            $provision['points'] = number_format(($provision['c'] + ($provision['d'] * ('0.'.$provision['achieved_goals']))) * 100 - 4, 2);   
        }else {
            $provision['points'] = 0;
        }
         


        return json_encode(['status' => 201 ,'data' => $provision]);
    }


    public function serviceLevels()
    {
        $data = $this->model->select([
            'periods.monht',
            'periods.year',
            'standard_value',
            'critical_value',
            'total_hours',
            'failures_hours',
            'previous_cases',
            'next_cases'
        ])
        ->where(['type_work_id' => 5])
        ->join('periods', 'employee_period.period_id = periods.id')
        ->first();

        $provision = $data;
        $provision['achieved_goals'] = number_format($data['total_hours'] / ($data['failures_hours'] + $data['previous_cases'] - $data['next_cases']) *100, 0);
        $provision['d']              = number_format(($this->indicators['EST'] - $this->indicators['CRI']) / ($data['standard_value'] - $data['critical_value']),2);
        $provision['c']              = number_format(($this->indicators['EST'] - $provision['d'] * $data['standard_value']) * 0.01, 2);
        if($provision['achieved_goals'] >= $data['critical_value'] && $provision['achieved_goals'] && $data['standard_value']) {
            $provision['points']         = number_format(($provision['c'] + $provision['d'] * ($provision['achieved_goals'] * 0.01)), 2); 
        }else {
            $provision['points']         = 0;
        }
      

        return json_encode(['status' => 201 ,'data' => $provision]);
    }

    public function pesos()
    {

        $provisionServices =  json_decode($this->provisionServices());
        $serviceLevels     =  json_decode($this->serviceLevels());
       
 
        $date = $this->model->select([
            'employees.name as employee_name',
            'employees.identification_number',
            'roles.name as role_name',
            'periods.monht',
            'periods.year',
            'cumplimiento_actividades',
            'help_table',
            'provision_services',
            'service_levels'
        ])
        ->where(['type_work_id' => 3])
        ->join('employees', 'employees.id = employee_period.employee_id')
        ->join('periods', 'employee_period.period_id = periods.id')
        ->join('roles', 'employees.role_id = roles.id');
        
        $i = 0;
        $employees = [];
        foreach($date->paginate(10) as $item) {
            $employees[$i] = $item;
            $employees[$i]['provision_services_total']  = $provisionServices->data->points;
            $employees[$i]['service_levels_total']      = $serviceLevels->data->points;
            $employees[$i]['project_totals']            = json_decode($this->projects())->data[0]->percentage_obtained;
            $employees[$i]['help_table_totals']         = json_decode($this->helpTable())->data[0]->percentage_obtained;
            $employees[$i]['bonuses']                   = number_format((($employees[$i]['project_totals'] * $item['cumplimiento_actividades'])* 0.01) + (($employees[$i]['help_table_totals'] * $item['help_table']) * 0.01)+(($employees[$i]['provision_services_total'] * $item['provision_services']) *0.01) + ( ($employees[$i]['service_levels_total'] * $item['service_levels'])*0.01), 2);
            $i++;
        }
        
       
        return $this->respond([
            'status'        => 200, 
            'data'          => $employees, 
            'paginate'      => $date->pager->getDetails()
        ]);
    }


}