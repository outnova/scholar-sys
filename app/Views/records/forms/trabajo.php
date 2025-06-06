<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Trabajo<?= $this->endSection() ?>

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
        <h3>Constancia de Trabajo</h3>
        <form method="post" action="<?= site_url('records/preview') ?>" data-record-type="<?= esc($slug) ?>">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= esc($slug) ?>">
            <div class="mb-3">
                <label for="employee_id" class="form-label">Seleccionar empleado:</label>
                <select class="form-select select-with-search" name="employee_id" id="employee_id">
                    <option disabled <?= empty($formData['employee_id']) ? 'selected' : '' ?> value="">Seleccionar</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id'] ?>"
                            data-primer-nombre="<?= esc($employee['primer_nombre']) ?>"
                            data-segundo-nombre="<?= esc($employee['segundo_nombre']) ?>"
                            data-primer-apellido="<?= esc($employee['primer_apellido']) ?>"
                            data-segundo-apellido="<?= esc($employee['segundo_apellido']) ?>"
                            data-fecha-ingreso="<?= esc($employee['fecha_ingreso']) ?>"
                            data-cedula="<?= esc($employee['cedula']) ?>"
                            data-nivel="<?= esc($employee['nivel']) ?>"
                            <?= isset($formData['employee_id']) && $formData['employee_id'] == $employee['id'] ? 'selected' : '' ?>>
                            <?= esc(
                                $employee['primer_nombre'] .
                                (!empty($employee['segundo_nombre']) ? ' ' . $employee['segundo_nombre'] : '') .
                                ' ' . $employee['primer_apellido'] .
                                (!empty($employee['segundo_apellido']) ? ' ' . $employee['segundo_apellido'] : '')
                            ) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="nextStep" disabled>Consultar datos</button>

            <div id="employeeDataContainer" class="mt-4 <?= !empty($formData) ? '' : 'd-none' ?>">
                <h4>Datos del empleado</h4>

                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer nombre:</label>
                            <input type="text" id="primerNombre" class="form-control" disabled
                                value="<?= esc($formData['primer_nombre'] ?? '') ?>">
                            <input type="hidden" name="primer_nombre" id="primerNombreHidden"
                                value="<?= esc($formData['primer_nombre'] ?? '') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo nombre:</label>
                            <input type="text" id="segundoNombre" class="form-control" disabled
                                value="<?= esc($formData['segundo_nombre'] ?? '') ?>">
                            <input type="hidden" name="segundo_nombre" id="segundoNombreHidden"
                                value="<?= esc($formData['segundo_nombre'] ?? '') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Primer apellido:</label>
                            <input type="text" id="primerApellido" class="form-control" disabled
                                value="<?= esc($formData['primer_apellido'] ?? '') ?>">
                            <input type="hidden" name="primer_apellido" id="primerApellidoHidden"
                                value="<?= esc($formData['primer_apellido'] ?? '') ?>">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-bold">Segundo apellido:</label>
                            <input type="text" id="segundoApellido" class="form-control" disabled
                                value="<?= esc($formData['segundo_apellido'] ?? '') ?>">
                            <input type="hidden" name="segundo_apellido" id="segundoApellidoHidden"
                                value="<?= esc($formData['segundo_apellido'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Cédula:</label>
                    <input type="text" id="employeeCedula" class="form-control" disabled
                        value="<?= esc($formData['cedula'] ?? '') ?>">
                    <input type="hidden" name="cedula" id="employeeCedulaHidden"
                        value="<?= esc($formData['cedula'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha de ingreso:</label>
                    <input type="text" id="fechaIngreso" class="form-control" disabled
                        value="<?= esc($formData['fecha_ingreso'] ?? '') ?>">
                    <input type="hidden" name="fecha_ingreso" id="fechaIngresoHidden"
                        value="<?= esc($formData['fecha_ingreso'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nivel:</label>
                    <input type="text" id="employeeNivel" class="form-control" disabled
                        value="<?= esc($formData['nivel'] ?? '') ?>">
                    <input type="hidden" name="nivel" id="employeeNivelHidden"
                        value="<?= esc($formData['nivel'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Cargo/Funciones:</label>
                    <input type="text" class="form-control" name="cargo_funciones" id="cargoFunciones"
                        placeholder="Cargo o funciones del empleado"
                        value="<?= esc($formData['cargo_funciones'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Código del cargo:</label>
                    <input type="text" class="form-control" name="codigo_cargo" id="codigoCargo"
                        placeholder="Código del cargo del empleado"
                        value="<?= esc($formData['codigo_cargo'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Dependencia:</label>
                    <input type="text" class="form-control" name="dependencia" id="dependencia"
                        placeholder="Dependencia del empleado"
                        value="<?= esc($formData['dependencia'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Código de la dependencia:</label>
                    <input type="text" class="form-control" name="codigo_dependencia" id="codigoDependencia"
                        placeholder="Código de la dependencia del empleado"
                        value="<?= esc($formData['codigo_dependencia'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Sueldo mensual:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Bs.</span>
                        <input type="text" class="form-control" name="sueldo_mensual" id="sueldoMensual"
                            placeholder="Sueldo mensual del empleado"
                            value="<?= esc($formData['sueldo_mensual'] ?? '') ?>"
                            aria-label="Sueldo mensual del empleado" 
                            aria-describedby="basic-addon1">
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Vista previa</button>
                <button type="reset" class="btn btn-secondary mt-3">Limpiar</button>
            </div>
        </form>
    </div>
    <script src="<?= base_url('assets/js/trabajoCreateForm.js'); ?>"></script>
    <script src="<?= base_url('assets/js/recordFieldsValidations.js'); ?>"></script>
<?= $this->endSection() ?>