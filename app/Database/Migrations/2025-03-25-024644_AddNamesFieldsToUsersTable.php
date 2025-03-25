<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamesFieldsToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users',[
            'primer_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'segundo_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'primer_apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'segundo_apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
        ]);
        //
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido']);
        //
    }
}
