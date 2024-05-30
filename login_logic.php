<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include("connection.php");
$con = connection();

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Limpiar y validar los datos del formulario
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontró un usuario con el correo electrónico proporcionado
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $row['contrasena'])) {
            // Iniciar sesión y redirigir al usuario según su rol
            $_SESSION['user_name'] = $row['nombre'];
            $_SESSION['user_role'] = $row['user_type'];

            if ($_SESSION['user_role'] == 'administrador') {
                $_SESSION['admin_name'] = $row['nombre']; // Asegúrate de establecer esta sesión
                header('Location: index.php'); // Redirigir al panel de administrador
                exit();
            } elseif ($_SESSION['user_role'] == 'profesor') {
                header('Location: welcome_professor.php'); // Redirigir al panel de profesor
                exit();
            }
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado.";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
