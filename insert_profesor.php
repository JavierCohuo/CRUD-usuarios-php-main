<?php
include("connection.php");
$con = connection();

$nombre = $_POST['nombre'];

$sql = "INSERT INTO profesores ( nombre) VALUES ('$nombre')";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: profesores.php");
}else{

}

?>