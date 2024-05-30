<?php
session_start();

// Conexión a la base de datos
@include 'connection.php';

// Inicializa un nuevo arreglo de errores
$errors = [];

if (isset($_POST['submit'])) {
   // Limpia la entrada del usuario
   $name = mysqli_real_escape_string($conn, $_POST['nombre']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['contrasena'];
   $cpass = $_POST['ccontrasena'];
   $user_type = $_POST['user_type'];

   // Verifica si el usuario ya existe
   $select = "SELECT * FROM users WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $errors[] = 'El usuario ya existe';
   } else {
      // Compara contraseñas sin cifrado
      if ($pass !== $cpass) {
         $errors[] = 'Las contraseñas no coinciden';
      } else {
         // Usa password_hash() para cifrar contraseñas
         $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

         // Inserta el nuevo usuario
         $insert = "INSERT INTO users (nombre, email, contrasena, user_type) 
                     VALUES ('$name', '$email', '$hashed_pass', '$user_type')";

         if (mysqli_query($conn, $insert)) {
            header('Location: login.php');
            exit(); // detiene ejecución después del redireccionamiento
         } else {
            $errors[] = 'Error al registrar el usuario';
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Regístrate</title>
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Regístrate</h3>
      <?php
      // Muestra errores si existen
      if (!empty($errors)) {
         foreach ($errors as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
         }
      }
      ?>
      <input type="text" name="nombre" required placeholder="Ingresa tu nombre">
      <input type="email" name="email" required placeholder="Ingresa tu email">
      <input type="password" name="contrasena" required placeholder="Ingresa tu contraseña">
      <input type="password" name="ccontrasena" required placeholder="Confirma tu contraseña">
      <select name="user_type">
         <option value="profesor">Profesor</option>
         <option value="administrador">Administrador</option>
      </select>
      <input type="submit" name="submit" value="Registrarse" class="form-btn">
      <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
   </form>
</div>

</body>
</html>