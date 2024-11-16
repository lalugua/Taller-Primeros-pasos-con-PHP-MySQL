<?php
/*TODO: Llamando Cadena de Conexion */
require_once("../config/conexion.php");

if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    echo 'prueba';
    require_once("../models/Usuario.php");
    /*TODO: Inicializando Clase */
    $usuario = new Usuario();
    $usuario->login();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <?php require_once("modulos/css.php"); ?> 
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in para iniciar tu sesion</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <input type="hidden"enviar name="enviar" value="si">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
        if(isset($_GET["m"])){
            switch($_GET["m"]){
                case "1";
                ?>
                <div class="alert alert-danger" role="alert">
                    Los datos ingresados son incorrectos!
                </div>
                <?php
                break;
                case "2";
                ?>
                <div class="alert alert-warning" role="alert">
                    El formulario tiene los campos vacíos!
                </div>
                <?php
                break;
            }
        }
        ?>

   
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<?php require_once("modulos/js.php"); ?>  
</html>
