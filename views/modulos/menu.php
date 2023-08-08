<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="inicio" style="width: 50%;padding: 0;"><img src="views/images/auth/logotenta.png" alt="Tentaculon" /></a>
    <a class="sidebar-brand brand-logo-mini" href="inicio"><img src="views/images/auth/logotenta2.png" alt="Tentaculon" /></a>
  </div>
  <br>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <!-- <div class="profile-pic" style="width: 100%;">
          <div class="profile-name" style="width: 100%; margin: 0;">
            <h5 class="mb-0 font-weight-normal" style="white-space: normal;"><?php echo $_SESSION['nombres'] ?></h5>
            <span><?php echo $_SESSION['tipo_trabajador'] ?></span>
          </div>
        </div> -->
        <!-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a> -->
        <!-- <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown"> 
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>-->
      </div>
    </li>
    <!-- <li class="nav-item nav-category">
      <span class="nav-link">Navegación</span>
    </li> -->
    <!--Dashboard-->
    <li class="nav-item menu-items">
      <a class="nav-link" href="inicio">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Inicio</span>
      </a>
    </li>

    <?php if ($_SESSION["tipo_trabajador"] == "Administrador General") { ?>
      <!--modulo Pesona-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-account"></i>
          </span>
          <span class="menu-title">Personal</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Empleados">Empleados</a></li>
            <li class="nav-item"> <a class="nav-link" href="Postulantes">Postulantes</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Empleado">Empleados Local</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Usuarios">Usuarios</a></li>
          </ul>
        </div>
      </li>

      <!--modulo Local-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#local" aria-expanded="false" aria-controls="local">
          <span class="menu-icon">
            <i class="mdi  mdi-archive"></i>
          </span>
          <span class="menu-title">Local</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="local">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Local">Sedes</a></li>
            <li class="nav-item"> <a class="nav-link" href="Clientefre">Clientes Frecuentes</a></li>
            <li class="nav-item"> <a class="nav-link" href="Cocina">Cocina</a></li>
            <li class="nav-item"> <a class="nav-link" href="Ventas">Ventas</a></li>

            <li class="nav-item"> <a class="nav-link" href="Inventario-Bebidas">Inventario Bebidas</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Local-Platos">Plato Local</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Bebidas">Bebida Local</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Mesa">Mesas Local</a></li>
          </ul>
        </div>
      </li>

      <!--modulo categoria plato-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#categoria" aria-expanded="false" aria-controls="categoria">
          <span class="menu-icon">
            <i class="mdi mdi-application"></i>
          </span>
          <span class="menu-title">Productos</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="categoria">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Categoria-Platos">Categoria Platos</a></li>
            <li class="nav-item"> <a class="nav-link" href="Platos">Platos</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Bebidas">Bebidas</a></li>
          </ul>
        </div>
      </li>

      <!-- Delivery-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#mockup" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-bike"></i>
          </span>
          <span class="menu-title">Delivery</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mockup">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pedidos-entregados">Pedidos Entregados</a></li>
            <li class="nav-item"> <a class="nav-link" href="Motorizado">Motorizado</a></li>
            <li class="nav-item"> <a class="nav-link" href="pedidosdelivery">Pedidos Delivery</a></li>
          </ul>
        </div>
      </li>

    <?php }else if ($_SESSION["tipo_trabajador"] == "Administrador") { ?>
      <!--modulo Pesona-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-account"></i>
          </span>
          <span class="menu-title">Personal</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Empleados">Empleados</a></li>
            <li class="nav-item"> <a class="nav-link" href="Postulantes">Postulantes</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Empleado">Empleados Local</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Usuarios">Usuarios</a></li>
          </ul>
        </div>
      </li>

      <!--modulo Local-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#local" aria-expanded="false" aria-controls="local">
          <span class="menu-icon">
            <i class="mdi mdi-archive"></i>
          </span>
          <span class="menu-title">Local</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="local">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Local">Sedes</a></li>
            <li class="nav-item"> <a class="nav-link" href="Clientefre">Clientes Frecuentes</a></li>
            <li class="nav-item"> <a class="nav-link" href="caja">Caja</a></li>
            <li class="nav-item"> <a class="nav-link" href="Cocina">Cocina</a></li>
            <li class="nav-item"> <a class="nav-link" href="Upcaja">Atenciones en Curso</a></li>
            <li class="nav-item"> <a class="nav-link" href="Ventas">Ventas</a></li>

            <li class="nav-item"> <a class="nav-link" href="Inventario-Bebidas">Inventario Bebidas</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Local-Platos">Plato Local</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Bebidas">Bebida Local</a></li>
            <li class="nav-item"> <a class="nav-link" href="Local-Mesa">Mesas Local</a></li>
          </ul>
        </div>
      </li>

      <!--modulo categoria plato-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#categoria" aria-expanded="false" aria-controls="categoria">
          <span class="menu-icon">
            <i class="mdi mdi-application"></i>
          </span>
          <span class="menu-title">Productos</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="categoria">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Categoria-Platos">Categoria Platos</a></li>
            <li class="nav-item"> <a class="nav-link" href="Platos">Platos</a></li>
          </ul>
          <hr class="my-0">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Bebidas">Bebidas</a></li>
          </ul>
        </div>
      </li>

      <!-- Delivery-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#mockup" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-bike"></i>
          </span>
          <span class="menu-title">Delivery</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mockup">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pedidos-entregados">Pedidos Entregados</a></li>
            <li class="nav-item"> <a class="nav-link" href="Motorizado">Motorizado</a></li>
            <li class="nav-item"> <a class="nav-link" href="pedidosdelivery">Pedidos Delivery</a></li>
          </ul>
        </div>
      </li>

    <?php } else if ($_SESSION["tipo_trabajador"] == "Counte en caja") { ?>
      <!--modulo Local-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#local" aria-expanded="false" aria-controls="local">
          <span class="menu-icon">
            <i class="mdi mdi-archive"></i>
          </span>
          <span class="menu-title">Local</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="local">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="caja">Caja</a></li>
            <li class="nav-item"> <a class="nav-link" href="Upcaja">Atenciones en Curso</a></li>
            <li class="nav-item"> <a class="nav-link" href="Ventas">Ventas</a></li>
          </ul>
        </div>
      </li>

    <?php } else if ($_SESSION["tipo_trabajador"] == "Jefe de Cocina") { ?>
      <!--modulo Local-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#local" aria-expanded="false" aria-controls="local">
          <span class="menu-icon">
            <i class="mdi mdi-archive"></i>
          </span>
          <span class="menu-title">Local</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="local">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="Cocina">Cocina</a></li>
          </ul>
        </div>
      </li>

    <?php } else if ($_SESSION["tipo_trabajador"] == "Delivery motorizado") { ?>
      <!-- Delivery-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#mockup" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-bike"></i>
          </span>
          <span class="menu-title">Delivery</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mockup">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pedidos-entregados">Pedidos Entregados</a></li>
            <li class="nav-item"> <a class="nav-link" href="Motorizado">Motorizado</a></li>
          </ul>
        </div>
      </li>

    <?php } else if ($_SESSION["tipo_trabajador"] == "Mozo/Azafata") { ?>
      <!--modulo Local-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#local" aria-expanded="false" aria-controls="local">
          <span class="menu-icon">
            <i class="mdi mdi-archive"></i>
          </span>
          <span class="menu-title">Local</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="local">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="caja">Caja</a></li>
            <li class="nav-item"> <a class="nav-link" href="Upcaja">Atenciones en Curso</a></li>
            <li class="nav-item"> <a class="nav-link" href="Ventas">Ventas</a></li>
        </div>
      </li>

      <!-- Delivery-->
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#mockup" aria-expanded="false" aria-controls="user">
          <span class="menu-icon">
            <i class="mdi mdi-bike"></i>
          </span>
          <span class="menu-title">Delivery</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mockup">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pedidosdelivery">Pedidos Delivery</a></li>
          </ul>
        </div>
      </li>
    <?php } ?>
  </ul>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="views/images/auth/logotenta2.png" alt="logo" style="height: 100%;width: 100%" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
            <div class="navbar-profile">
              <img class="img-xs rounded-circle" src="views/images/auth/user.jpg" alt="">
              <p class="mb-0 d-none d-sm-block navbar-profile-name"> <?php echo $_SESSION['nombres'] ?></p>
              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
            <h6 class="p-3 mb-0">Usuario</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="salir">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Cerrar Sesión</p>
              </div>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>