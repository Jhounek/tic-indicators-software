<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeePeriodTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                                    => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned'=> true, 'auto_increment' => true],
            'employee_id'                           => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'period_id'                             => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => false],
            'type_work_id'                          => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => false],
            'projected_activity'                    => ['type' => 'INT', 'constraint' => 3,  'null' => true],
            'activity_executed'                     => ['type' => 'INT', 'constraint' => '3', 'null' => true],
            'standard_value'                        => ['type' => 'DECIMAL', 'constraint' => '10,2',  'null' => true],
            'critical_value'                        => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'total_hours'                           => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'failures_hours'                        => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'previous_cases'                        => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'next_cases'                            => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'cumplimiento_actividades'              => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'help_table'                            => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'provision_services'                    => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'service_levels'                        => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'created_at'                            => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'                            => ['type' => 'TIMESTAMP', 'null' => true],
            'deleted_at'                            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('period_id', 'periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_work_id', 'type_works', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('employee_period');
    }

    public function down()
    {
        $this->forge->dropTable('employee_period');
    }
}
