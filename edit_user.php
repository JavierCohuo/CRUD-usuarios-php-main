<?php

include("connection.php");
$con = connection();

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$semestre = $_POST['semestre'];
$sede_subsede = $_POST['sede_subsede'];
$curp = $_POST['curp'];
$lugar_nacimiento = $_POST['lugar_nacimiento'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$estado_civil = $_POST['estado_civil'];
$domicilio_particular = $_POST['domicilio_particular'];
$telefono_celular = $_POST['telefono_celular'];
$telefono_fijo = $_POST['telefono_fijo'];
$escuela_de_procedencia = $_POST['escuela_de_procedencia'];
$ubicacion_de_escuela = $_POST['ubicacion_de_escuela'];
$status = $_POST['status'];

$sql = "UPDATE alumnos SET 
        nombre='$nombre', 
        apellido='$apellido', 
        email='$email', 
        genero='$genero', 
        semestre='$semestre', 
        sede_subsede='$sede_subsede', 
        curp='$curp', 
        lugar_nacimiento='$lugar_nacimiento', 
        fecha_nacimiento='$fecha_nacimiento', 
        edad='$edad', 
        estado_civil='$estado_civil', 
        domicilio_particular='$domicilio_particular', 
        telefono_celular='$telefono_celular', 
        telefono_fijo='$telefono_fijo', 
        escuela_de_procedencia='$escuela_de_procedencia', 
        ubicacion_de_escuela='$ubicacion_de_escuela',
        status='$status'
        WHERE matricula='$matricula'";

$sql = "UPDATE alumnos SET status='$status' WHERE matricula='$matricula'";

$query = mysqli_query($con, $sql);

if ($query) {
    echo "Datos actualizados correctamente.";
    echo '<br><a href="index.php">Regresar</a>';
} else {
    echo "Error al actualizar los datos: " . mysqli_error($con);
}

?>