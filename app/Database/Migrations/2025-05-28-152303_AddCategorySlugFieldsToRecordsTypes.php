<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategorySlugFieldsToRecordsTypes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('records_types', [
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
                'default' => 'estudiante',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'default' => 'constancia-de-estudio',
            ],
        ]);
        //
    }

    public function down()
    {
        $this->forge->dropColumn('records_types', ['category', 'slug']);
        //
    }
}
