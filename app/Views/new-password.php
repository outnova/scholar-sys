<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/base.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/new-password.css'); ?>">
    <script src="<?= base_url('assets/js/togglePassword.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <title>Actualizar contraseña</title>
</head>
<body>
    <div class="password-container">
        <h3 class="text-center mb-3">Establezca una contraseña</h3>
        <div class="alert alert-primary" role="alert">
            <p class="mb-0">Hola <b><?= session('username'); ?></b>, es necesario que establezcas una contraseña para acceder al sistema.</p>
        </div>
        <form action="/new-password" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="new_password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <span class="input-group-text eye-icon" id="eye-icon1" onclick="togglePassword('new_password', 'eye-icon1')">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <span class="input-group-text eye-icon" id="eye-icon2" onclick="togglePassword('confirm_password', 'eye-icon2')">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="updatePasswordBtn" disabled>Actualizar Contraseña</button>
            <p class="mt-3 fs-6 text-center">¿No quieres hacer esto ahora? <a href="<?= site_url('auth/logout') ?>">Cierra sesión</a></p>
        </form>
    </div>

    <?php // <?= $this->include('templates/footer'); ?>

    <script src="<?= base_url('assets/js/errors.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            var passwordValid = false;
            var passwordMatch = false;
            
            function toggleSubmitButton() {
                if(passwordValid && passwordMatch) {
                    $('#updatePasswordBtn').prop('disabled', false);
                } else {
                    $('#updatePasswordBtn').prop('disabled', true);
                }
            }

            // Verificación de primer apellido (solo letras y espacios)
            $('#new_password').on('input', function() {
                var newPassword = $(this).val();
                clearErrors($(this));

                // Expresión regular para validar la contraseña
                var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[#$.@&])[A-Za-z\d#$.@&]{8,16}$/;

                if (!passwordRegex.test(newPassword)) {
                    showError($(this), 'La contraseña debe tener entre 8 y 16 caracteres, incluir al menos una mayúscula, un número y uno de estos símbolos: # $ . @ &.');
                    passwordValid = false;
                }
                else {
                    passwordValid = true;
                }

                toggleSubmitButton();
            });

            $('#confirm_password').on('input', function() {
                var confirmPassword = $(this).val();
                var newPassword = $('#new_password').val();
                clearErrors($(this));

                if (confirmPassword !== newPassword || newPassword === '') {
                    showError($(this), 'Las contraseñas no coinciden.');
                    passwordMatch = false;
                }
                else {
                    passwordMatch = true;
                }

                toggleSubmitButton();
            });

            // Validación final al hacer submit
            $('form').on('submit', function(event) {
                var isValid = true;

                // Validaciones de todos los campos
                $('#new_password, #confirm_password').each(function() {
                    // Limpiar cualquier mensaje de error previo
                    clearErrors($(this));
                    if (!$(this).val()) {
                        isValid = false;
                        showError($(this), 'Este campo es obligatorio.');
                    }
                });

                // Si algún campo no es válido, prevenimos el envío
                if (!isValid) {
                    event.preventDefault();
                }

                console.log(isValid);
            });
        });
    </script>
</body>
</html>