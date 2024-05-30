<?php
@include("connection.php");
$con = connection();

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
    exit;
}

$sql = "SELECT * FROM alumnos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="search_students.js"></script>
    <title>Usuarios CRUD</title>
</head>
<body>

    <!-- Navbar con Bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Administrador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profesores.php">Profesores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal con Bootstrap 5 -->
    <div class="container my-4 text-center">
        <h3>Hola, <span>admin</span></h3>
        <h1>Bienvenido, <span><?php echo $_SESSION['admin_name'] ?></span></h1>
        <p>Página de administrador</p>
        <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a>
    </div>

    <div class="container my-4">
        <h1>Crear Alumno</h1>
        <form action="insert_user.php" method="POST" class="form-group">
            <input type="text" name="matricula" class="form-control my-2" placeholder="Matrícula" required>
            <input type="text" name="nombre" class="form-control my-2" placeholder="Nombre" required>
            <input type="text" name="apellido" class="form-control my-2" placeholder="Apellidos" required>
            <input type="email" name="email" class="form-control my-2" placeholder="Email" required>
            <input type="number" name="semestre" class="form-control my-2" placeholder="Semestre" required>
            <label for="sede_subsede" class="form-label">Sede-Subsede</label>
            <select id="sede_subsede" name="sede_subsede" class="form-select" required>
                <option value="Campeche">Campeche</option>
                <option value="Calkiní">Calkiní</option>
            </select>
            <input type="text" name="curp" class="form-control my-2" placeholder="CURP" required>
            <label for="lugar_nacimiento" style="text-align:start;">Estado de Nacimiento:</label>
            <select name="lugar_nacimiento" id="lugar_nacimiento" class="form-select" required>
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
            <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" required >
            <input type="text" name="edad" placeholder="Edad" required >
            <label for="genero" style="text-align:start;">Género:</label>
            <select id="genero" name="genero" required>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
            </select>
            <input type="text" name="estado_civil" placeholder="Estado Civil" required >
            <input type="text" name="domicilio_particular" placeholder="Domicilio Particular" required >
            <input type="number" name="telefono_celular" placeholder="Teléfono Celular" required >
            <input type="number" name="telefono_fijo" placeholder="Teléfono fijo" required >
            <input type="text" name="escuela_de_procedencia" placeholder="Escuela de Procedencia" required >
            <input type="text" name="ubicacion_de_escuela" placeholder="Ubicación de escuela" required >
            <input type="submit" value="Agregar" class="btn btn-primary mt-2" required >
            <a href="profesores.php" class="btn btn-secondary mt-2">Ir a Profesores</a>
        </form>
    </div>

    <div class="container my-4 users-table">
    <h2>Alumnos Registrados</h2>
    <input type="text" name="search_student" class="form-control" placeholder="Buscar por nombre o matrícula">
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['matricula'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['apellido'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td>
                        <a href="update.php?matricula=<?= $row['matricula'] ?>" class="btn btn-warning">Editar</a>
                        <a href="view_grades.php?matricula=<?= $row['matricula'] ?>" class="btn btn-info">Ver Calificaciones</a> <!-- Botón para ver calificaciones -->
                        <form action="update_student_status.php" method="POST" style="display: inline;">
                            <input type="hidden" name="matricula" value="<?= $row['matricula'] ?>">
                            <select name="status" class="form-select" style="display: inline;">
                                <option value="activo" <?= $row['status'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                                <option value="baja" <?= $row['status'] == 'baja' ? 'selected' : '' ?>>Baja</option>
                            </select>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

    <!-- Incluir JavaScript de Bootstrap 5 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>