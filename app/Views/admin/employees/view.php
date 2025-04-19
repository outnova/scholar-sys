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
        <h3 class="mb-4">                                
            <?= esc(
                $employee['primer_nombre'] . 
                (!empty($employee['segundo_nombre']) ? ' ' . $employee['segundo_nombre'] : '') . 
                ' ' . $employee['primer_apellido'] . 
                (!empty($employee['segundo_apellido']) ? ' ' . $employee['segundo_apellido'] : '')
            ) ?>
        </h3>
        <p>Estás viendo un trabajador.</p>
        <div class="mb-3">
            <p>
                Estado del trabajador:
                <span class="badge <?= $employee['active'] ? 'bg-success' : 'bg-danger' ?>">
                    <?= $employee['active'] ? 'Activo' : 'Inactivo' ?>
                </span>
            </p>
        </div>
        <div class="mb-3">
            <button class="btn <?= $employee['active'] ? 'btn-danger' : 'btn-success' ?>" 
                    id="toggleEmployeeStatusBtn" 
                    data-user-id="<?= $employee['id'] ?>">
                <?= $employee['active'] ? 'Desactivar trabajador' : 'Activar trabajador' ?>
            </button>
        </div>
        <div>
            <a href="<?= base_url('admin/employees'); ?>" class="btn btn-primary">Volver</a>
        </div> 
    </div>
    <?= $this->section('scripts') ?>
        <script>
            const csrfTokenName = '<?= csrf_token() ?>';
            const csrfTokenValue = '<?= csrf_hash() ?>';
        </script>
        <script>
            document.getElementById('toggleEmployeeStatusBtn').addEventListener('click', function () {
                const userId = this.dataset.userId;
                const isActive = this.classList.contains('btn-danger'); // si es rojo, está activo

                Swal.fire({
                    title: isActive ? '¿Desactivar trabajador?' : '¿Activar trabajador?',
                    text: isActive 
                        ? 'El trabajador no podrá ser seleccionado para expedir cualquier documento del sistema.' 
                        : 'El trabajador podrá ser seleccionado para expedir cualquier documento del sistema.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: isActive ? 'Sí, desactivar' : 'Sí, activar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/employees/toggle-status/${userId}`, {
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