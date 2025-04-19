<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddEmployeesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
                'unique' => true,
            ],
            'primer_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => false,
            ],
            'segundo_nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'primer_apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => false,
            ],
            'segundo_apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'fecha_ingreso' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'nivel' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'Primaria',
                'null' => false,
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
            'active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP', 
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP', 
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
        //
    }

    public function down()
    {
        $this->forge->dropTable('employees');
        //
    }
}
