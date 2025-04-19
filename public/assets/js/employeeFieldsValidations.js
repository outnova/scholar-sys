$(document).ready(function() {
    // Validación de cédula
    $('#cedula').on('input', function () {
        var cedula = $(this).val();
        clearErrors($(this));
        if (!/^[0-9]{6,9}$/.test(cedula)) {
            showError($(this), 'La cédula debe contener entre 6 y 9 dígitos numéricos.');
        }
    });

    // Validaciones comunes para nombres y apellidos
    function validateLettersOnly(element, fieldName) {
        var value = element.val();
        clearErrors(element);
        if (value && !/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/.test(value)) {
            showError(element, `El ${fieldName} solo puede contener letras y espacios.`);
        }
    }

    $('#primer_nombre').on('input', function () {
        validateLettersOnly($(this), 'primer nombre');
    });

    $('#segundo_nombre').on('input', function () {
        validateLettersOnly($(this), 'segundo nombre');
    });

    $('#primer_apellido').on('input', function () {
        validateLettersOnly($(this), 'primer apellido');
    });

    $('#segundo_apellido').on('input', function () {
        validateLettersOnly($(this), 'segundo apellido');
    });

    // Validación de fecha de ingreso
    $('#fecha_ingreso').on('change', function () {
        var fecha = new Date($(this).val());
        var hoy = new Date();
        clearErrors($(this));

        if (!$(this).val()) {
            showError($(this), 'La fecha de ingreso es obligatoria.');
        } else if (fecha > hoy) {
            showError($(this), 'La fecha de ingreso no puede ser posterior a hoy.');
        }
    });

    // Validación de nivel
    $('#nivel').on('change', function () {
        var nivel = $(this).val();
        clearErrors($(this));
        if (!nivel || nivel === 'Seleccionar') {
            showError($(this), 'El nivel es obligatorio.');
        }
    });

    // Validación de cargo
    $('#cargo').on('change', function () {
        var cargo = $(this).val();
        clearErrors($(this));
        if (!cargo || cargo === 'Seleccionar') {
            showError($(this), 'El cargo es obligatorio.');
        }
    });

    // Validación de turno
    $('#turno').on('change', function () {
        var turno = $(this).val();
        clearErrors($(this));
        if (!turno || turno === 'Seleccionar') {
            showError($(this), 'El turno es obligatorio.');
        }
    });

    // Validación al enviar el formulario
    $('form').on('submit', function (event) {
        var isValid = true;

        // Campos obligatorios básicos
        $('#cedula, #primer_nombre, #primer_apellido, #fecha_ingreso, #nivel, #cargo, #turno').each(function () {
            clearErrors($(this));
            if (!$(this).val() || $(this).val() === 'Seleccionar') {
                isValid = false;
                showError($(this), 'Este campo es obligatorio.');
            }
        });

        // Validación adicional: fecha de ingreso no puede ser futura
        var fecha = new Date($('#fecha_ingreso').val());
        var hoy = new Date();
        if (fecha > hoy) {
            isValid = false;
            showError($('#fecha_ingreso'), 'La fecha de ingreso no puede ser posterior a hoy.');
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});