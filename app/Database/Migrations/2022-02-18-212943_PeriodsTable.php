<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeriodsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned'=> true, 'auto_increment' => true],
            'year'          => ['type' => 'VARCHAR', 'constraint' => '25', 'null' => true],
            'monht'         => ['type' => 'VARCHAR', 'constraint' => '25', 'null' => true],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'    => ['type' => 'TIMESTAMP', 'null' => true],
            'deleted_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('periods');
    }

    public function down()
    {
        $this->forge->dropTable('periods');
    }
}
