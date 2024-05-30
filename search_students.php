<?php
// search_students.php

// Incluir el archivo de conexión a la base de datos
include("connection.php");
$con = connection();

// Verificar si se ha enviado un término de búsqueda
if(isset($_POST['search'])) {
    $search = $_POST['search'];

    // Realizar la consulta SQL para buscar alumnos cuyo nombre o matrícula coincidan con el término de búsqueda
    $sql = "SELECT * FROM alumnos WHERE nombre LIKE '%$search%' OR matricula LIKE '%$search%'";
    $query = mysqli_query($con, $sql);

    // Construir la tabla HTML con los resultados de la búsqueda
    $output = '';
    while ($row = mysqli_fetch_array($query)) {
        $output .= '<tr style="background-color: #f8f8f8; border: 1px solid #ddd;">';
        $output .= '<td style="padding: 4px;">' . $row['matricula'] . '</td>';
        $output .= '<td style="padding: 4px;">' . $row['nombre'] . '</td>';
        $output .= '<td style="padding: 4px;">' . $row['apellido'] . '</td>';
        $output .= '<td style="padding: 4px;">' . $row['email'] . '</td>';
        $output .= '<td style="padding: 4px;"><a href="update.php?matricula=' . $row['matricula'] . '" style="background: #009688; padding: 6px; color: #fff; text-align: center; font-weight: bold; text-decoration: none;">Editar</a></td>';
        $output .= '<td style="padding: 4px;">
                        <form action="update_student_status.php" method="POST">
                            <input type="hidden" name="matricula" value="' . $row['matricula'] . '">
                            <select name="status">
                                <option value="activo" ' . ($row['status'] == 'activo' ? 'selected' : '') . '>Activo</option>
                                <option value="baja" ' . ($row['status'] == 'baja' ? 'selected' : '') . '>Baja</option>
                            </select>
                            <button type="submit" style="border: none; padding: 6px; background: #009688; color: #fff; font-weight: bold; cursor: pointer;">Guardar</button>
                        </form>
                    </td>';
        $output .= '</tr>';
    }

    // Enviar los resultados de vuelta al script JavaScript como respuesta
    echo $output;
}
?>