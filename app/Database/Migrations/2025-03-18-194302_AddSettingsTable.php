<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'SERIAL',
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
        //
    }

    public function down()
    {
        $this->forge->dropTable('settings');
        //
    }
}
