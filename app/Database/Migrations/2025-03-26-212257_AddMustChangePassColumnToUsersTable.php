<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMustChangePassColumnToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'must_change_password' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
        ]);
        //
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'must_change_password');
        //
    }
}
