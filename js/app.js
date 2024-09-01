document.getElementById('validate-button').addEventListener('click', function() {
    const cell = document.getElementById('cell').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;

    // Validación básica
    if (!cell || !startDate || !endDate) {
        alert('Por favor, complete todos los campos para filtrar las etiquetas.');
        return;
    }

    // Aquí puedes agregar más lógica de validación si es necesario.
    // Agregar los datos validados a la tabla (esto es solo un ejemplo básico)
    const table = document.getElementById('results-table').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();

    newRow.insertCell(0).textContent = '123456'; // Etiqueta (ejemplo)
    newRow.insertCell(1).textContent = cell;
    newRow.insertCell(2).textContent = '987654'; // # de parte (ejemplo)
    newRow.insertCell(3).textContent = '100'; // Cantidad (ejemplo)
    newRow.insertCell(4).textContent = 'CAJA'; // Pieza por caja (ejemplo)
    newRow.insertCell(5).textContent = 'E'; // Empaque (ejemplo)
    newRow.insertCell(6).textContent = 'MMXPR1286'; // Impresora (ejemplo)
    newRow.insertCell(7).textContent = 'T2'; // Turno (ejemplo)
    newRow.insertCell(8).textContent = startDate; // Fecha
    newRow.insertCell(9).textContent = '12:00:00'; // Hora (ejemplo)

    // Limpiar los campos del formulario después de agregar la fila
    document.getElementById('filter-form').reset();
});

document.getElementById('download-report').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Agregar título y encabezados
    doc.text('Reporte de Etiquetas', 14, 20);
    doc.text('Etiqueta', 14, 40);
    doc.text('Celda', 44, 40);
    doc.text('# de Parte', 74, 40);
    doc.text('Cantidad', 104, 40);
    doc.text('Pieza por Caja', 134, 40);
    doc.text('Empaque', 164, 40);
    doc.text('Impresora', 194, 40);
    doc.text('Turno', 224, 40);
    doc.text('Fecha', 254, 40);
    doc.text('Hora', 284, 40);
    doc.line(10, 43, 290, 43); // Línea horizontal debajo de los encabezados

    const rows = document.querySelectorAll('#results-table tbody tr');
    let yPosition = 50;

    // Agregar las filas de la tabla al PDF
    rows.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        doc.text(cells[0].innerText, 14, yPosition); // Etiqueta
        doc.text(cells[1].innerText, 44, yPosition); // Celda
        doc.text(cells[2].innerText, 74, yPosition); // # de Parte
        doc.text(cells[3].innerText, 104, yPosition); // Cantidad
        doc.text(cells[4].innerText, 134, yPosition); // Pieza por Caja
        doc.text(cells[5].innerText, 164, yPosition); // Empaque
        doc.text(cells[6].innerText, 194, yPosition); // Impresora
        doc.text(cells[7].innerText, 224, yPosition); // Turno
        doc.text(cells[8].innerText, 254, yPosition); // Fecha
        doc.text(cells[9].innerText, 284, yPosition); // Hora

        yPosition += 10;
    });

    // Guardar el PDF
    doc.save('reporte_etiquetas.pdf');
});
