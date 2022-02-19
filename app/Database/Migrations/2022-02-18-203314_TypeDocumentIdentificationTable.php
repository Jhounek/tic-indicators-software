<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeDocumentIdentificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned'=> true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '191', 'null' => true],
            'description'   => ['type' => 'VARCHAR', 'constraint' => '191', 'null' => true],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'    => ['type' => 'TIMESTAMP', 'null' => true],
            'deleted_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('type_document_identifications');
    }

    public function down()
    {
        $this->forge->dropTable('type_document_identifications');
    }
}
