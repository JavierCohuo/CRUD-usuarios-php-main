<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Iniciar Sesión</title>
   <!-- Incluye Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Agrega animaciones CSS para efectos suaves -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
   <!-- Estilos personalizados -->
   <style>
      .form-container {
         max-width: 400px;
         margin: 50px auto;
         background-color: #f7f7f7;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
         animation: fadeIn 1s;
      }
      .form-container h3 {
         text-align: center;
         color: #007aff;
      }
      .form-container .form-btn {
         background-color: #007aff;
         color: white;
         border: none;
         padding: 10px;
         border-radius: 5px;
         width: 100%;
      }
      .form-container .form-btn:hover {
         background-color: #005bb5;
      }
   </style>
</head>
<body class="bg-light">
   <div class="form-container animate__animated animate__fadeIn">
      <form action="login_logic.php" method="post">
         <h3>Iniciar Sesión</h3>
         <input type="email" name="email" required placeholder="Introduce tu email" class="form-control mb-3">
         <input type="password" name="contrasena" required placeholder="Introduce tu contraseña" class="form-control mb-3">
         <input type="submit" name="submit" value="Iniciar Sesión" class="form-btn">
         <p class="mt-3 text-center">¿No tienes una cuenta? <a href="register_form.php" style="color: #007aff;">Regístrate ahora</a></p>
      </form>
   </div>

   <!-- Incluye Bootstrap JS y Popper.js -->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
