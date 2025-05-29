<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecordsTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'unique' => true,
                'default' => 'Estudio'
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => false,
                'default' => 'Constancia de Estudio'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('records_types');
        //
    }

    public function down()
    {
        $this->forge->dropTable('records_types');
        //
    }
}