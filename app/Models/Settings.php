<?php

namespace App\Models;

use CodeIgniter\Model;

class Settings extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['key', 'value'];

    //get a value from setting
    public function getSetting($key, $default = null) {
        $setting = $this->where('key', $key)->first();
        return $setting ? $setting['value'] : $default;
    }

    //save or update a setting
    public function setSetting($key, $value) {
        $existing = $this->where('key', $key)->first();
        if($existing) {
            $this->update($existing['id'], ['value' => $value]);
        } else {
            $this->insert(['key' => $key, 'value' => $value]);
        }
    }
}
