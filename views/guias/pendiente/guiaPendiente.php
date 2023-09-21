<?php
session_start();
$ruta = 8;
$titulo = "Guías Pendientes | CargoCaribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// require_once(ROOT . "/models/Base.php");
// require_once(ROOT . "/models/Product.php");
// $product = new Product;

?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    $page = "Guías | Pendientes";
    require_once $rutaLocal . "/includes/navbar.php";
    require_once $rutaLocal . "/includes/sidebar.php";
    ?>

    <div class="content-wrapper py-3">
      <div class="content-header w-75 mx-auto">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-12">
              <h1 class="m-0"><?= $page ?></h1>
            </div>
            <div class="col-12">
              <div class="table-sm" id="divGuiasPendientes">
                <table id="lista_guias_pendientes">
                  <thead class="bg_primary text-white">
                    <tr>
                      <th class="col-6 border border_primary p-1">#</th>
                      <th class="col-6 border border_primary p-1">Destinatario</th>
                      <th class="col-6 border border_primary p-1">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once $rutaLocal . "/includes/scripts.php";
  ?>
  <script src="js/functions_guias_pendientes.js"></script>
</body>

</html>