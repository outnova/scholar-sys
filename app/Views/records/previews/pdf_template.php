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
            line-height: 2em;
        }
        .firma {
            text-align: center;
            margin-top: 4rem;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
            line-height: 1.3;
        }
        .contenido {
            font-style: italic;
        }

        .record-data {
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .money {
            font-weight: bold;
            font-style: italic;
            text-decoration: underline;
        }

        .rdata-wul {
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
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

            case 'estudio':
                echo view('records/previews/estudio', ['data' => $data]);
                break;

            case 'inscripcion':
                echo view('records/previews/inscripcion', ['data' => $data]);
                break;

            case 'buena-conducta':
                echo view('records/previews/buena-conducta', ['data' => $data]);
                break;

            case 'retiro':
                echo view('records/previews/retiro', ['data' => $data]);
                break;

            case 'retiro-conducta':
                echo view('records/previews/retiro-conducta', ['data' => $data]);
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
        <?= esc(get_setting('principal_position')) ?><br>
        TELÉFONO: <?= formatPhone(get_setting('principal_phone')) ?><br>
    </div>

    <footer style="text-align: center; margin-top: 2rem; position: fixed; left: 0; bottom: 0; width: 100%;">
        <hr style="border: none; height: 8px; background-color: #548dd4; width: 100%;">
        
        <div style="font-size: 12px; font-weight: bold; text-transform: uppercase; margin-bottom: 0.5rem; margin-top: 0.5rem; line-height: 1.3;">
            <?= esc(get_setting('school_footeraddress') ?? 'Dirección de la escuela') ?><br>
            <?= esc(get_setting('school_footercity') ?? 'Ciudad, Estado') ?>
        </div>

        <hr style="border: none; height: 8px; background-color: #548dd4; width: 100%;">
    </footer>
</body>
</html>
