<?php


namespace App\Models;


use CodeIgniter\Model;

class EmployeePeriod extends Model
{
    protected $primaryKey       = 'id';
    protected $table            = 'employee_period';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'id',
        'employee_id',
        'period_id',
        'type_work_id',
        'projected_activity',
        'activity_executed',
        'standard_value',
        'critical_value',
        'total_hours',
        'failures_hours',
        'previous_cases',
        'cumplimiento_actividades',
        'help_table',
        'provision_services',
        'service_levels',
        'next_cases'
    ];


}