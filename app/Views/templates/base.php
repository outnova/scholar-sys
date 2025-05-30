<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/css/base.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css'); ?>">
    <!-- Sección para estilos personalizados -->
    <?= $this->renderSection('styles') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title><?= $this->renderSection('title') ?></title>
</head>
<body>
    <div class="main-container">
        <?= $this->include('templates/header'); ?>
                <main class="content px-3 py-2">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <?php // <?= $this->include('templates/footer'); ?>

    <script>
        <?php 
        /*
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
            <?php if(session()->get('passwordUpdated')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session()->get('passwordUpdated') ?>',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
            <?php if(session()->get('tempPassword')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario registrado!',
                    text: 'El usuario ha sido registrado correctamente. La contraseña temporal generada es: ' + ' <?= session()->get('tempPassword') ?>',
                    showCancelButton: true,
                    confirmButtonText: 'Copiar',
                    cancelButtonText: 'Cerrar',
                    preConfirm: () => {
                        const password = '<?= session()->get('tempPassword') ?>';
                        navigator.clipboard.writeText(password).then(() => {
                            Swal.fire('¡Contraseña copiada!', '', 'success');
                        }).catch(err => {
                            Swal.fire('Error al copiar', '', 'error');
                        });
                    }
                });
            <?php endif; ?> 
            <?php if(session()->get('userUpdated')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session()->get('userUpdated') ?>',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Refresca la página al cerrar el alert
                });
            <?php endif; ?> 
        });
        */
        ?> 
    </script>
    <script>
        const flashMessages = <?= json_encode([
            'success' => session()->get('success'),
            'passwordUpdated' => session()->get('passwordUpdated'),
            'employeeCreated' => session()->get('employeeCreated'),
            'tempPassword' => session()->get('tempPassword'),
            'userUpdated' => session()->get('userUpdated'),
            'employeeUpdated' => session()->get('employeeUpdated'),
            'homeUrl' => base_url('/home')
        ]) ?>;
    </script>
    <script src="<?= base_url('assets/js/flashMessages.js') ?>"></script>
    <script src="<?= base_url('assets/js/sidebar.js'); ?>"></script>
    <script src="<?= base_url('assets/js/errors.js'); ?>"></script>
    <!-- Sección para scripts personalizados -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>