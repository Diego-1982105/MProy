<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Sistema de Etiquetado</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    
</head>
<body>
    <header>
        <button id="back-button">
            <i class="fas fa-arrow-left"></i> Regresar
        </button>
        <h1>Sistema de Etiquetado</h1>
    </header>

    <main>
        <section class="filter-section">
            <h2>Filtrar Etiquetas</h2>
            <form id="filter-form">
                <label for="cell">Celda de Ensamble:</label>
                <select id="cell" name="cell" required>
                    <option value="" disabled selected>Seleccione una celda</option>
                    <option value="celda1">Celda 1</option>
                    <option value="celda2">Celda 2</option>
                
                </select>

                <label for="start-date">Fecha Inicial:</label>
                <input type="date" id="start-date" name="start-date" required>

                <label for="end-date">Fecha Final:</label>
                <input type="date" id="end-date" name="end-date" required>

                <button type="submit">Filtrar</button>
            </form>
            <br>        
        <section class="report-section">
           <button id="validate-button">Validar Datos</button> 
           <button id="download-report">Descargar Reporte PDF</button>
            
        </section>
        </section>

        <section class="results-section">
            <h2>Resultados</h2>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magnarfs";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
session_start();

// Consulta a la tabla "empleados"
$sql = "SELECT * FROM datos_celda";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Imprimir los registros en una tabla
    echo "<table class='table'>";
    echo "<tr><th>Etiqueta</th><th>Celda</th><th>Número de Parte</th><th>Cantidad</th><th>Pieza por Caja</th><th>Empaque</th>
    <th>Impresora</th><th>Turno</th><th>Fecha</th><th>Hora</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='registro'>" . $row["Etiqueta"] . "</td>";
        echo "<td class='registro'>" . $row["Celda"] . "</td>";
        echo "<td class='registro'>" . $row["Articulo"] . "</td>";
        echo "<td class='registro'>" . $row["Cantidad"] . "</td>";
        echo "<td class='registro'>" . $row["Paquete"] . "</td>";
        echo "<td class='registro'>" . $row["Tipo"] . "</td>";
        echo "<td class='registro'>" . $row["Impresora"] . "</td>";
        echo "<td class='registro'>" . $row["CharFecha"] . "</td>";
        echo "<td class='registro'>" . $row["CharFecha"] . "</td>";
        echo "<td class='registro'>" . $row["FechaEntrada"] . "</td>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros.";
}
// Cerrar la conexión
$conn->close();
?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Sistema de Etiquetado</p>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>
