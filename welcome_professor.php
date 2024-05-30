<?php
session_start();

if(!isset($_SESSION['user_name'])){
header('location:login.php');
exit;
}

include("connection.php");
$con = connection();



$sql = "SELECT * FROM alumnos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/style.css" rel="stylesheet">
    <title>Users CRUD</title>
</head>

<body>
    <script src="search_students.js"></script>
    <div class="content">
        <h3>hi, <span>user</span></h3>
        <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
        <p>this is an user page</p>
        <a href="logout.php" class="btn">cerrar sesion</a>
    </div>
    <div class="users-form">
        <h1>Crear Alumno</h1>
        <form action="insert_user.php" method="POST">
            <input type="text" name="matricula" placeholder="Matricula">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="apellido" placeholder="Apellidos">
            <input type="email" name="email" placeholder="Email">
            <input type="number" name="semestre" placeholder="Semestre">
            <label for="sede_subsede" style="text-align:start;">Sede-Subsede</label>
            <select id="sede_subsede" name="sede_subsede">
            <option value="Campeche">Campeche</option>
            <option value="Calkiní">Calkiní</option>
            </select>
            <input type="text" name="curp" placeholder="CURP" required>
            <label for="lugar_nacimiento" style="text-align:start;">Estado de Nacimiento:</label>
            <select name="lugar_nacimiento" id="lugar_nacimiento">
                <option value="Aguascalientes">Aguascalientes</option>
                <option value="Baja California">Baja California</option>
                <option value="Baja California Sur">Baja California Sur</option>
                <option value="Campeche">Campeche</option>
                <option value="Chiapas">Chiapas</option>
                <option value="Chihuahua">Chihuahua</option>
                <option value="Ciudad de México">Ciudad de México</option>
                <option value="Coahuila">Coahuila</option>
                <option value="Colima">Colima</option>
                <option value="Durango">Durango</option>
                <option value="Estado de México">Estado de México</option>
                <option value="Guanajuato">Guanajuato</option>
                <option value="Guerrero">Guerrero</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Jalisco">Jalisco</option>
                <option value="Michoacán">Michoacán</option>
                <option value="Morelos">Morelos</option>
                <option value="Nayarit">Nayarit</option>
                <option value="Nuevo León">Nuevo León</option>
                <option value="Oaxaca">Oaxaca</option>
                <option value="Puebla">Puebla</option>
                <option value="Querétaro">Querétaro</option>
                <option value="Quintana Roo">Quintana Roo</option>
                <option value="San Luis Potosí">San Luis Potosí</option>
                <option value="Sinaloa">Sinaloa</option>
                <option value="Sonora">Sonora</option>
                <option value="Tabasco">Tabasco</option>
                <option value="Tamaulipas">Tamaulipas</option>
                <option value="Tlaxcala">Tlaxcala</option>
                <option value="Veracruz">Veracruz</option>
                <option value="Yucatán">Yucatán</option>
                <option value="Zacatecas">Zacatecas</option>
            </select>
            <p style="text-align:start;">Fecha de nacimiento:</p>
            <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento">
            <input type="text" name="edad" placeholder="Edad">
            <label for="genero" style="text-align:start;">Género:</label>
            <select id="genero" name="genero">
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
            </select>
            <input type="text" name="estado_civil" placeholder="Estado Civil">
            <input type="text" name="domicilio_particular" placeholder="Domicilio Particular">
            <input type="number" name="telefono_celular" placeholder="Teléfono Celular">
            <input type="number" name="telefono_fijo" placeholder="Teléfono fijo">
            <input type="text" name="escuela_de_procedencia" placeholder="Escuela de Procedencia">
            <input type="text" name="ubicacion_de_escuela" placeholder="Ubicación de escuela">

            <input type="submit" value="Agregar">
            <a href="profesores.php">Ir a profesores</a>
        </form>
    </div>


    <div class="users-table">
        <h2>Alumnos registrados</h2>
        <input type="text" name="search_student" placeholder="Escriba un nombre o matricula para buscar" style="font-size:16px; width:50%">
        <table>
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <th><?= $row['matricula'] ?></th>
                        <th><?= $row['nombre'] ?></th>
                        <th><?= $row['apellido'] ?></th>
                        <th><?= $row['email'] ?></th>
                        <th><a href="update.php?matricula=<?= $row['matricula'] ?>" class="users-table--edit">Editar</a></th>
                        <th>
                            <form action="update_student_status.php" method="POST">
                                <input type="hidden" name="matricula" value="<?= $row['matricula'] ?>">
                                <select name="status">
                                    <option value="activo" <?= $row['status'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                                    <option value="baja" <?= $row['status'] == 'baja' ? 'selected' : '' ?>>Baja</option>
                                </select>
                                <button type="submit">Guardar</button>
                            </form>
                        </th>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container">

</div>

</body>

</html>