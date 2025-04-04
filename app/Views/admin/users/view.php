<?= $this->extend('templates/base') ?>

<?= $this->section('styles') ?>
    <style>
        .badge {
            font-size: 1rem;
            padding: 0.4em 0.7em;
            border-radius: 0.6rem;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <h3 class="mb-4"><?= esc($user['username']); ?></h3>
        <p>Estás viendo un perfil de usuario.</p>
        <div class="mb-3">
            <p>
                Estado del usuario:
                <span class="badge <?= $user['active'] ? 'bg-success' : 'bg-danger' ?>">
                    <?= $user['active'] ? 'Activo' : 'Inactivo' ?>
                </span>
            </p>
        </div>
        <div class="mb-3">
            <button class="btn <?= $user['active'] ? 'btn-danger' : 'btn-success' ?>" 
                    id="toggleUserStatusBtn" 
                    data-user-id="<?= $user['id'] ?>">
                <?= $user['active'] ? 'Desactivar usuario' : 'Activar usuario' ?>
            </button>
            </div>
        <div>
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary">Volver</a>
        </div> 
    </div>
    <?= $this->section('scripts') ?>
        <script>
            const csrfTokenName = '<?= csrf_token() ?>';
            const csrfTokenValue = '<?= csrf_hash() ?>';
        </script>
        <script>
            document.getElementById('toggleUserStatusBtn').addEventListener('click', function () {
            const userId = this.dataset.userId;
            const isActive = this.classList.contains('btn-danger'); // si es rojo, está activo

            Swal.fire({
                title: isActive ? '¿Desactivar usuario?' : '¿Activar usuario?',
                text: isActive 
                    ? 'El usuario no podrá acceder al sistema hasta ser reactivado.' 
                    : 'El usuario podrá acceder nuevamente al sistema.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: isActive ? 'Sí, desactivar' : 'Sí, activar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/users/toggle-status/${userId}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', // para diferenciar si es AJAX
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            [csrfTokenName]: csrfTokenValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: '¡Listo!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // recarga para reflejar el nuevo estado
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Algo salió mal al cambiar el estado.', 'error');
                    });
                }
            });
        });
    </script>
    <?= $this->endSection() ?>
<?= $this->endSection() ?>