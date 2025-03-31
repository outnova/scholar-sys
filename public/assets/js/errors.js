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