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
            <a href="<?= site_url('records'); ?>" class="btn btn-secondary mb-2">Atrás</a>
            <h3>Creación de constancia</h3>
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
    </div>
    <script src="<?= base_url('assets/js/showCreateRecordForms.js'); ?>"></script>
<?= $this->endSection() ?>