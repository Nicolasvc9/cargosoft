<?php
require_once "config.php";

if (isset($_SESSION['caribecargo']['permisos'])) {
  // Creamos un array para almacenar los nombres de los módulos como claves únicas
  $modulosPermitidos = array();
  $permisos = array();

  // Recorremos los permisos y guardamos los nombres de los módulos como claves únicas
  foreach ($_SESSION['caribecargo']['permisos'] as $permiso) {
    $modulo = $permiso[1];
    $permisos[] = $permiso[0];
    $modulosPermitidos[$modulo] = true;
  }
}
$rutaImagen = $rutaLocal . '/assets/img/';
if (file_exists($rutaImagen . 'logo_mini.png')) {
  $imagen =  '/assets/img/logo_mini.png';
} elseif (file_exists($rutaImagen . 'logo_mini.jpg')) {
  $imagen =  '/assets/img/logo_mini.jpg';
} else {
  $imagen = ""; // En caso de que no se encuentre ninguna de las dos imágenes
}
?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar bg_primary elevation-4 text_primary">
  <!-- Brand Logo -->
  <a href="/views/index.php" class="brand-link">
    <img src="<?= $imagen ?>" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
    <span class="text_primary"><?= $EMPRESA ?> </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block text_primary"><?= $_SESSION['caribecargo']['user']; ?></a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if (isset($modulosPermitidos['administrador'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-duotone fa-screwdriver-wrench text_primary"></i>
              <p class="text_primary">
                Administrador
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary bg_secondary">
              <?php if (in_array(1, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/configuracion/" class="nav-link text_primary">
                    <i class="fa-duotone fa-gears nav-icon text_primary"></i>
                    <p class="text_primary">Configuración</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Fragmento de código HTML para el módulo "Gestion Tablas" -->
        <?php if (isset($modulosPermitidos['tablas'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-duotone fa-users-gear text_primary"></i>
              <p class="text_primary">
                Gestion Tablas
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary bg_secondary">
              <?php if (in_array(2, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/ciudades/" class="nav-link text_primary">
                    <i class="fa-duotone fa-city text_primary"></i>
                    <p class="text_primary">Ciudades</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(3, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/clientes/" class="nav-link text_primary">
                    <i class="fa-duotone fa-users text_primary"></i>
                    <p class="text_primary">Clientes</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(4, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/productos/" class="nav-link text_primary">
                    <i class="fa-duotone fa-layer-group nav-icon text_primary"></i>
                    <p class="text_primary">Productos</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(5, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/rutas/" class="nav-link text_primary">
                    <i class="fa-duotone fa-map-location-dot text_primary"></i>
                    <p class="text_primary">Rutas</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(6, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/usuarios/" class="nav-link text_primary">
                    <i class="fa-duotone fa-users text_primary nav-icon"></i>
                    <p class="text_primary">Usuarios</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Fragmento de código HTML para el módulo "Guias" -->
        <?php if (isset($modulosPermitidos['guias'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-duotone fa-file text_primary"></i>
              <p class="text_primary">
                Guias
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary  bg_secondary">
              <?php if (in_array(7, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/guias/" class="nav-link text_primary">
                    <i class="fa-duotone fa-city text_primary"></i>
                    <p class="text_primary">Crear Guia</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(8, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/guias/pendiente/guiaPendiente.php" class="nav-link text_primary" disabled>
                    <i class="fa-duotone fa-users text_primary"></i>
                    <p class="text_primary">Guias Pendientes</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array(9, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/tablas/clientes/" class="nav-link text_primary" disabled>
                    <i class="fa-duotone fa-users text_primary"></i>
                    <p class="text_primary">Listar Guias</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>
        
        <!-- Fragmento de código HTML para el módulo "Prefactura" -->
        <?php if (isset($modulosPermitidos['guias'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-duotone fa-file-invoice text_primary"></i>
              <p class="text_primary">
                Prefactura
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary  bg_secondary">
              <?php if (in_array(7, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/prefactura/" class="nav-link text_primary">
                    <i class="fa-regular fa-file-pen text_primary"></i>
                    <p class="text_primary">Crear Prefactura</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Fragmento de código HTML para el módulo "Cartera" -->
        <?php if (isset($modulosPermitidos['guias'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-light fa-file-spreadsheet text_primary"></i>
              <p class="text_primary">
                Cartera
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary  bg_secondary">
              <?php if (in_array(7, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/cartera/" class="nav-link text_primary">
                    <i class="fa-light fa-file-chart-column text_primary"></i>
                    <p class="text_primary">Informes</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
            <ul class="nav nav-treeview  bg_secondary  bg_secondary">
              <?php if (in_array(7, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/cartera/control" class="nav-link text_primary">
                    <i class="fa-regular fa-table text_primary"></i>
                    <p class="text_primary">Control</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Fragmento de código HTML para el módulo "Pallet" -->
        <?php if (isset($modulosPermitidos['pallet'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-brands fa-avianex text_primary"></i>
              <p class="text_primary">
                Pallets
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary  bg_secondary">
              <?php if (in_array(10, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/pallet/" class="nav-link text_primary">
                    <i class="fa-duotone fa-city text_primary"></i>
                    <p class="text_primary">Incluir en Pallet</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Fragmento de código HTML para el módulo "Licad" -->
        <?php if (isset($modulosPermitidos['licad'])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-brands fa-avianex text_primary"></i>
              <p class="text_primary">
                Licad
                <i class="right fas fa-angle-left text_primary"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  bg_secondary">
              <?php if (in_array(11, $permisos)) : ?>
                <li class="nav-item">
                  <a href="/views/licad/" class="nav-link text_primary">
                    <i class="fa-duotone fa-city text_primary"></i>
                    <p class="text_primary">Crear Licad</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
            
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a href="/includes/salir.php" class="nav-link text_primary">
          <i class="fa-solid fa-power-off text_primary"></i>
            <p class="text_primary">Salir</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>