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

            <?php
                // Suponiendo que $settings['principal_ci'] = "V-12.345.678"
                $ciCompleta = $settings['principal_ci'] ?? '';
                $ciPartes = explode('-', $ciCompleta);

                $nacionalidad = $ciPartes[0] ?? 'V'; // 'V', 'E' o 'P'
                $ciNumeros = isset($ciPartes[1]) ? preg_replace('/[^0-9]/', '', $ciPartes[1]) : '';
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
                    <label for="school_footeraddress" class="form-label">Dirección (pie de página / footer)</label>
                    <input type="text" class="form-control" id="school_footeraddress" name="school_footeraddress" 
                        value="<?= esc($settings['school_footeraddress']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_footercity" class="form-label">Ciudad (pie de página / footer)</label>
                    <input type="text" class="form-control" id="school_footercity" name="school_footercity" 
                        value="<?= esc($settings['school_footercity']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_longcity" class="form-label">Ciudad de la Escuela (Larga)</label>
                    <input type="text" class="form-control" id="school_longcity" name="school_longcity" 
                        value="<?= esc($settings['school_longcity']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="school_shortcity" class="form-label">Ciudad de la Escuela (Corta)</label>
                    <input type="text" class="form-control" id="school_shortcity" name="school_shortcity" 
                        value="<?= esc($settings['school_shortcity']) ?>" required>
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
                            <select class="form-select" id="principal_nacionalidad" name="principal_nacionalidad">
                                <option value="V" <?= $nacionalidad === 'V' ? 'selected' : '' ?>>V</option>
                                <option value="E" <?= $nacionalidad === 'E' ? 'selected' : '' ?>>E</option>
                                <option value="P" <?= $nacionalidad === 'P' ? 'selected' : '' ?>>P</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="principal_ci" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="principal_ci" name="principal_ci" 
                                value="<?= esc($ciNumeros) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="principal_position" class="form-label">Cargo del Director</label>
                    <select class="form-select" aria-label="Default select example" name="principal_position" id="principal_position">
                        <option value="Director" <?= esc($settings['principal_position']) === 'Director' ? 'selected' : '' ?>>Director</option>
                        <option value="Director (E)" <?= esc($settings['principal_position']) === 'Director (E)' ? 'selected' : '' ?>>Director (E)</option>
                        <option value="Directora" <?= esc($settings['principal_position']) === 'Directora' ? 'selected' : '' ?>>Directora</option>
                        <option value="Directora (E)" <?= esc($settings['principal_position']) === 'Directora (E)' ? 'selected' : '' ?>>Directora (E)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="principal_phone" class="form-label">Teléfono del Director</label>
                    <input type="text" class="form-control" id="principal_phone" name="principal_phone" 
                        value="<?= esc($settings['principal_phone']) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary" disabled>Guardar Cambios</button>
            </form>
        </div>
        <script src="<?= base_url('assets/js/settingsValidations.js'); ?>"></script>
        <script src="<?= base_url('assets/js/checkSettingsChanges.js'); ?>"></script>
<?= $this->endSection() ?>
