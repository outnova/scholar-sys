<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php
        $cedulaParts = explode('-', $employee['cedula']);
        $nacionalidad = $cedulaParts[0] ?? '';
        $cedulaNumero = $cedulaParts[1] ?? '';
    ?>

    <div class="container mt-4">
        <h3 class="mb-4">                                
            <?= esc(
                $employee['primer_nombre'] . 
                (!empty($employee['segundo_nombre']) ? ' ' . $employee['segundo_nombre'] : '') . 
                ' ' . $employee['primer_apellido'] . 
                (!empty($employee['segundo_apellido']) ? ' ' . $employee['segundo_apellido'] : '')
            ) ?>
        </h3>
        <p>Estás editando un trabajador.</p>
        <div class="w-100 w-sm-75 w-md-50 mx-auto mt-3">
            <?php if (session()->has('errores')): ?>
                <div class="alert alert-danger">
                    <p>Corrige los siguientes errores:</p>
                    <ul>
                        <?php foreach (session('errores') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/employees/' . $employee['id'] . '/update'); ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-2">
                    <div class="col-sm-4">
                        <label for="nacionalidad" class="form-label">Tipo</label>
                        <select class="form-select" aria-label="Default select example" id="nacionalidad" name="nacionalidad">
                            <!--<option selected>Open this select menu</option>-->
                            <option value="V" <?= ($nacionalidad == 'V') ? 'selected' : '' ?>>V</option>
                            <option value="E" <?= ($nacionalidad == 'E') ? 'selected' : '' ?>>E</option>
                            <option value="P" <?= ($nacionalidad == 'P') ? 'selected' : '' ?>>P</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="<?= esc($cedulaNumero); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="primer_nombre" class="form-label">Primer nombre</label>
                            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="<?= esc($employee['primer_nombre']); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="segundo_nombre" class="form-label">Segundo nombre</label>
                            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="<?= esc($employee['segundo_nombre']); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="primer_apellido" class="form-label">Primer apellido</label>
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?= esc($employee['primer_apellido']); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo apellido</label>
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?= esc($employee['segundo_apellido']); ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso">Fecha de ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control mt-2" value="<?= esc($employee['fecha_ingreso']); ?>">
                </div>

                <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select class="form-select" aria-label="Default select example" id="nivel" name="nivel">
                            <option value="" <?= ($employee['nivel'] == '') ? 'selected' : '' ?>>Seleccionar</option>
                            <option value="inicial" <?=($employee['nivel'] == 'Inicial') ? 'selected' : '' ?>>Inicial</option>   
                            <option value="primaria" <?=($employee['nivel'] == 'Primaria') ? 'selected' : '' ?>>Primaria</option>
                            <option value="media general" <?=($employee['nivel'] == 'Media General') ? 'selected' : '' ?>>Media General</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" aria-label="Default select example" id="cargo" name="cargo">
                        <option value="" <?= ($employee['position'] == '') ? 'selected' : '' ?>>Seleccionar</option>
                        <option value="directivo" <?=($employee['position'] == 'Directivo') ? 'selected' : '' ?>>Directivo</option>
                        <option value="subdirectivo" <?=($employee['position'] == 'Subdirectivo') ? 'selected' : '' ?>>Subdirectivo</option>
                        <option value="coordinador" <?=($employee['position'] == 'Coordinador') ? 'selected' : '' ?>>Coordinador</option>
                        <option value="administrativo" <?=($employee['position'] == 'Administrativo') ? 'selected' : '' ?>>Administrativo</option>
                        <option value="docente" <?=($employee['position'] == 'Docente') ? 'selected' : '' ?>>Docente</option>
                        <option value="obrero" <?=($employee['position'] == 'Obrero') ? 'selected' : '' ?>>Obrero</option>
                </select>
                </div>

                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-select" aria-label="Default select example" id="turno" name="turno">
                        <option value="" <?= ($employee['turn'] == '') ? 'selected' : '' ?>>Seleccionar</option>
                        <option value="mañana" <?= ($employee['turn'] == 'Mañana') ? 'selected' : '' ?>>Mañana</option>
                        <option value="tarde" <?= ($employee['turn'] == 'Tarde') ? 'selected' : '' ?>>Tarde</option>
                </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('/admin/employees'); ?>" class="btn btn-secondary">Atrás</a>
            </form>
        </div>
    </div>
    <script src="<?= base_url('assets/js/employeeFieldsValidations.js'); ?>"></script>
<?= $this->endSection() ?>