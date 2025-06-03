$(document).ready(function () {
    const validationRules = {
        system_name: {
            regex: /^[a-zA-Z\s]{1,16}$/,
            message: 'El nombre del sistema solo puede contener letras sin acentos, espacios y un máximo de 16 caracteres.'
        },
        school_name: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ"]{1,64}$/,
            message: 'El nombre de la escuela solo puede contener letras, espacios, puntos, comillas y un máximo de 64 caracteres.'
        },
        dea_code: {
            regex: /^[A-Z0-9]{9,15}$/,
            message: 'El código DEA debe contener entre 9 y 15 caracteres alfanuméricos (solo mayúsculas y números).'
        },
        depend_code: {
            regex: /^[0-9]{9,15}$/,
            message: 'El código de dependencia debe contener entre 9 y 15 dígitos numéricos.'
        },
        school_address: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/,
            message: 'La dirección solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.'
        },
        school_longcity: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,100}$/,
            message: 'El nombre de la escuela solo puede contener letras, espacios, comas y un máximo de 100 caracteres.'
        },
        school_shortcity: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,64}$/,
            message: 'El nombre de la escuela solo puede contener letras, espacios, comas y un máximo de 64 caracteres.'
        },
        school_footeraddress: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/,
            message: 'La dirección del pie de página solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.'
        },
        school_footercity: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,100}$/,
            message: 'El nombre de la ciudad del pie de página solo puede contener letras, espacios, comas y un máximo de 100 caracteres.'
        },
        school_phone: {
            regex: /^[0-9]{10,13}$/,
            message: 'El teléfono debe contener entre 10 y 13 dígitos numéricos.'
        },
        school_email: {
            regex: /\S+@\S+\.\S+/,
            message: 'El correo electrónico no tiene un formato válido.'
        },
        principal_name: {
            regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ]{1,64}$/,
            message: 'El nombre del director solo puede contener letras, espacios, puntos y un máximo de 64 caracteres.'
        },
        principal_ci: {
            regex: /^[0-9]{6,9}$/,
            message: 'La cédula debe contener entre 6 y 9 dígitos numéricos.'
        },
        principal_phone: {
            regex: /^[0-9]{10,13}$/,
            message: 'El teléfono debe contener entre 10 y 13 dígitos numéricos.'
        },
    };

    // Aplica validación a cada campo al escribir
    $.each(validationRules, function (fieldId, rule) {
        $(`#${fieldId}`).on('input', function () {
            const value = $(this).val();
            clearErrors($(this));
            if (!rule.regex.test(value)) {
                showError($(this), rule.message);
            }
        });
    });

    // Validación al enviar el formulario
    $('form').on('submit', function (event) {
        let isValid = true;

        $.each(validationRules, function (fieldId, rule) {
            const $field = $(`#${fieldId}`);
            const value = $field.val();

            clearErrors($field);

            if (!value) {
                isValid = false;
                showError($field, 'Este campo es obligatorio.');
                return;
            }

            if (!rule.regex.test(value)) {
                isValid = false;
                showError($field, rule.message);
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});