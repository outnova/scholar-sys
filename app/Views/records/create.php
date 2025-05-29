<?= $this->extend('templates/base') ?>

<?= $this->section('styles') ?>
    <style>
    .wizard-container {
        display: flex;
        overflow: hidden;
        transition: transform 0.5s ease-in-out;
        width: 200%;
    }

    .wizard-step {
        width: 50%;
        flex-shrink: 0;
        padding: 1rem;
    }

    .wizard-wrapper {
        width: 100%;
        overflow: hidden;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }
    </style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <div class="w-100 w-sm-75 w-md-50 mx-auto">
            <h3>Creación de constancia</h3>
            <a href="<?= site_url('records'); ?>" class="btn btn-secondary mb-2">Atrás</a>
            <div class="wizard-wrapper">
                <div class="wizard-container" id="wizardContainer">
                    <!-- Paso 1 -->
                    <div class="wizard-step">
                        <label class="form-label" for="record_type">Tipo de Constancia:</label>
                        <select class="form-select w-50" aria-label="Default select example" name="record_type" id="record_type">
                            <option disabled selected value="">Seleccionar</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= strtolower($type['slug']) ?>"
                                    data-category="<?= esc($type['category']) ?>"
                                    data-type="<?= strtolower($type['slug']) ?>">
                                    <?= esc($type['description']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-primary mt-3" id="nextStep" disabled>Siguiente</button>
                    </div>
                    <!-- Paso 2: Formularios -->
                    <div class="wizard-step">
                        <form id="recordForm" method="post" action="<?= site_url('records/store') ?>">
                            <?php foreach ($types as $type): ?>
                                <div class="form-section" id="form-<?= strtolower($type['slug']) ?>">
                                    <h5><?= esc($type['description']) ?></h5>
                                    <!-- Aquí vendrían los campos específicos del formulario -->
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre del estudiante:</label>
                                        <input type="text" class="form-control" name="nombre" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            <?php endforeach; ?>
                            <button class="btn btn-secondary mt-3" type="button" id="goBack">Atrás</button>
                        </form>
                    </div>               
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/showCreateRecordForms.js'); ?>"></script>
<?= $this->endSection() ?>