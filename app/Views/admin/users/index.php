<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Administrar Usuarios<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <h3 class="mb-4">Lista de Usuarios</h3>

            <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-success mb-3">Agregar usuario</a>

            <div class="table-responsive-md">
                <table id="users" class="table table-striped table-bordered w-100" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Cédula</th>
                            <th>Estado</th>
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
                            <td>
                                <span class="badge <?= $user['active'] ? 'bg-success' : 'bg-danger' ?>"><?= $user['active'] ? 'Activo' : 'Inactivo' ?></span>
                            </td>
                            <td>
                            <div class="item-action d-flex gap-3 fs-5 justify-content-center">
                                <a href="#" title="Ver usuario">
                                    <i class="hgi hgi-stroke hgi-view"></i>
                                </a>
                                <a href="#" title="Editar usuario">
                                    <i class="hgi hgi-stroke hgi-pencil-edit-02"></i>
                                </a>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
        </script>
<?= $this->endSection() ?>
