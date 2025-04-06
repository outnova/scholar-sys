$(document).ready(function() {
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