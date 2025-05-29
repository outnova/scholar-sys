<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRecordsTypesNameLength extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('records_types', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
        ]);
        //
    }

    public function down()
    {
        $this->forge->modifyColumn('records_types', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
        ]);
        //
    }
}
