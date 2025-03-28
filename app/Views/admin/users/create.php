<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Configuración<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container mt-4">
            <div class="w-100 w-sm-75 w-md-50 mx-auto">
                <h3 class="mb-4">Crear nuevo usuario</h3>

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

                <form action="<?= base_url('admin/users/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-2">
                        <div class="col-sm-4">
                            <label for="nacionalidad" class="form-label">Tipo</label>
                            <select class="form-select" aria-label="Default select example" id="nacionalidad" name="nacionalidad">
                                <!--<option selected>Open this select menu</option>-->
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="primer_nombre" class="form-label">Primer nombre</label>
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="segundo_nombre" class="form-label">Segundo nombre</label>
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="primer_apellido" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="segundo_apellido" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select class="form-select" aria-label="Default select example" id="cargo" name="cargo">
                            <option selected>Seleccionar</option>
                            <option value="directivo">Directivo</option>
                            <option value="subdirectivo">Subdirectivo</option>
                            <option value="coordinador">Coordinador</option>
                            <option value="administrativo">Administrativo</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="turno" class="form-label">Turno</label>
                        <select class="form-select" aria-label="Default select example" id="turno" name="turno">
                            <option selected>Seleccionar</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                    </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a href="<?= base_url('/admin/users'); ?>" class="btn btn-secondary">Atrás</a>
                </form>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            // Función para mostrar los errores
            function showError(input, message) {
                var errorDiv = $('<div class="error"></div>').text(message);
                input.closest('.mb-3').append(errorDiv);
                input.addClass('is-invalid');
            }

            // Función para limpiar los errores
            function clearErrors(input) {
                input.removeClass('is-invalid');
                input.closest('.mb-3').find('.error').remove();
            }

            // Verificación de cédula (debe ser entre 6 y 9 dígitos)
            $('#cedula').on('input', function() {
                var cedula = $(this).val();
                clearErrors($(this));
                var nacionalidad = $('#nacionalidad').val();
                var cedulaCompleta = nacionalidad + '-' + cedula;

                if (!/^[0-9]{6,9}$/.test(cedula)) {
                    showError($(this), 'La cédula debe contener entre 6 y 9 dígitos numéricos.');
                }
            });

            // Verificación de primer nombre (solo letras y espacios)
            $('#primer_nombre').on('input', function() {
                var primerNombre = $(this).val();
                clearErrors($(this));

                    // Permite letras, acentos y espacios
                    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(primerNombre)) {
                    showError($(this), 'El primer nombre solo puede contener letras y espacios.');
                }
            });

            // Verificación de segundo nombre (solo letras y espacios)
            $('#segundo_nombre').on('input', function() {
                var segundoNombre = $(this).val();
                clearErrors($(this));

                if (segundoNombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(segundoNombre)) {
                    showError($(this), 'El segundo nombre solo puede contener letras y espacios.');
                }
            });

            // Verificación de primer apellido (solo letras y espacios)
            $('#primer_apellido').on('input', function() {
                var primerApellido = $(this).val();
                clearErrors($(this));

                if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(primerApellido)) {
                    showError($(this), 'El primer apellido solo puede contener letras y espacios.');
                }
            });

            // Verificación de segundo apellido (solo letras y espacios)
            $('#segundo_apellido').on('input', function() {
                var segundoApellido = $(this).val();
                clearErrors($(this));

                if (segundoApellido && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(segundoApellido)) {
                    showError($(this), 'El segundo apellido solo puede contener letras y espacios.');
                }
            });

            // Verificación de nombre de usuario (no puede estar vacío)
            $('#username').on('input', function() {
                var username = $(this).val();
                clearErrors($(this));

                if (!username) {
                    showError($(this), 'El nombre de usuario es obligatorio.');
                }
            });

            // Verificación de correo electrónico (formato correcto)
            $('#email').on('input', function() {
                var email = $(this).val();
                clearErrors($(this));

                if (!/\S+@\S+\.\S+/.test(email)) {
                    showError($(this), 'El correo electrónico no tiene un formato válido.');
                }
            });

            // Verificación de cargo (debe estar seleccionado)
            $('#cargo').on('change', function() {
                var cargo = $(this).val();
                clearErrors($(this));

                if (!cargo || cargo === 'Seleccionar') {
                    showError($(this), 'El cargo es obligatorio.');
                }
            });

            // Verificación de turno (debe estar seleccionado)
            $('#turno').on('change', function() {
                var turno = $(this).val();
                clearErrors($(this));

                if (!turno|| turno === 'Seleccionar') {
                    showError($(this), 'El turno es obligatorio.');
                }
            });

            // Validación final al hacer submit
            $('form').on('submit', function(event) {
                var isValid = true;

                // Validaciones de todos los campos
                $('#cedula, #primer_nombre, #primer_apellido, #username, #email, #cargo, #turno').each(function() {
                    // Limpiar cualquier mensaje de error previo
                    clearErrors($(this));
                    if (!$(this).val() || $(this).val() === 'Seleccionar') {
                        isValid = false;
                        showError($(this), 'Este campo es obligatorio.');
                    }
                });

                // Si algún campo no es válido, prevenimos el envío
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
        </script>
<?= $this->endSection() ?>
