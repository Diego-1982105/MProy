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

            // Crear la conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Iniciar sesión si es necesario
            session_start();

            // Variables de paginación
            $limit = 10; // Número de registros por página (ahora es 20)
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
            $offset = ($page - 1) * $limit; // Desplazamiento de la consulta

            // Consulta de registros con límite y paginación
            $sql = "SELECT Etiqueta, Celda, Articulo, Cantidad, Paquete, Tipo, Impresora, CharFecha, FechaEntrada 
                    FROM datos_celda 
                    LIMIT $limit OFFSET $offset";
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
                    echo "<td class='registro'>" . $row["FechaEntrada"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Contar el total de registros
                $total_sql = "SELECT COUNT(*) FROM datos_celda";
                $total_result = $conn->query($total_sql);
                $total_rows = $total_result->fetch_row()[0];
                $total_pages = ceil($total_rows / $limit);

                // Mostrar barra de estado y enlaces de paginación
                echo "<div class='pagination'>";
                
                // Botón de primera página
                if ($page > 1) {
                    echo "<a href='?page=1' class='page-link'>Primera</a> ";
                    echo "<a href='?page=" . ($page - 1) . "' class='page-link'>&laquo; Anterior</a> ";
                }

                // Mostrar el número de página actual y el total de páginas
                echo "<span>Página $page de $total_pages</span>";

                // Botón de siguiente página
                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "' class='page-link'>Siguiente &raquo;</a> ";
                    echo "<a href='?page=$total_pages' class='page-link'>Última</a>";
                }
                
                echo "</div>";

                // Formulario para ir a una página específica
                echo "<form method='GET' action='' class='jump-to-page'>";
                echo "<label for='page'>Ir a la página: </label>";
                echo "<input type='number' id='page' name='page' min='1' max='$total_pages' value='$page' required>";
                echo "<button type='submit'>Ir</button>";
                echo "</form>";
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
