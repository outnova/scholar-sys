<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCurrentCourseFieldRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('records', [
            'current_course' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
        ]);
        //
    }

    public function down()
    {
        $this->forge->dropColumn('records', 'current_course');
        //
    }
}
