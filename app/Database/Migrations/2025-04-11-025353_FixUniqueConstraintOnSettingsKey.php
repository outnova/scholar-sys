<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixUniqueConstraintOnSettingsKey extends Migration
{
    public function up()
    {
        $this->db->query('ALTER TABLE settings ADD CONSTRAINT settings_key_key UNIQUE (key)');
        //
    }

    public function down()
    {
        $this->db->query('ALTER TABLE settings DROP CONSTRAINT IF EXISTS settings_key_key');
        //
    }
}
