<?php
// Conexión a la base de datos
include("connection.php");
$con = connection();

// Obtener la matrícula del alumno desde el parámetro GET
$matricula = $_GET['matricula'];

// Consulta para obtener las materias en las que el alumno está inscrito, con su profesor y calificación
$sql = "SELECT 
           m.clave_materia,
           m.nombre_materia,
           m.num_semestre,
           m.creditos,
           m.calificacion,
           p.nombre AS nombre_profesor
        FROM 
           materias m
        LEFT JOIN 
           profesores p 
        ON 
           m.profesor_id = p.profesor_id
        WHERE 
           m.alumno_matricula = '$matricula'";

$query = mysqli_query($con, $sql);

if (!$query) {
    die("Error en la consulta: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Incluye Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Materias y Calificaciones del Alumno</title>

    <!-- Script para impresión -->
    <script>
        function printTable() {
            window.print(); // Imprime la página
        }
    </script>
</head>
<body>
<div class="container my-4">
        <h2>Materias y Calificaciones</h2>
        <h4>Matrícula: <?= htmlspecialchars($matricula) ?></h4> <!-- Usa htmlspecialchars para seguridad -->
        <button onclick="window.print()" class="btn btn-primary">Imprimir</button> <!-- Botón para imprimir -->
        <table class="table table-striped mt-3"> <!-- Clase Bootstrap para la tabla -->
            <thead>
                <tr>
                    <th>Clave de Materia</th>
                    <th>Nombre de la Materia</th>
                    <th>Semestre</th>
                    <th>Créditos</th>
                    <th>Calificación</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['clave_materia']) ?></td>
                        <td><?= htmlspecialchars($row['nombre_materia']) ?></td>
                        <td><?= htmlspecialchars($row['num_semestre']) ?></td>
                        <td><?= htmlspecialchars($row['creditos']) ?></td>
                        <td><?= htmlspecialchars($row['calificacion']) ?></td>
                        <td><?= htmlspecialchars($row['nombre_profesor']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Incluye Bootstrap JS y dependencias si necesitas funcionalidades adicionales -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>