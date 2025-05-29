const select = document.getElementById('record_type');
const nextBtn = document.getElementById('nextStep');
const backBtn = document.getElementById('goBack');
const wizardContainer = document.getElementById('wizardContainer');

let selectedType = '';

select.addEventListener('change', function () {
    selectedType = this.options[this.selectedIndex].dataset.type;
    nextBtn.disabled = false;
});

nextBtn.addEventListener('click', function () {
    if (!selectedType) return;

    // Ocultar todos los formularios
    document.querySelectorAll('.form-section').forEach(el => el.classList.remove('active'));

    // Mostrar el correspondiente
    const selectedForm = document.getElementById(`form-${selectedType}`);
    if (selectedForm) {
        selectedForm.classList.add('active');
    }

    // Mover a la derecha
    wizardContainer.style.transform = 'translateX(-50%)';
});

backBtn.addEventListener('click', function () {
    wizardContainer.style.transform = 'translateX(0)';
});