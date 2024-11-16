<?php
define("BASE_URL", "/pagina/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <?php require_once("modulos/css.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php require_once("modulos/header.php"); ?>
  <?php require_once("modulos/menu.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Administracion</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12 col-12">
          <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center">
                    <?php 
                        echo $_SESSION["usu_nombre"];
                    ?>

                </h3>

                <p class="text-muted text-center">

                <?php 
                        echo $_SESSION["usu_correo"];
                    ?>

                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Home</b></a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- ./col -->
 
          <!-- ./col -->
        </div>
      </div>
      <!-- Default box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once("modulos/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php require_once("modulos/js.php"); ?>


</body>
</html>


<?php
} else {
    /* Si no ha iniciado sesión se redireccionará a la ventana principal */
    header("Location:" . Conectar::ruta() . "views/404.php");
}
?>

