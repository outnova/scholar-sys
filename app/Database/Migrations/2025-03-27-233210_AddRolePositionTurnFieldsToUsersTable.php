<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRolePositionTurnFieldsToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'id_role' => [
                'type' => 'INTEGER',
                'null' => false,
                'default' => 2,
            ],
            'position' => [
                'type' => 'VARCHAR',
                'contraint' => 20,
                'default' => 'Administrativo',
                'null' => false,
            ],
            'turn' => [
                'type' => 'VARCHAR',
                'contraint' => 10,
                'default' => 'Mañana',
                'null' => false,
            ],
        ]);

        $this->forge->addForeignKey('id_role', 'roles', 'id', 'CASCADE', 'CASCADE');
        //
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['id_role', 'position', 'turn']);
        //
    }
}
