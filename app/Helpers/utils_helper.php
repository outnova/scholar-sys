<?php

function formatDate($fecha)
{
    if (!$fecha) return '';

    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
    return $fechaObj ? $fechaObj->format('d/m/Y') : $fecha;
}

function literalRecordDate(bool $conFormato = false)
{
    // Array con nombres de meses en español
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];
    
    // Obtener componentes de fecha
    $dia = date('d');
    $mes = $meses[date('n')];
    $anio = date('Y');
    $day_word = ($dia == 1) ? 'día' : 'días';
    
    // Formatear según el parámetro
    if ($conFormato) {
        return "<span class='record-data'>$dia</span> $day_word del mes de <span class='record-data'>$mes</span> de <span class='record-data'>$anio</span>";
    }
    
    return "$dia $day_word del mes de $mes de $anio";
}

function formatCedula($cedula) {
    // Verificar si el formato es válido (V- seguido de números)
    if (preg_match('/^([VE])-?(\d+)$/', $cedula, $matches)) {
        $tipo = $matches[1]; // V o E
        $numero = $matches[2]; // parte numérica
        
        // Agregar puntos cada 3 dígitos desde el final
        $numeroFormateado = number_format((int)$numero, 0, ',', '.');
        
        return $tipo . '-' . $numeroFormateado;
    }
    
    // Si no coincide con el formato esperado, devolver el original
    return $cedula;
}

function formatPhone($telefono) {
    // Verificar si es un número válido (04XX seguido de 7 dígitos)
    if (preg_match('/^(\d{4})(\d{3})(\d{4})$/', $telefono, $matches)) {
        return $matches[1] . '-' . $matches[2] . '-' . $matches[3];
    }
    
    // Si no coincide con el formato esperado, devolver el original
    return $telefono;
}