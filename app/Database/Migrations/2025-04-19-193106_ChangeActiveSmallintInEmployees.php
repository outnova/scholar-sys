<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeActiveSmallintInEmployees extends Migration
{
    public function up()
    {
        // 1. Quitar el valor por defecto
        $this->db->query("ALTER TABLE employees ALTER COLUMN active DROP DEFAULT");

        // 2. Cambiar el tipo de BOOLEAN a SMALLINT (0 o 1)
        $this->db->query("
            ALTER TABLE employees 
            ALTER COLUMN active TYPE SMALLINT 
            USING (CASE WHEN active THEN 1 ELSE 0 END)
        ");

        // 3. Establecer un nuevo valor por defecto si lo deseas
        $this->db->query("ALTER TABLE employees ALTER COLUMN active SET DEFAULT 1");
        //
    }

    public function down()
    {
        // 1. Quitar el valor por defecto actual
        $this->db->query("ALTER TABLE employees ALTER COLUMN active DROP DEFAULT");

        // 2. Volver a BOOLEAN
        $this->db->query("
            ALTER TABLE employees 
            ALTER COLUMN active TYPE BOOLEAN 
            USING (active = 1)
        ");

        // 3. Restaurar valor por defecto original si lo tenía (por ejemplo, TRUE)
        $this->db->query("ALTER TABLE employees ALTER COLUMN active SET DEFAULT true");
        //
    }
}
