<?php
include("connection.php");
$con = connection();

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$genero = $_POST['genero']; // También obtenemos el género
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

$sql = "INSERT INTO alumnos (matricula, nombre, apellido, email, genero, semestre, sede_subsede, curp, lugar_nacimiento, fecha_nacimiento, edad, estado_civil, domicilio_particular, telefono_celular, telefono_fijo, escuela_de_procedencia, ubicacion_de_escuela) VALUES ('$matricula', '$nombre', '$apellido', '$email', '$genero', '$semestre', '$sede_subsede', '$curp', '$lugar_nacimiento', '$fecha_nacimiento', '$edad', '$estado_civil', '$domicilio_particular', '$telefono_celular', '$telefono_fijo', '$escuela_de_procedencia', '$ubicacion_de_escuela')";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: index.php");
}else{

}

?>