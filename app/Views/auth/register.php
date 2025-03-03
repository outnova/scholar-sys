<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/general.css'); ?>">
</head>
<body class="bg-light d-flex flex-column">
    <div class="main-content"> <!-- Contenedor principal -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow-lg">
                        <div class="text-center p-3">
                            <h4>Registro de Usuario</h4>
                        </div>
                        <div class="card-body">
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
                            <form action="<?= site_url('auth/store') ?>" method="post">
                                <?= csrf_field(); ?>

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

                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
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
                                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= site_url('login') ?>" class="text-decoration-none">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('templates/footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>