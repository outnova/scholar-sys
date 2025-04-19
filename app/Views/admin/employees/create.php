<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Configuración<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <div class="w-100 w-sm-75 w-md-50 mx-auto">
                <h3 class="mb-4">Crear nuevo trabajador</h3>

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

                <form action="<?= base_url('admin/employees/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-2">
                        <div class="col-sm-4">
                            <label for="nacionalidad" class="form-label">Tipo</label>
                            <select class="form-select" aria-label="Default select example" id="nacionalidad" name="nacionalidad">
                                <!--<option selected>Open this select menu</option>-->
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="primer_nombre" class="form-label">Primer nombre</label>
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="segundo_nombre" class="form-label">Segundo nombre</label>
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="primer_apellido" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="segundo_apellido" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_ingreso">Fecha de ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control mt-2">
                    </div>

                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select class="form-select" aria-label="Default select example" id="nivel" name="nivel">
                            <option selected>Seleccionar</option>
                            <option value="inicial">Inicial</option>   
                            <option value="primaria">Primaria</option>
                            <option value="media general">Media General</option>
                    </select>
                    </div>

                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select class="form-select" aria-label="Default select example" id="cargo" name="cargo">
                            <option selected>Seleccionar</option>
                            <option value="directivo">Directivo</option>
                            <option value="subdirectivo">Subdirectivo</option>
                            <option value="coordinador">Coordinador</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="docente">Docente</option>
                            <option value="obrero">Obrero</option>
                    </select>
                    </div>

                    <div class="mb-3">
                        <label for="turno" class="form-label">Turno</label>
                        <select class="form-select" aria-label="Default select example" id="turno" name="turno">
                            <option selected>Seleccionar</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                    </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a href="<?= base_url('/admin/employees'); ?>" class="btn btn-secondary">Atrás</a>
                </form>
            </div>
        </div>
        <script src="<?= base_url('assets/js/employeeFieldsValidations.js'); ?>"></script>
<?= $this->endSection() ?>
