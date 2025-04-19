<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Administrar Trabajadores<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <h3 class="mb-4">Lista de Trabajadores</h3>

            <a href="<?= base_url('/admin/employees/create') ?>" class="btn btn-success mb-3">Agregar trabajador</a>

            <div class="table-responsive-md">
                <table id="employees" class="table table-striped table-bordered w-100" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="w-25">Nombre Completo</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cédula</th>
                            <th>Nivel</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= esc($employee['id']) ?></td>
                            <td>    
                                <?= esc(
                                        $employee['primer_nombre'] . 
                                        (!empty($employee['segundo_nombre']) ? ' ' . $employee['segundo_nombre'] : '') . 
                                        ' ' . $employee['primer_apellido'] . 
                                        (!empty($employee['segundo_apellido']) ? ' ' . $employee['segundo_apellido'] : '')
                                    ) ?>
                            </td>
                            <td><?= esc($employee['fecha_ingreso']) ?></td>
                            <td><?= esc($employee['cedula']) ?></td>
                            <td><?= esc($employee['nivel']) ?></td>
                            <td>
                                <span class="badge <?= $employee['active'] ? 'bg-success' : 'bg-danger' ?>"><?= $employee['active'] ? 'Activo' : 'Inactivo' ?></span>
                            </td>
                            <td>
                            <div class="item-action d-flex gap-3 fs-5 justify-content-center">
                                <a href="<?= base_url('admin/employees/' . $employee['id']) ?>" title="Ver trabajador">
                                    <i class="hgi hgi-stroke hgi-view"></i>
                                </a>
                                <a href="<?= base_url('admin/employees/' . $employee['id']) . '/edit' ?>" title="Editar trabajador">
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
            $('#employees').DataTable();
        });
        </script>
<?= $this->endSection() ?>
