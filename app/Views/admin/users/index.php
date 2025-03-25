<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Administrar Usuarios<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <h3 class="mb-4">Lista de Usuarios</h3>

            <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-success mb-3">Agregar usuario</a>

            <table id="users" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Cédula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['cedula']) ?></td>
                        <td>Editar / Eliminar</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
        </script>
<?= $this->endSection() ?>
