// Inicializar select2 con jQuery
$(document).ready(function () {
    $('.select-with-search').select2({
        width: '100%',
        placeholder: 'Seleccionar',
        allowClear: true
    });

    // Activar o desactivar el botón cuando cambia el empleado
    $('#employee_id').on('change', function () {
        const hasValue = !!this.value;
        $('#nextStep').prop('disabled', !hasValue);

        // Solo ocultar si se está limpiando (clear)
        if (!hasValue) {
            // Usar setTimeout para evitar conflicto con scroll de Select2
            setTimeout(() => {
                $('#employeeDataContainer').addClass('d-none');
            }, 10);
        }
    });

    // Manejar específicamente el "clear" de Select2
    $('#employee_id').on('select2:unselect', function () {
        $('#employeeDataContainer').addClass('d-none');
        $('#nextStep').prop('disabled', true);
    });
    
    // Mostrar datos y deshabilitar el botón
    $('#nextStep').on('click', function () {
        const selected = $('#employee_id option:selected');

        const primerNombre = selected.data('primer-nombre') || '';
        const segundoNombre = selected.data('segundo-nombre') || '';
        const primerApellido = selected.data('primer-apellido') || '';
        const segundoApellido = selected.data('segundo-apellido') || '';
        const fechaIngreso = selected.data('fecha-ingreso') || '';
        const employeeCedula = selected.data('cedula') || '';
        const employeeNivel = selected.data('nivel') || '';

        $('#primerNombre').val(primerNombre);
        $('#primerNombreHidden').val(primerNombre);

        $('#segundoNombre').val(segundoNombre);
        $('#segundoNombreHidden').val(segundoNombre);

        $('#primerApellido').val(primerApellido);
        $('#primerApellidoHidden').val(primerApellido);

        $('#segundoApellido').val(segundoApellido);
        $('#segundoApellidoHidden').val(segundoApellido);

        $('#employeeCedula').val(employeeCedula);
        $('#employeeCedulaHidden').val(employeeCedula);

        $('#fechaIngreso').val(fechaIngreso);
        $('#fechaIngresoHidden').val(fechaIngreso);

        $('#employeeNivel').val(employeeNivel);
        $('#employeeNivelHidden').val(employeeNivel);

        $('#employeeDataContainer').removeClass('d-none');

        // Deshabilitar el botón después de consultar
        $(this).prop('disabled', true);
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const dataContainer = document.getElementById('employeeDataContainer');

    form.addEventListener('reset', function () {
        // Ocultar el contenedor de datos del empleado
        dataContainer.classList.add('d-none');

        // Limpiar los campos manualmente (si hace falta)
        const fieldsToClear = [
            'cargoFunciones',
            'codigoCargo',
            'dependencia',
            'codigoDependencia',
            'sueldoMensual'
        ];

        fieldsToClear.forEach(id => {
            const field = document.getElementById(id);
            if (field) field.value = '';
        });

        // También podrías resetear Select2 si lo deseas
        $('#employee_id').val(null).trigger('change');

        // Deshabilitar el botón "Siguiente"
        document.getElementById('nextStep').setAttribute('disabled', 'disabled');

        $(form).find('input, select, textarea').each(function () {
            clearErrors($(this));
        });
    });
});