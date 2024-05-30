<?php

function connection(){
    $host = "localhost";
    $user = "";
    $pass = "";
    $bd = "control_escolar_db";

    $conn = mysqli_connect($host, $user, $pass, $bd);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $conn;
}

$conn = connection();

?>
