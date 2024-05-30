<?php
include("connection.php");
$con = connection();

$matricula = $_POST['matricula'];
$status = $_POST['status'];

$sql = "UPDATE alumnos SET status='$status' WHERE matricula='$matricula'";
$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: index.php");
    exit;
} else {
    echo "Error al actualizar el estado: " . mysqli_error($con);
}
?>