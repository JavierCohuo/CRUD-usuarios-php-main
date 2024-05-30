<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit;
}

include("connection.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario para asignar maestría y materia a un profesor
    if (isset($_POST['profesor_id']) && isset($_POST['maestria_id']) && isset($_POST['materia_id'])) {
        $profesor_id = $_POST['profesor_id'];
        $maestria_id = $_POST['maestria_id'];
        $materia_id = $_POST['materia_id'];

        // Insertar la asignación en la tabla de relaciones
        $sql_insert_asignacion = "INSERT INTO materias (profesor_id, maestria_id) VALUES ($profesor_id, $maestria_id)";
        mysqli_query($con, $sql_insert_asignacion);
    }

    // Procesar el formulario para insertar un nuevo profesor
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

        // Insertar el nuevo profesor en la tabla de profesores
        $sql_insert_profesor = "INSERT INTO profesores (nombre) VALUES ('$nombre')";
        mysqli_query($con, $sql_insert_profesor);
    }

    // Procesar el formulario para agregar una nueva maestría
    if (isset($_POST['nombre_maestria'])) {
        $nombre_maestria = $_POST['nombre_maestria'];

        // Insertar la nueva maestría en la tabla de maestrías
        $sql_insert_maestria = "INSERT INTO maestrias (nombre_maestria) VALUES ('$nombre_maestria')";
        mysqli_query($con, $sql_insert_maestria);
    }

    // Procesar el formulario para agregar una nueva materia
    if (isset($_POST['nombre_materia'])) {
        $nombre_materia = $_POST['nombre_materia'];

        // Insertar la nueva materia en la tabla de materias
        $sql_insert_materia = "INSERT INTO materias (nombre_materia) VALUES ('$nombre_materia')";
        mysqli_query($con, $sql_insert_materia);
    }
}

// Consultar la información de los profesores
$sql_profesores = "SELECT * FROM profesores";
$query_profesores = mysqli_query($con, $sql_profesores);

// Consultar la información de las maestrías
$sql_maestrias = "SELECT * FROM maestrias";
$query_maestrias = mysqli_query($con, $sql_maestrias);

// Consultar la información de las materias
$sql_materias = "SELECT * FROM materias";
$query_materias = mysqli_query($con, $sql_materias);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profesores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="content">
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
            <p>Manejo de Profesores</p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear Profesor</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                            <a href="alumnos.php" class="btn btn-secondary">Ir a alumnos</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Agregar Maestría</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombre_maestria" class="form-control" placeholder="Nombre de la Maestría">
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Agregar Materia</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombre_materia" class="form-control" placeholder="Nombre de la Materia">
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Asignacion de Maestrías y Materias a Profesores</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <select name="profesor_id" class="form-control">
                                    <option value="">Selecciona un Profesor</option>
                                    <?php while ($row_profesor_select = mysqli_fetch_array($query_profesores)): ?>
                                        <option value="<?= $row_profesor_select['profesor_id'] ?>"><?= $row_profesor_select['nombre'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="maestria_id" class="form-control">
                                    <option value="">Selecciona una Maestría</option>
                                    <?php mysqli_data_seek($query_maestrias, 0); ?>
                                    <?php while ($row_maestria_select = mysqli_fetch_array($query_maestrias)): ?>
                                        <option value="<?= $row_maestria_select['maestria_id'] ?>"><?= $row_maestria_select['nombre_maestria'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="materia_id" class="form-control">
                                    <option value="">Selecciona una Materia</option>
                                    <?php mysqli_data_seek($query_materias, 0); ?>
                                    <?php while ($row_materia_select = mysqli_fetch_array($query_materias)): ?>
                                        <option value="<?= $row_materia_select['clave_materia'] ?>"><?= $row_materia_select['nombre_materia'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Profesores registrados</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Profesor ID</th>
                                    <th>Nombre</th>
                                    <th>Maestría Asignada</th>
                                    <th>Materia Asignada</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Reiniciamos el apuntador del resultado
                                mysqli_data_seek($query_profesores, 0);
                                while ($row_profesor = mysqli_fetch_array($query_profesores)): ?>
                                    <tr>
                                        <td><?= $row_profesor['profesor_id'] ?></td>
                                        <td><?= $row_profesor['nombre'] ?></td>
                                        <td>
                                            <?php
                                            // Consultar las maestrías asignadas al profesor
                                            $profesor_id = $row_profesor['profesor_id'];
                                            $sql_maestrias_asignadas = "SELECT * FROM maestrias WHERE maestria_id IN (SELECT maestria_id FROM materias WHERE profesor_id = $profesor_id)";
                                            $query_maestrias_asignadas = mysqli_query($con, $sql_maestrias_asignadas);
                                            while ($row_maestria = mysqli_fetch_array($query_maestrias_asignadas)) {
                                                echo $row_maestria['nombre_maestria'] . "<br>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            // Consultar las materias asignadas al profesor
                                            $sql_materias_asignadas = "SELECT * FROM materias WHERE clave_materia IN (SELECT clave_materia FROM maestria_materias WHERE profesor_id = $profesor_id)";
                                            $query_materias_asignadas = mysqli_query($con, $sql_materias_asignadas);
                                            while ($row_materia = mysqli_fetch_array($query_materias_asignadas)) {
                                                echo $row_materia['nombre_materia'] . "<br>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="update_profesor.php?profesor_id=<?= $row_profesor['profesor_id'] ?>" class="btn btn-primary">Editar</a>
                                            <a href="delete_profesor.php?profesor_id=<?= $row_profesor['profesor_id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este profesor?')">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
