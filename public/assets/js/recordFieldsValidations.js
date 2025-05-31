function validateField(field) {
    const element = $(field.selector);
    const value = element.val()?.trim() ?? '';

    clearErrors(element);

    if (field.required && !value) {
        showError(element, 'Este campo es obligatorio.');
        return false;
    }

    if (value && field.pattern && !field.pattern.test(value)) {
        showError(element, field.errorMsg);
        return false;
    }

    return true;
}

$(document).ready(function() {
    const slug = $('form').data('record-type');
    
    // Configuraciones por tipo
    const configs = {
    'trabajo': [
        {
            selector: '#cargoFunciones',
            required: true,
            pattern: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-"”]+$/,
            errorMsg: 'Solo letras, números, espacios y símbolos / - ".'
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
            pattern: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-"”]+$/,
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
        // ...
    ],
    constanciaTipo2: [
            // campos específicos para tipo 2
        ],
        // etc...
    };

    const config = configs[slug];
    if (!config) return;

    // Agrega el listener para validar en tiempo real
    config.forEach(field => {
        $(field.selector).on('input', () => {
            validateField(field);
            toggleSubmitButton();
        });
    });

    // Validar todo al enviar
    $('form').on('submit', function(e) {
        let allValid = true;
        config.forEach(field => {
            if (!validateField(field)) allValid = false;
        });
        if (!allValid) e.preventDefault();
    });

    // Función para habilitar o deshabilitar el botón submit según validaciones
    function toggleSubmitButton() {
        let allValid = true;
        config.forEach(field => {
            if (!validateField(field)) allValid = false;
        });
        $('button[type="submit"]').prop('disabled', !allValid);
    }

    // Ejecuta una vez al cargar para bloquear si es necesario
    toggleSubmitButton();
});
