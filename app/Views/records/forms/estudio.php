<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Estudio<?= $this->endSection() ?>

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
        <h3>Constancia de Estudio</h3>
        <h5>Datos del Estudiante:</h5>
        <form method="post" action="<?= site_url('records/preview') ?>" data-record-type="<?= esc($slug) ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= esc($slug) ?>">
            <div class="mt-4">
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer nombre:</label>
                            <input type="text" class="form-control" name="primer_nombre"
                                value="<?= old('primer_nombre') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo nombre:</label>
                            <input type="text" class="form-control" name="segundo_nombre"
                                value="<?= old('segundo_nombre') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer apellido:</label>
                            <input type="text" class="form-control" name="primer_apellido"
                                value="<?= old('primer_apellido') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo apellido:</label>
                            <input type="text" class="form-control" name="segundo_apellido"
                                value="<?= old('segundo_apellido') ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Cédula / Cédula Escolar:</label>
                    <input type="text" class="form-control" name="cedula" value="<?= old('cedula') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Edad:</label>
                    <input type="text" class="form-control" name="edad" placeholder="Ej: 12"
                        value="<?= old('edad') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lugar de Nacimiento (Ciudad):</label>
                    <input type="text" class="form-control" name="birthcity" placeholder="Ej: Coro"
                        value="<?= old('birthcity') ?>">
                </div>

                <div class="mb-3">
                    <label for="states" class="form-label fw-bold">Estado:</label>
                    <select class="form-select" name="states" id="states" required>
                        <option value=""><?= old('states') ? '' : 'Seleccionar' ?></option>
                        <?php
                            $estados = [
                                'Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo',
                                'Cojedes', 'Delta Amacuro', 'Distrito Capital', 'Falcón', 'Guárico', 'Lara',
                                'La Guaira', 'Mérida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa',
                                'Sucre', 'Táchira', 'Trujillo', 'Yaracuy', 'Zulia'
                            ];
                            $selectedState = old('states');
                            foreach ($estados as $estado):
                        ?>
                            <option value="<?= esc($estado) ?>" <?= $estado === $selectedState ? 'selected' : '' ?>>
                                <?= esc($estado) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cursa-curso" class="form-label fw-bold">Situación del Estudiante:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cursa-curso" id="cursa" value="cursa"
                            <?= old('cursa-curso') === 'cursa' || old('cursa-curso') === null ? 'checked' : '' ?>>
                        <label class="form-check-label" for="cursa">
                            Cursa
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cursa-curso" id="curso" value="curso"
                            <?= old('cursa-curso') === 'curso' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="curso">
                            Cursó y aprobó
                        </label>
                    </div>
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

                <div class="mb-3">
                    <label class="form-label fw-bold">Sala / Grado / Año:</label>
                    <input type="text" class="form-control" name="grado" placeholder="Ej: 5to grado, 5to año, Sala de 3 años..."
                        value="<?= old('grado') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Sección:</label>
                    <input type="text" class="form-control" name="seccion" placeholder="Ej: A"
                        value="<?= old('seccion') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Periodo escolar:</label>
                    <input type="text" class="form-control" name="periodo_escolar" placeholder="Ej: 2024-2025"
                        value="<?= old('periodo_escolar') ?>">
                </div>

                <button type="submit" class="btn btn-success mt-3">Vista previa</button>
                <button type="reset" class="btn btn-secondary mt-3">Limpiar</button>
            </div>

        </form>
    </div>
    <script src="<?= base_url('assets/js/recordFieldsValidations.js'); ?>"></script>
<?= $this->endSection() ?>