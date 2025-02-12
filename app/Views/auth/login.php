<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            max-width: 400px;
            padding: 2rem;
            background: #fff;
            /*border-radius: 10px;*/
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
        }
        .left-container {
            background: #0d6efd;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            height: 100vh;
        }
        .left-container img {
            width: 120px;
            margin-bottom: 1rem;
        }

        .form-floating {
            zoom: 75%;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container p-0">
        <div class="row w-100 min-vh-100 g-0">
            <!-- Sección izquierda (70%) -->
            <div class="col-md-7 d-none d-md-flex left-container">
                <div>
                    <img src="https://picsum.photos/200" alt="Logo">
                    <h2>Bienvenido a la plataforma</h2>
                    <p>Inicia sesión para continuar</p>
                </div>
            </div>
            <!-- Sección derecha (30%) -->
            <div class="col-md-5 d-flex align-items-center justify-content-center vh-100">
                <div class="login-box w-100">
                    <h3 class="text-left mb-4">Iniciar Sesión</h3>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-warning"><?= session()->getFlashdata('message') ?></div>
                    <?php endif; ?>
                    <form action="<?= base_url('auth/authenticate') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" id="floatingUsername" placeholder="Usuario" required>
                            <label for="username" class="form-label">Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" id="floatingPassword" placeholder="Contraseña" required>
                            <label for="password" class="form-label">Contraseña</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-50">Acceder</button>
                        </div>
                    </form>
                    <div class="card-footer text-center mt-3">
                        <a href="<?= site_url('register') ?>" class="text-decoration-none">¿No tienes cuenta? Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>