const select = document.getElementById('record_type');
const nextBtn = document.getElementById('nextStep');

let selectedType = '';

select.addEventListener('change', function () {
    selectedType = this.options[this.selectedIndex].dataset.type;
    nextBtn.disabled = false;
});

nextBtn.addEventListener('click', function () {
    if (!selectedType) return;
    window.location.href = `/records/create/${selectedType}`;
});