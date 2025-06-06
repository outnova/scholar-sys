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
        ]
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