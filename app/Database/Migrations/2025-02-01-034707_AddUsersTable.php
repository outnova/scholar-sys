<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddUsersTable extends Migration
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
            'username' => [
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'unique' => true,
            ],
            'email' => [
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR', 
                'constraint' => 255,
            ],
            'active' => [
                'type' => 'TINYINT', 
                'constraint' => 1, 
                'default' => 0,
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
        $this->forge->createTable('users');
        //
    }

    public function down()
    {
        $this->forge->dropTable('users');
        //
    }
}