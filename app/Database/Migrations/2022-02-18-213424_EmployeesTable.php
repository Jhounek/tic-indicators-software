<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                                => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned'=> true, 'auto_increment' => true],
            'role_id'                           => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => false],
            'team_id'                           => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => false],
            'type_document_identification_id'   => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => false],
            'identification_number'             => ['type' => 'VARCHAR', 'constraint' => '50',  'null' => false],
            'name'                              => ['type' => 'VARCHAR', 'constraint' => '191', 'null' => false],
            'created_at'                        => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'                        => ['type' => 'TIMESTAMP', 'null' => true],
            'deleted_at'                        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_document_identification_id', 'type_document_identifications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employees');

    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
