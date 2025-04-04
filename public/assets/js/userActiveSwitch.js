const switchInput = document.getElementById('userActiveSwitch');
const label = document.getElementById('userStatusLabel');

const updateStatus = () => {
    const isChecked = switchInput.checked;

    label.textContent = isChecked ? 'Usuario activo' : 'Usuario inactivo';

    // Remover ambas clases primero
    label.classList.remove('status-activo', 'status-inactivo');

    // Agregar la clase correspondiente
    label.classList.add(isChecked ? 'status-activo' : 'status-inactivo');
};

// Inicializar estado por si acaso
updateStatus();

// Escuchar cambios del switch
switchInput.addEventListener('change', updateStatus);