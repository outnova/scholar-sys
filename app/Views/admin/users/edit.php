<?= $this->extend('templates/base') ?>

<?= $this->section('styles') ?>
    <style>
        .status-label {
            transition: color 0.3s ease;
        }

        .status-activo {
            color: #198754 !important; /* verde Bootstrap */
        }

        .status-inactivo {
            color: #dc3545 !important; /* rojo Bootstrap */
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php
        $cedulaParts = explode('-', $user['cedula']);
        $nacionalidad = $cedulaParts[0] ?? '';
        $cedulaNumero = $cedulaParts[1] ?? '';
    ?>

    <div class="container mt-4">
        <h3 class="mb-4"><?= esc($user['username']); ?></h3>
        <p>Estás editando un usuario.</p>
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

            <form action="<?= base_url('admin/users/update/' . $user['id']); ?>" method="post">
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
                            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="<?= esc($user['primer_nombre']); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="segundo_nombre" class="form-label">Segundo nombre</label>
                            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="<?= esc($user['segundo_nombre']); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="primer_apellido" class="form-label">Primer apellido</label>
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?= esc($user['primer_apellido']); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo apellido</label>
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?= esc($user['segundo_apellido']); ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" aria-label="Default select example" id="cargo" name="cargo">
                        <option value="" <?= ($user['position'] == '') ? 'selected' : '' ?>>Seleccionar</option>
                        <option value="directivo" <?=($user['position'] == 'Directivo') ? 'selected' : '' ?>>Directivo</option>
                        <option value="subdirectivo" <?=($user['position'] == 'Subdirectivo') ? 'selected' : '' ?>>Subdirectivo</option>
                        <option value="coordinador" <?=($user['position'] == 'Coordinador') ? 'selected' : '' ?>>Coordinador</option>
                        <option value="administrativo" <?=($user['position'] == 'Administrativo') ? 'selected' : '' ?>>Administrativo</option>
                </select>
                </div>
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-select" aria-label="Default select example" id="turno" name="turno">
                        <option value="" <?= ($user['turn'] == '') ? 'selected' : '' ?>>Seleccionar</option>
                        <option value="mañana" <?= ($user['turn'] == 'Mañana') ? 'selected' : '' ?>>Mañana</option>
                        <option value="tarde" <?= ($user['turn'] == 'Tarde') ? 'selected' : '' ?>>Tarde</option>
                </select>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                            type="checkbox" 
                            role="switch" 
                            id="userActiveSwitch" 
                            name="active" 
                            value="1" 
                            <?= $user['active'] ? 'checked' : '' ?>>
                        <label class="form-check-label transition fw-bold" 
                            for="userActiveSwitch" 
                            id="userStatusLabel">
                            <?= $user['active'] ? 'Usuario activo' : 'Usuario inactivo' ?>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('/admin/users'); ?>" class="btn btn-secondary">Atrás</a>
            </form>
        </div>
    </div>
    <script src="<?= base_url('assets/js/userActiveSwitch.js'); ?>"></script>
<?= $this->endSection() ?>