function togglePassword(inputId, iconId) {
    var inputField = document.getElementById(inputId);
    var icon = document.getElementById(iconId);

    if (inputField.type === "password") {
        inputField.type = "text";
        icon.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Icono de ojo tachado
    } else {
        inputField.type = "password";
        icon.innerHTML = '<i class="bi bi-eye"></i>'; // Icono de ojo abierto
    }
}