<?php
// Usar el cintillo real solo en producción
if (ENVIRONMENT === 'production') {
    $imgPath = WRITEPATH . 'private-assets/images/cintillo.png';
} else {
    // En desarrollo y testing, usar el placeholder
    $imgPath = FCPATH . 'assets/images/cintillo-example.png';
}

// Verificar que el archivo exista
if (!is_file($imgPath)) {
    $imgBase64 = ''; // evitar error si no existe
} else {
    $imgBase64 = base64_encode(file_get_contents($imgPath));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }
        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 1rem;
            font-weight: bold;
            font-style: italic;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .paragraph {
            text-indent: 50px;
            margin-bottom: 1rem;
        }
        .firma {
            text-align: center;
            margin-top: 4rem;
            font-weight: bold;
            font-style: italic;
        }
        .contenido {
            font-style: italic;;
        }
    </style>
</head>
<body>
    <?php if (!empty($imgBase64)): ?>
        <img src="data:image/png;base64,<?= $imgBase64 ?>" alt="Cintillo" style="width: 100%; max-width: 100%; height: auto; margin-bottom: 1rem;">
    <?php else: ?>
        <p style="color: red;">Cintillo no disponible</p>
    <?php endif; ?>

    <h1><?= esc($type['description']); ?></h1>

    <div class="contenido">
        <?php
        switch ($type['slug']) {
            case 'trabajo':
                echo view('records/previews/trabajo', ['data' => $data]);
                break;

            case 'constancia-estudio':
                echo view('records/previews/constancia_estudio', ['data' => $data]);
                break;

            case 'constancia-inscripcion':
                echo view('records/previews/constancia_inscripcion', ['data' => $data]);
                break;

            default:
                echo "<p>Tipo de constancia no soportado.</p>";
                break;
        }
        ?>
    </div>

    <div class="firma">
        ___________________________<br>
        <?= esc(get_setting('principal_name')) ?><br>
        C.I. Nº <?= esc(get_setting('principal_ci')) ?><br>
        DIRECTOR (E)
    </div>
</body>
</html>
