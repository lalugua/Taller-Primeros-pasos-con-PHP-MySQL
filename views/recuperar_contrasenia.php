<?php
require_once("../config/conexion.php");

if (isset($_POST["enviar"]) && $_POST["enviar"] == "si") {
  require_once("../models/Usuario.php");
  $usuario = new Usuario();
  $correo = $_POST["correo"];
  $passwd = $_POST["passwd"];
  
  if (!empty($correo) && !empty($passwd)) {
      $resultado = $usuario->restablecer_contrasena($correo, $passwd);
      if ($resultado) {
          header("Location: recuperar_contrasenia.php?m=1"); // Éxito
      } else {
          header("Location: recuperar_contrasenia.php?m=2"); // Error
      }
  } else {
      header("Location: recuperar_contrasenia.php?m=3"); // Campos vacíos
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restablecer Contraseña</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
    
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Coloque su correo y la contraseña nueva</p>

        <form action="recuperar_contrasenia.php" method="post">
        <label for="email">Correo:</label> <br>
          <div class="input-group mb-3">
            
            <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <label for="email">Contraseña nueva:</label> <br>
          <div class="input-group mb-3">
          
            <input type="password" name="passwd" class="form-control" placeholder="Nueva contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="enviar" value="si">
              <button type="submit" class="btn btn-primary btn-block">Restablecer</button>
            </div>
          </div>
        </form>

        <!-- Alertas de mensaje -->
        <?php
        if (isset($_GET["m"])) {
          switch ($_GET["m"]) {
            case "1":
              echo '<div class="alert alert-success mt-3" role="alert">¡Contraseña actualizada con éxito!</div>
                        <a href="/Pagina/views/login.php" class="btn btn-success btn-block">Iniciar Sesion</a>
               ';
              break;
            case "2":
              echo '<div class="alert alert-danger mt-3" role="alert">El correo no existe o hubo un error.</div>';
              break;
            case "3":
              echo '<div class="alert alert-warning mt-3" role="alert">Todos los campos son obligatorios.</div>';
              break;
          }
        }
        ?>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3/dist/js/adminlte.min.js"></script>
</body>

</html>
