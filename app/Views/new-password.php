<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/base.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/new-password.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <title>Actualizar contraseña</title>
</head>
<body>
    <div class="password-container">
        <h3 class="text-center mb-3">Cambiar Contraseña</h3>
        <form action="/actualizar-password" method="POST">
            <div class="mb-3">
                <label for="new-password" class="form-label">Nueva Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new-password" name="new_password" required>
                    <span class="input-group-text eye-icon" onclick="togglePassword('new-password', 'eye-icon1')">
                        👁️
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                    <span class="input-group-text eye-icon" onclick="togglePassword('confirm-password', 'eye-icon2')">
                        👁️
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
            <p class="mt-3 fs-6 text-center">¿No quieres hacer esto ahora? <a href="<?= site_url('auth/logout') ?>">Cierra sesión</a></p>
        </form>
    </div>

    <?php // <?= $this->include('templates/footer'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if(session()->has('success') && current_url() !== base_url('/home')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session('success') ?>',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>  
        });
    </script>
</body>
</html>