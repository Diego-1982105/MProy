// catalog.js

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Ocultar todo el contenido de las pestañas
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        tabcontent[i].classList.remove("active");
    }

    // Quitar la clase 'active' de todos los botones de las pestañas
    tablinks = document.getElementsByClassName("tab-button");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Mostrar la pestaña actual y agregar la clase 'active' al botón clicado
    document.getElementById(tabName).style.display = "block";
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}

// Funcionalidad del botón de regreso
document.getElementById('back-button').addEventListener('click', function() {
    window.history.back();
});

// Función para guardar datos de celda
function saveCell() {
    const cellId = document.getElementById('cell-id').value;
    const cellName = document.getElementById('cell-name').value;
    const cellDescription = document.getElementById('cell-description').value;

    if (!cellId || !cellName || !cellDescription) {
        alert('Por favor, completa todos los campos antes de guardar.');
        return;
    }

    // Aquí iría la lógica para guardar los datos en el backend
    alert('Celda guardada correctamente.');
}

// Función para guardar datos de turno
function saveShift() {
    const shiftId = document.getElementById('turno-id').value;
    const shiftName = document.getElementById('shift').value;
    const shiftDescription = document.getElementById('shift-description').value;
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;

    if (!shiftId || !shiftName || !shiftDescription || !startTime || !endTime) {
        alert('Por favor, completa todos los campos antes de guardar.');
        return;
    }

    // Aquí iría la lógica para guardar los datos en el backend
    alert('Turno guardado correctamente.');
}
