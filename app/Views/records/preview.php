<?= $this->extend('templates/base') ?>

<?= $this->section('styles') ?>
    <style>
        .document-preview {
            width: 794px; /* A4 size at 96dpi */
            height: 1123px;
            margin: 2rem auto;
            padding: 3rem;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #000;
            border: 1px solid #ccc;
            text-align: justify;
            text-justify: inter-word;
            font-style: italic;
            position: relative;
            z-index: 1;
            border: 2px dashed #ccc;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 3rem;
            color: rgba(200, 0, 0, 0.2);
            white-space: nowrap;
            z-index: 0;
            pointer-events: none;
            user-select: none;
        }

        .document-preview h1, .document-preview h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .document-preview .contenido {
            margin-top: 6rem;
        }

        .paragraph {
            text-indent: 50px;
        }

        .card-body ul li {
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>Vista previa<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Vista previa de la constancia</h3>

    <div style="overflow-x: auto;">
        <div class="document-preview">
            <div class="watermark">VISTA PREVIA - SIN VALIDEZ</div>
            <h1 class="mt-3"><?= esc($type['description']); ?></h1>
            <p style="color: red; font-weight: bold; text-align: center;">
                *** Este es un documento de vista previa. No posee validez. ***
            </p>
            <div class="contenido">
                <?php
                switch ($slug) {
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

            <div style="text-align: center; margin-top: 5rem;">
                ___________________________<br>
                <?= esc(get_setting('principal_name')) ?><br>
                C.I. <?= esc(get_setting('principal_ci')) ?><br>
                DIRECTOR (E)<br>
                TELÉFONO<br>
            </div>
            <p style="color: red; font-weight: bold; text-align: center;">
                *** Este es un documento de vista previa. No posee validez. ***
            </p>
        </div>
    </div>

    <div class="alert alert-info text-center w-100 w-sm-100 w-md-75 w-lg-50 mx-auto mt-5">
        <strong>Por favor, revise los siguientes datos antes de confirmar la generación de la constancia.</strong>
    </div>

    <div class="card mx-auto mt-4 mb-4 shadow-sm" style="max-width: 960px;">
        <div class="card-header bg-light">
            <strong>Documento: <?= esc($type['description']); ?></strong>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                    $fieldsBySlug = [
                        'trabajo' => [
                            'primer_nombre' => 'Primer nombre',
                            'segundo_nombre' => 'Segundo nombre',
                            'primer_apellido' => 'Primer apellido',
                            'segundo_apellido' => 'Segundo apellido',
                            'cedula' => 'Cédula',
                            'fecha_ingreso' => 'Fecha de ingreso',
                            'nivel' => 'Nivel',
                            'cargo_funciones' => 'Cargo/Funciones',
                            'codigo_cargo' => 'Código del cargo',
                            'dependencia' => 'Dependencia',
                            'codigo_dependencia' => 'Código dependencia',
                            'sueldo_mensual' => 'Sueldo mensual',
                        ],
                    ];
                    $campos = $fieldsBySlug[$slug] ?? [];
                ?>
                <?php foreach ($campos as $clave => $etiqueta): ?>
                    <?php if (!empty($data[$clave])): ?>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="border-bottom pb-1">
                                <strong><?= esc($etiqueta) ?>:</strong><br>
                                <span><?= esc($data[$clave]) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-2">
        <button type="button" class="btn btn-secondary align-self-center" onclick="window.location.href='<?= site_url('records/create/' . $slug) ?>'">Editar</button>
        <form id="form-store" method="post" action="<?= site_url('records/store') ?>">
            <?= csrf_field(); ?>
            <?php foreach ($data as $key => $value): ?>
                <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Generar PDF y Guardar</button>
        </form>
    </div>

    <?php
    /*
    <form method="post" action="<?= site_url('records/create/' . $slug) ?>">
        <?= csrf_field(); ?>
        <?php foreach ($data as $key => $value): ?>
            <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
        <?php endforeach; ?>
        <button type="submit" class="btn btn-secondary">Editar</button>
    </form>
            <a href="<?= site_url('records/create/' . $slug) ?>" class="btn btn-secondary">Editar</a>
    <form method="get" action="<?= site_url('records/create/' . $slug) ?>">
        <button type="submit" class="btn btn-secondary">Editar2</button>
    </form>
    */ 
    ?>
    <script src="<?= base_url('assets/js/recordCreateConfirmation.js'); ?>"></script>

<?= $this->endSection() ?>