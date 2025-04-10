$(document).ready(function () {
    const $form = $('form');
    const $submitButton = $form.find('button[type="submit"]');
    const initialData = {};

    // Guardar valores iniciales de todos los campos
    $form.find('input, textarea, select').each(function () {
        const $el = $(this);
        initialData[$el.attr('id')] = $el.val();
    });

    // Deshabilitar el botón al cargar
    $submitButton.prop('disabled', true);

    // Función que compara los valores actuales con los iniciales
    function checkForChanges() {
        let hasChanges = false;
        $form.find('input, textarea, select').each(function () {
            const $el = $(this);
            const id = $el.attr('id');
            if ($el.val() !== initialData[id]) {
                hasChanges = true;
                return false; // Salir del each
            }
        });

        $submitButton.prop('disabled', !hasChanges);
    }

    // Escuchar cambios en todos los inputs, textareas y selects
    $form.find('input, textarea, select').on('input change', checkForChanges);
});