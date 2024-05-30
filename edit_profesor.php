<?php
include("connection.php");
$con = connection();

// Verifica si se ha enviado el profesor_id a través de POST
if(isset($_POST['profesor_id'])) {
    $profesor_id = $_POST['profesor_id'];
}
// Si no se ha enviado a través de POST, verifica si se ha pasado a través de GET
elseif(isset($_GET['profesor_id'])) {
    $profesor_id = $_GET['profesor_id'];
}
else {
    // Si no se proporciona el profesor_id, puedes manejar el error aquí
    echo "Error: No se proporcionó el ID del profesor.";
    exit; // Salir del script
}

$nombre = $_POST['nombre'];

$sql = "UPDATE profesores SET nombre='$nombre' WHERE profesor_id = $profesor_id";
$query = mysqli_query($con, $sql);

if($query){
    header("Location: profesores.php");
    exit; // Salir del script después de redireccionar
} else {
    echo "Error al actualizar el profesor.";
}
?>