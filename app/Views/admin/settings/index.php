<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Configuración<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <h3 class="mb-4">Configuración del Sistema</h3>

            <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/settings/update') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="system_name" class="form-label">Nombre del Sistema</label>
                    <input type="text" class="form-control" id="system_name" name="system_name" 
                        value="<?= esc($settings['system_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_name" class="form-label">Nombre de la Escuela</label>
                    <input type="text" class="form-control" id="school_name" name="school_name" 
                        value="<?= esc($settings['school_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_address" class="form-label">Dirección</label>
                    <textarea class="form-control" id="school_address" name="school_address" rows="3"><?= esc($settings['school_address']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="school_phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="school_phone" name="school_phone" 
                        value="<?= esc($settings['school_phone']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="school_email" name="school_email" 
                        value="<?= esc($settings['school_email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="principal_name" class="form-label">Nombre del Director</label>
                    <input type="text" class="form-control" id="principal_name" name="principal_name" 
                        value="<?= esc($settings['principal_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="principal_ci" class="form-label">Cédula del Director</label>
                    <input type="text" class="form-control" id="principal_ci" name="principal_ci" 
                        value="<?= esc($settings['principal_ci']) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
<?= $this->endSection() ?>
