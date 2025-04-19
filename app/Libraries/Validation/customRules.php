<?php

namespace App\Libraries\Validation;

class customRules
{
    public function not_future_date(string $str, ?string &$error = null): bool
    {
        $fecha = strtotime($str);
        if ($fecha === false) {
            return false;
        }
        
        return $fecha <= strtotime(date('Y-m-d'));
    }
}