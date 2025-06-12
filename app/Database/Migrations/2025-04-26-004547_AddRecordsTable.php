<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',
            ],
            'type_id' => [
                'type' => 'INTEGER',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'default' => 'Emitida',
            ],
            'subject' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 256,
                'null' => true,
            ],
            'observations' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'anulled_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'employee_id' => [
                'type' => 'INTEGER',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INTEGER',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'INTEGER',
                'null' => true,
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'position_code' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'dependence' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'dependence_code' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'salary' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'target_pn' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'target_sn' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'target_pa' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'target_sa' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'grade' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'level' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'scholar_period' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'student_conduct' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'repre_pn' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'repre_sn' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'repre_pa' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'repre_sa' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'repre_cedula' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'student_age' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true, 
            ],
            'birth_city' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'birth_state' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'target_school' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
         ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('type_id', 'records_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('records');
        //
    }

    public function down()
    {
        $this->forge->dropTable('records');
        //
    }
}