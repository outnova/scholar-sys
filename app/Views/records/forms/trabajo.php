<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Trabajo<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="w-100 w-sm-75 w-md-50 mx-auto">
        <a href="<?= site_url('records/create'); ?>" class="btn btn-secondary mb-2">Atrás</a>
        <h3>Constancia de Trabajo</h3>
        <form method="post" action="<?= site_url('records/store') ?>">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="employee_id" class="form-label">Seleccionar empleado:</label>
                <select class="form-select select-with-search" name="employee_id" id="employee_id">
                    <option disabled selected value="">Seleccionar</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id'] ?>"
                            data-primer-nombre="<?= esc($employee['primer_nombre']) ?>"
                            data-segundo-nombre="<?= esc($employee['segundo_nombre']) ?>"
                            data-primer-apellido="<?= esc($employee['primer_apellido']) ?>"
                            data-segundo-apellido="<?= esc($employee['segundo_apellido']) ?>"
                            data-fecha-ingreso="<?= esc($employee['fecha_ingreso']) ?>"
                            data-cedula="<?= esc($employee['cedula']) ?>"
                            data-nivel="<?= esc($employee['nivel']) ?>">
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

            <!-- Contenedor que se muestra al hacer clic en "Siguiente" -->
            <div id="employeeDataContainer" class="mt-4 d-none">
                <h5>Datos del empleado</h5>

                <div class="mb-2">
                    <label class="form-label">Nombre completo:</label>
                    <input type="text" id="nombreCompleto" class="form-control" disabled>
                    <input type="hidden" name="nombre_completo" id="nombreCompletoHidden">
                </div>

                <div class="mb-2">
                    <label class="form-label">Cédula:</label>
                    <input type="text" id="employeeCedula" class="form-control" disabled>
                    <input type="hidden" name="cedula" id="employeeCedulaHidden">
                </div>

                <div class="mb-2">
                    <label class="form-label">Fecha de ingreso:</label>
                    <input type="text" id="fechaIngreso" class="form-control" disabled>
                    <input type="hidden" name="fecha_ingreso" id="fechaIngresoHidden">
                </div>

                <div class="mb-2">
                    <label class="form-label">Nivel:</label>
                    <input type="text" id="employeeNivel" class="form-control" disabled>
                    <input type="hidden" name="nivel" id="employeeNivelHidden">
                </div>

                <div class="mb-2">
                    <label class="form-label">Cargo/Funciones:</label>
                    <input type="text" class="form-control" name="cargo_funciones" id="cargoFunciones" placeholder="Cargo o funciones del empleado">
                </div>

                <div class="mb-2">
                    <label class="form-label">Código del cargo:</label>
                    <input type="text" class="form-control" name="codigo_cargo" id="codigoCargo" placeholder="Código del cargo del empleado">
                </div>

                <div class="mb-2">
                    <label for="form-label">Dependencia:</label>
                    <input type="text" class="form-control" name="dependencia" id="dependencia" placeholder="Dependencia del empleado">
                </div>

                <div class="mb-2">
                    <label for="form-label">Código de la dependencia:</label>
                    <input type="text" class="form-control" name="codigo_dependencia" id="codigoDependencia" placeholder="Código de la dependencia del empleado">
                </div>

                <div class="mb-2">
                    <label for="form-label">Sueldo mensual:</label>
                    <input type="text" class="form-control" name="sueldo_mensual" id="sueldoMensual" placeholder="Sueldo mensual del empleado">
                </div>

                <!-- Aquí luego podrías agregar más campos según el tipo de constancia -->

                <button type="submit" class="btn btn-success mt-3">Vista previa</button>
            </div>
        </form>
    </div>
    <script>

    </script>
    <script src="<?= base_url('assets/js/trabajoCreateForm.js'); ?>"></script>
<?= $this->endSection() ?>