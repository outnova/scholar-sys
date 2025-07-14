<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
        background-color: #e8e4e4;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        }

        .login-wrapper {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        }

        .login-container {
        width: 100%;
        max-width: 900px;
        border-radius: 15px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .login-image {
        background-image: url('<?= base_url('assets/images/login-bg.webp') ?>');
        background-size: cover;
        background-position: center;
        }

        .form-floating input:focus,
        .form-floating input:not(:placeholder-shown) {
        border-color: #007bff;
        }

        .form-floating input:focus ~ label,
        .form-floating input:not(:placeholder-shown) ~ label {
        color: #007bff;
        }

        .form-floating label {
        transition: all 0.2s ease-in-out;
        }

        .login-form {
        padding: 20px;
        }

        .btn-login {
        width: 100%;
        }

        .text-center-info {
        text-align: center;
        margin-bottom: 30px;
        }

        .form-password {
        position: relative;
        }

        .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #007bff;
        font-size: 1.2rem;
        }

        footer {
        text-align: center;
        margin-top: auto;
        padding: 20px;
        background-color: #f1f1f1;
        }

        @media (max-width: 992px) {
        .login-container {
            max-width: 90%;
        }
        }

        @media (max-width: 768px) {
        .login-image {
            display: none;
        }
        .login-container {
            max-width: 95%;
        }
        }

    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container row mx-auto">
      
            <!-- Formulario -->
            <div class="col-md-6 bg-white login-form">
                <div class="text-center-info">
                    <h3>Bienvenido</h3>
                    <p>Por favor, inicia sesión para continuar</p>
                </div>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-warning"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <form action="<?= base_url('auth/authenticate') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
                        <label for="username">Usuario</label>
                    </div>

                    <div class="form-floating mb-3 form-password">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        <label for="password">Contraseña</label>
                        <span class="toggle-password" onclick="togglePassword()">
                            <i id="toggle-icon" class="bi bi-eye"></i>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login">Acceder</button>
                </form>
                <div class="text-center mt-3">
                    <p>¿No tienes una cuenta? <a class="text-decoration-none" href="<?= base_url('register') ?>">Regístrate aquí</a></p>
                    <p>¿Olvidaste tu contraseña? <a class="text-decoration-none" href="<?= base_url('auth/forgot_password') ?>">Recuperar contraseña</a></p>
                </div>
            </div>
            <!-- Imagen -->
            <div class="col-md-6 login-image d-none d-md-block"></div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <p>2025.</p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Script para mostrar/ocultar contraseña -->
    <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const icon = document.getElementById("toggle-icon");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      }
    }
    </script>
</body>
</html>