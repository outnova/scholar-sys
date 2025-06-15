function validateField(field, force = false) {
    const element = $(field.selector);
    const value = element.val()?.trim() ?? '';

    // Solo validar si se forzó o si el campo ya fue tocado
    if (!force && !element.data('touched')) {
        return true; // No mostrar errores todavía
    }

    clearErrors(element);

    if (field.required && !value) {
        showError(element, 'Este campo es obligatorio.');
        return false;
    }

    if (value && field.pattern && !field.pattern.test(value)) {
        showError(element, field.errorMsg);
        return false;
    }

    if (value && typeof field.customValidate === 'function' && !field.customValidate(value)) {
        showError(element, field.errorMsg);
        return false;
    }

    return true;
}

$(document).ready(function () {
    const slug = $('form').data('record-type');

    const configs = {
        'trabajo': [
            {
                selector: '#cargoFunciones',
                required: true,
                pattern: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-]+$/,
                errorMsg: 'Solo letras, números, espacios y símbolos / -'
            },
            {
                selector: '#codigoCargo',
                required: true,
                pattern: /^[a-zA-Z0-9]+$/,
                errorMsg: 'Solo letras y números sin espacios.'
            },
            {
                selector: '#dependencia',
                required: true,
                pattern: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-."”]+$/,
                errorMsg: 'Solo letras, números, espacios y símbolos / - ".'
            },
            {
                selector: '#codigoDependencia',
                required: true,
                pattern: /^\d+$/,
                errorMsg: 'Solo números.'
            },
            {
                selector: '#sueldoMensual',
                required: true,
                pattern: /^\d+([.,]\d{1,2})?$/,
                errorMsg: 'Número positivo con hasta 2 decimales (ej. 908,88).'
            }
        ],
        'estudio':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#edad',
                required: true,
                pattern: /^\d{1,2}$/,
                errorMsg: 'Debe contener solo números (1 a 2 dígitos).'
            },
            {
                selector: '#birthcity',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#seccion',
                required: true,
                pattern: /^[a-zA-Z]$/,
                errorMsg: 'Solo una letra (A-Z o a-z).'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            }
        ],
        'inscripcion':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#edad',
                required: true,
                pattern: /^\d{1,2}$/,
                errorMsg: 'Debe contener solo números (1 a 2 dígitos).'
            },
            {
                selector: '#birthcity',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#seccion',
                required: true,
                pattern: /^[a-zA-Z]$/,
                errorMsg: 'Solo una letra (A-Z o a-z).'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            }
        ],
        'buena-conducta':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#seccion',
                required: true,
                pattern: /^[a-zA-Z]$/,
                errorMsg: 'Solo una letra (A-Z o a-z).'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            }
        ],
        'retiro':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#seccion',
                required: true,
                pattern: /^[a-zA-Z]$/,
                errorMsg: 'Solo una letra (A-Z o a-z).'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            },
            {
                selector: '#rprimerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rprimerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#r-cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#motivo',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{1,45}$/,
                errorMsg: 'Solo se permiten letras y espacios, máximo 45 caracteres.'
            }
        ],
        'retiro-conducta':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#seccion',
                required: true,
                pattern: /^[a-zA-Z]$/,
                errorMsg: 'Solo una letra (A-Z o a-z).'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            },
            {
                selector: '#rprimerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rprimerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#r-cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#motivo',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{1,45}$/,
                errorMsg: 'Solo se permiten letras y espacios, máximo 45 caracteres.'
            },
        ],
        'aceptacion-cupo':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#grado',
                required: true,
                pattern: /^[a-zA-Z0-9ñÑ ]+$/,
                errorMsg: 'Solo letras, números y espacios.'
            },
            {
                selector: '#periodoEscolar',
                required: true,
                pattern: /^(20\d{2})-(20\d{2})$/,
                errorMsg: 'Debe tener el formato 2024-2025 y los años deben ser consecutivos.',
                customValidate: function(value) {
                    const match = value.match(/^(20\d{2})-(20\d{2})$/);
                    if (!match) return false;
                    const anioInicio = parseInt(match[1], 10);
                    const anioFin = parseInt(match[2], 10);
                    return anioFin === anioInicio + 1;
                }
            },
            {
                selector: '#rprimerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rprimerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#rsegundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#r-cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#edad',
                required: true,
                pattern: /^\d{1,2}$/,
                errorMsg: 'Debe contener solo números (1 a 2 dígitos).'
            },
        ],
        'pasantias':
        [
            {
                selector: '#primerNombre',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoNombre',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#primerApellido',
                required: true,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#segundoApellido',
                required: false,
                pattern: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
                errorMsg: 'Debe contener solo letras'
            },
            {
                selector: '#cedula',
                required: true,
                pattern: /^\d{7,15}$/,
                errorMsg: 'Debe contener solo números (7 a 15 dígitos).'
            },
            {
                selector: '#fechaInicio',
                required: true,
                errorMsg: 'La fecha de inicio es obligatoria.'
            },
            {
                selector: '#fechaFin',
                required: true,
                errorMsg: 'La fecha de finalización es obligatoria o la fecha de finalización no puede ser igual/anterior a la de inicio.',
                customValidate: function(value) {
                    const inicio = document.querySelector('#fechaInicio')?.value;
                    if (!inicio || !value) return false;

                    const fechaInicio = new Date(inicio);
                    const fechaFin = new Date(value);

                    return fechaFin > fechaInicio;
                },
            }
        ],
    };

    const config = configs[slug];
    if (!config) return;

    // Validar solo cuando el usuario interactúe
    config.forEach(field => {
        const el = $(field.selector);

        // Marcar como "tocado" al empezar a escribir o cambiar
        el.on('input change', function () {
            el.data('touched', true);
            validateField(field);
            toggleSubmitButton();
        });
    });

    // Validar todo en el submit
    $('form').on('submit', function (e) {
        let allValid = true;
        config.forEach(field => {
            const valid = validateField(field, true); // Forzar validación completa
            if (!valid) allValid = false;
        });

        if (!allValid) e.preventDefault();
    });

    function toggleSubmitButton() {
        let allValid = true;
        config.forEach(field => {
            const valid = validateField(field);
            if (!valid) allValid = false;
        });
        $('button[type="submit"]').prop('disabled', !allValid);
    }

    toggleSubmitButton();
});