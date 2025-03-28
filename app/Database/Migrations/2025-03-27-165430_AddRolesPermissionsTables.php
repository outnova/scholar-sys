<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRolesPermissionsTables extends Migration
{
    public function up()
    {
        //roles table
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',  
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');

        //permissions table
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',  
            ],
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['module', 'action']);
        $this->forge->createTable('permissions');

        //roles-permissions table
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',  
            ],
            'id_role' => [
                'type' => 'INTEGER',
            ],
            'id_permission' => [
                'type' => 'INTEGER',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_role', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_permission', 'permissions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey(['id_rol', 'id_permiso']);
        $this->forge->createTable('roles_permissions');
        //
    }

    public function down()
    {
        $this->forge->dropTable('roles_permissions');
        $this->forge->dropTable('permissions');
        $this->forge->dropTable('roles');
        //
    }
}