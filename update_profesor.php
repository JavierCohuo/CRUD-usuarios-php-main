<?php 
include("connection.php");
$con = connection();

if(isset($_GET['profesor_id'])) {
    $profesor_id = $_GET['profesor_id'];

    $sql = "SELECT * FROM profesores WHERE profesor_id='$profesor_id'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
    } else {
        echo "No se encontró ningún profesor con el ID proporcionado.";
        exit; // Salir del script si no se encuentra ningún profesor
    }
} else {
    echo "Error: No se proporcionó el ID del profesor.";
    exit; // Salir del script si no se proporciona el ID del profesor
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <title>Editar profesores</title>
</head>
<body>
    <h1>Editar</h1>
    <div class="users-form">
        <form action="edit_profesor.php" method="POST">
            <input type="hidden" name="profesor_id" value="<?= $row['profesor_id'] ?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>">

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>