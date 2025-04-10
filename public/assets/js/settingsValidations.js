$(document).ready(function () {
    // Nombre del Sistema (letras sin acentos, espacios, máximo 16 caracteres)
    $('#system_name').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/^[a-zA-Z\s]{1,16}$/.test(value)) {
            showError($(this), 'El nombre del sistema solo puede contener letras sin acentos, espacios y un máximo de 16 caracteres.');
        }
    });

    $('#school_name').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
    
        // Permite letras, acentos, espacios, puntos y comillas
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ"]{1,64}$/.test(value)) {
            showError($(this), 'El nombre de la escuela solo puede contener letras, espacios, puntos, comillas y un máximo de 64 caracteres.');
        }
    });

    // Verificación de Dirección (letras, espacios, puntos, comas, punto y coma, º, máx 200)
    $('#school_address').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/.test(value)) {
            showError($(this), 'La dirección solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.');
        }
    });

    // Teléfono (entre 10 y 13 dígitos)
    $('#school_phone').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/^[0-9]{10,13}$/.test(value)) {
            showError($(this), 'El teléfono debe contener entre 10 y 13 dígitos numéricos.');
        }
    });

    // Correo electrónico
    $('#school_email').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/\S+@\S+\.\S+/.test(value)) {
            showError($(this), 'El correo electrónico no tiene un formato válido.');
        }
    });

    // Nombre del Director (letras, espacios, tildes, puntos, máximo 64 caracteres)
    $('#principal_name').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ]{1,64}$/.test(value)) {
            showError($(this), 'El nombre del director solo puede contener letras, espacios, puntos y un máximo de 64 caracteres.');
        }
    });

    // Cédula del Director (6 a 9 dígitos)
    $('#principal_ci').on('input', function () {
        var value = $(this).val();
        clearErrors($(this));
        if (!/^[0-9]{6,9}$/.test(value)) {
            showError($(this), 'La cédula debe contener entre 6 y 9 dígitos numéricos.');
        }
    });

    // Validación al enviar formulario
    $('form').on('submit', function (event) {
        var isValid = true;

        $('#system_name, #school_name, #school_address, #school_phone, #school_email, #principal_name, #principal_ci').each(function () {
            clearErrors($(this));
            if (!$(this).val()) {
                isValid = false;
                showError($(this), 'Este campo es obligatorio.');
            }
            
            // Validaciones adicionales específicas para algunos campos
            if ($(this).attr('id') === 'system_name') {
                var systemName = $(this).val();
                if (!/^[a-zA-Z\s]{1,16}$/.test(systemName)) {
                    isValid = false;
                    showError($(this), 'El nombre del sistema solo puede contener letras sin acentos, espacios y un máximo de 16 caracteres.');
                }
            }

            if ($(this).attr('id') === 'school_name') {
                var schoolName = $(this).val();
                if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ"]{1,64}$/.test(schoolName)) {
                    isValid = false;
                    showError($(this), 'El nombre de la escuela solo puede contener letras, espacios, puntos, comillas y un máximo de 64 caracteres.');
                }
            }

            if ($(this).attr('id') === 'school_address') {
                var schoolAddress = $(this).val();
                if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/.test(schoolAddress)) {
                    isValid = false;
                    showError($(this), 'La dirección solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.');
                }
            }

            if ($(this).attr('id') === 'school_phone') {
                var phone = $(this).val();
                if (!/^[0-9]{10,13}$/.test(phone)) {
                    isValid = false;
                    showError($(this), 'El teléfono debe contener entre 10 y 13 dígitos numéricos.');
                }
            }

            if ($(this).attr('id') === 'school_email') {
                var email = $(this).val();
                if (!/\S+@\S+\.\S+/.test(email)) {
                    isValid = false;
                    showError($(this), 'El correo electrónico no tiene un formato válido.');
                }
            }

            if ($(this).attr('id') === 'principal_name') {
                var principalName = $(this).val();
                if (!/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ]{1,64}$/.test(principalName)) {
                    isValid = false;
                    showError($(this), 'El nombre del director solo puede contener letras, espacios, puntos y un máximo de 64 caracteres.');
                }
            }

            if ($(this).attr('id') === 'principal_ci') {
                var ci = $(this).val();
                if (!/^[0-9]{6,9}$/.test(ci)) {
                    isValid = false;
                    showError($(this), 'La cédula debe contener entre 6 y 9 dígitos numéricos.');
                }
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});