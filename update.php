<?php 
    include("connection.php");
    $con=connection();

    $matricula=$_GET['matricula'];

    $sql="SELECT * FROM alumnos WHERE matricula='$matricula'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <title>Editar usuarios</title>
        
    </head>
    <body>
        <div class="users-form">
            <form action="edit_user.php" method="POST">
                <input type="hidden" name="matricula" value="<?= $row['matricula']?>">
                <input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre']?>">
                <input type="text" name="apellido" placeholder="Apellidos" value="<?= $row['apellido']?>">
                <input type="text" name="email" placeholder="Email" value="<?= $row['email']?>">
                <input type="number" name="semestre" placeholder="Semestre" value="<?= $row['semestre']?>">
                <input type="text" name="sede_subsede" placeholder="Sede-Subsede" value="<?= $row['sede_subsede']?>">
                <input type="text" name="curp" placeholder="CURP" required value="<?= $row['curp']?>">
                <input type="text" name="lugar_nacimiento" placeholder="Lugar de Nacimiento" value="<?= $row['lugar_nacimiento']?>">
                <p style="text-align:start;">Fecha de nacimiento:</p>
                <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" value="<?= $row['fecha_nacimiento']?>">
                <input type="text" name="edad" placeholder="Edad" value="<?= $row['edad']?>">
                <label for="genero" style="text-align:start;">Género:</label>
                <select id="genero" name="genero" value="<?= $row['genero']?>">
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
                </select>
                <input type="text" name="estado_civil" placeholder="Estado Civil" value="<?= $row['estado_civil']?>">
                <input type="text" name="domicilio_particular" placeholder="Domicilio Particular" value="<?= $row['domicilio_particular']?>">
                <input type="number" name="telefono_celular" placeholder="Teléfono Celular" value="<?= $row['telefono_celular']?>">
                <input type="number" name="telefono_fijo" placeholder="Teléfono fijo" value="<?= $row['telefono_fijo']?>">
                <input type="text" name="escuela_de_procedencia" placeholder="Escuela de Procedencia" value="<?= $row['escuela_de_procedencia']?>">
                <input type="text" name="ubicacion_de_escuela" placeholder="Ubicación de escuela" value="<?= $row['ubicacion_de_escuela']?>">
                <select id="status" name="status">
                    <option value="activo">Activo</option>
                    <option value="baja">Baja</option>
                </select>

                <input type="submit" value="Actualizar">
            </form>
        </div>
    </body>
</html>