<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Aceptación de Recurso<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="w-100 w-sm-75 w-md-50 mx-auto">
        <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $field => $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <a href="<?= site_url('records/create'); ?>" class="btn btn-secondary mb-2">Atrás</a>
        <h3>Constancia de Aceptación de Recurso</h3>
        <form method="post" action="<?= site_url('records/preview') ?>" data-record-type="<?= esc($slug) ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= esc($slug) ?>">
            <div class="mt-4">
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer nombre:</label>
                            <input type="text" class="form-control" name="primer_nombre" id="primerNombre" placeholder="Primer nombre"
                                value="<?= old('primer_nombre') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo nombre:</label>
                            <input type="text" class="form-control" name="segundo_nombre" id="segundoNombre" placeholder="Segundo nombre"
                                value="<?= old('segundo_nombre') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer apellido:</label>
                            <input type="text" class="form-control" name="primer_apellido" id="primerApellido" placeholder="Primer apellido"
                                value="<?= old('primer_apellido') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo apellido:</label>
                            <input type="text" class="form-control" name="segundo_apellido" id="segundoApellido" placeholder="Segundo apellido"
                                value="<?= old('segundo_apellido') ?>">
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-sm-4">
                        <label for="nacionalidad" class="form-label fw-bold">Tipo</label>
                        <select class="form-select" id="nacionalidad" name="nacionalidad" required>
                            <option value="V" <?= old('nacionalidad') === 'V' ? 'selected' : '' ?>>V</option>
                            <option value="E" <?= old('nacionalidad') === 'E' ? 'selected' : '' ?>>E</option>
                            <option value="P" <?= old('nacionalidad') === 'P' ? 'selected' : '' ?>>P</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="cedula" class="form-label fw-bold">Cédula de Identidad</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ej: 12345678"
                                value="<?= old('cedula') ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cargo_funciones" class="form-label fw-bold">Cargo:</label>
                    <input type="text" class="form-control" name="cargo_funciones" id="cargoFunciones" placeholder="Cargo del funcionario"
                        value="<?= old('cargo_funciones') ?>">
                </div>

                <div class="mb-3">
                    <label for="nivel" class="form-label fw-bold">Nivel</label>
                    <select class="form-select" id="nivel" name="nivel" required>
                        <option value=""><?= old('nivel') ? '' : 'Seleccionar' ?></option>
                        <option value="inicial" <?= old('nivel') === 'inicial' ? 'selected' : '' ?>>Inicial</option>
                        <option value="primaria" <?= old('nivel') === 'primaria' ? 'selected' : '' ?>>Primaria</option>
                        <option value="media general" <?= old('nivel') === 'media general' ? 'selected' : '' ?>>Media General</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3">Vista previa</button>
                <button type="reset" class="btn btn-secondary mt-3">Limpiar</button>
            </div>
        </form>
    </div>
    <script src="<?= base_url('assets/js/recordFieldsValidations.js'); ?>"></script>
<?= $this->endSection() ?>