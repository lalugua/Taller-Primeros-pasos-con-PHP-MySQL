



<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="/Pagina/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN LTA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
   
        <div class="info">
          <p class="text-white"><?php echo  $_SESSION['usu_nombre']; ?>
          </p>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="usuario.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Usuarios
                </p>
                </a>
              </li>
          <li class="nav-item">
              <a href="menu.php" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Menus</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="Social_Media.php" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Social Media</p>
              </a>
          </li>
          </li>
          <li class="nav-item">
              <a href="experiencia.php" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Experiencia</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="estudios.php" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Estudios</p>
              </a>
          </li>

        </li>
      
          <li class="nav-header">SALIR</li>
          <li class="nav-item">
            <form action="/Pagina/logout.php" method="GET" style="display: inline;">
              <button type="submit" class="nav-link" style="background: none; border: none; ; cursor: pointer;">
                <i class="nav-icon fas fa-th"></i>
                <p>Cerrar Sesion</p>
              </button>
            </form>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  
