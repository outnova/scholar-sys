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
    public function valid_periodo(string $str, ?string &$fields = null, ?array &$data = null): bool
    {
        if (preg_match('/^(20\d{2})-(20\d{2})$/', $str, $match)) {
            return ((int)$match[2] === (int)$match[1] + 1);
        }
        return false;
    }
    public function after_or_equal_fecha_inicio(string $str, ?string &$fields = null, ?array &$data = null): bool
    {
        $fechaInicio = $data[$fields] ?? null;
        $fechaFin = $str;
        
        if (empty($fechaInicio) || empty($fechaFin)) {
            return false;
        }

        $inicio = strtotime($fechaInicio);
        $fin = strtotime($fechaFin);

        return $fin > $inicio;
    }
}