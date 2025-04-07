document.addEventListener("DOMContentLoaded", function () {
    if (typeof flashMessages !== "undefined") {
        const showAlert = (icon, title, text, options = {}) => {
            Swal.fire({
                icon,
                title,
                text,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                ...options
            }).then(result => {
                if (options.thenReload) {
                    location.reload();
                }
            });
        };

        if (flashMessages.success && window.location.href !== flashMessages.homeUrl) {
            showAlert('success', '¡Éxito!', flashMessages.success);
        }

        if (flashMessages.passwordUpdated) {
            showAlert('success', '¡Éxito!', flashMessages.passwordUpdated);
        }

        if (flashMessages.userUpdated) {
            showAlert('success', '¡Éxito!', flashMessages.userUpdated, { thenReload: true });
        }

        if (flashMessages.tempPassword) {
            Swal.fire({
                icon: 'success',
                title: '¡Usuario registrado!',
                text: 'El usuario ha sido registrado correctamente. La contraseña temporal generada es: ' + flashMessages.tempPassword,
                showCancelButton: true,
                confirmButtonText: 'Copiar',
                cancelButtonText: 'Cerrar',
                preConfirm: () => {
                    return navigator.clipboard.writeText(flashMessages.tempPassword)
                        .then(() => Swal.fire('¡Contraseña copiada!', '', 'success'))
                        .catch(() => Swal.fire('Error al copiar', '', 'error'));
                }
            });
        }
    }
});