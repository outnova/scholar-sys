<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Configuración<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <div class="w-100 w-sm-75 w-md-50 mx-auto">
                <h3 class="mb-4">Crear nuevo usuario</h3>

                <form action="<?= base_url('admin/settings/store') ?>" method="post">
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
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a href="<?= base_url('/admin/users'); ?>" class="btn btn-secondary">Atrás</a>
                </form>
            </div>
        </div>
<?= $this->endSection() ?>
