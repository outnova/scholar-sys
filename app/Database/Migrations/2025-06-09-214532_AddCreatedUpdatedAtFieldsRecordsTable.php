<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedUpdatedAtFieldsRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('records', [
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ]
        ]);
        //
    }

    public function down()
    {
        $this->forge->dropColumn('records', ['created_at', 'updated_at']);
        //
    }
}
