// Inicializar select2 con jQuery
$(document).ready(function () {
    $('.select-with-search').select2({
        width: '100%',
        placeholder: 'Seleccionar',
        allowClear: true
    });

    // Activar el botón "Siguiente" cuando se seleccione un empleado
    $('#employee_id').on('change', function () {
        $('#nextStep').prop('disabled', !this.value);
    });

    // Lógica para mostrar los datos al hacer clic en "Siguiente"
    $('#nextStep').on('click', function () {
        const selected = $('#employee_id option:selected');

        const primerNombre = selected.data('primer-nombre') || '';
        const segundoNombre = selected.data('segundo-nombre') || '';
        const primerApellido = selected.data('primer-apellido') || '';
        const segundoApellido = selected.data('segundo-apellido') || '';
        const fechaIngreso = selected.data('fecha-ingreso') || '';
        const employeeCedula = selected.data('cedula') || '';
        const employeeNivel = selected.data('nivel') || '';

        const nombreCompleto = `${primerNombre} ${segundoNombre} ${primerApellido} ${segundoApellido}`.replace(/\s+/g, ' ').trim();

        $('#nombreCompleto').val(nombreCompleto);
        $('#nombreCompletoHidden').val(nombreCompleto);

        $('#employeeCedula').val(employeeCedula);
        $('#employeeCedulaHidden').val(employeeCedula);

        $('#fechaIngreso').val(fechaIngreso);
        $('#fechaIngresoHidden').val(fechaIngreso);

        $('#employeeNivel').val(employeeNivel);
        $('#employeeNivelHidden').val(employeeNivel);

        $('#employeeDataContainer').removeClass('d-none');
    });
});