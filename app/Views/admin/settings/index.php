<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Configuración<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <h3 class="mb-4">Configuración del Sistema</h3>

            <?php /*
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>
            */
            ?>

            <?php if (session()->has('errores')): ?>
                <div class="alert alert-danger">
                    <p>Corrige los siguientes errores:</p>
                    <ul>
                        <?php foreach (session('errores') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
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
                    <label for="dea_code" class="form-label">Código DEA</label>
                    <input type="text" class="form-control" id="dea_code" name="dea_code" 
                        value="<?= esc($settings['dea_code']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="depend_code" class="form-label">Código de Dependencia</label>
                    <input type="text" class="form-control" id="depend_code" name="depend_code" 
                        value="<?= esc($settings['depend_code']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_address" class="form-label">Dirección</label>
                    <textarea class="form-control" id="school_address" name="school_address" rows="3" required><?= esc($settings['school_address']) ?></textarea>
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
                    <div class="row g-2">
                        <div class="col-sm-2">
                            <label for="principal_nacionalidad" class="form-label">Nacionalidad</label>
                            <select class="form-select" aria-label="Default select example" id="principal_nacionalidad" name="principal_nacionalidad">
                                <!--<option selected>Open this select menu</option>-->
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label for="principal_ci" class="form-label">Cédula</label>
                                <?php $ciLimpia = preg_replace('/[^0-9]/', '', $settings['principal_ci']); ?>
                                <input type="text" class="form-control" id="principal_ci" name="principal_ci" 
                                value="<?= esc($ciLimpia) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" disabled>Guardar Cambios</button>
            </form>
        </div>
        <script src="<?= base_url('assets/js/settingsValidations.js'); ?>"></script>
        <script src="<?= base_url('assets/js/checkSettingsChanges.js'); ?>"></script>
<?= $this->endSection() ?>
