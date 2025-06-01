document.getElementById('form-store').addEventListener('submit', function(e) {
    e.preventDefault(); // prevenir envío inmediato

    Swal.fire({
        title: 'Generar Constancia',
        text: "Asegúrate de que la opción de ventanas emergentes esté habilitada en tu navegador web para poder visualizar el PDF correctamente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();  // Enviar formulario si confirma
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelado',
                text: 'La acción fue cancelada.',
                icon: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
});