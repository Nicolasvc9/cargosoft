<?php 
session_start();
$ruta = 2; 
  $titulo = "Ciudades | CargoCaribe";
  require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini" onload="getCiudades()">
  <div class="wrapper">
    <?php 
      $page = "Ciudades";
      require_once $rutaLocal."/includes/navbar.php";
      require_once $rutaLocal."/includes/sidebar.php"; 
    ?>

    <div class="content-wrapper py-3">
      <div class="content-header w-75 mx-auto">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-6">
              <h1 class="m-0"><?= $page ?></h1>
            </div>
            <div class="col-6 text-right">
              <button id="btnModalCrearCiudad" class="btn btn_primary"><i class="fa fa-plus"></i> Crear</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container-fluid w-75 mx-auto">
        <table id="lista_ciudades">
          <thead class="bg_primary text-white">
            <tr>
              <th class="border border_primary p-1">Acrónimo</th>
              <th class="border border_primary p-1">Ciudad</th>
              <th class="border border_primary p-1">Val. Min. Declarado</th>
              <th class="border border_primary p-1">% Seguro</th>
              <th class="border border_primary p-1">Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- ModalCrear -->
  <div class="modal fade" id="modalCiudad" tabindex="-1" role="dialog" aria-labelledby="modalCiudadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="modalCiudadLabel"><i class="fas fa-map text-secondary"></i> Ciudad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="w-100">
              Ciudad
              <input id="input_ciudad" type="text" class="form-control" placeholder="Ej. BOGOTÁ">
            </label>
          </div>
          <div class="form-group">
            <label class="w-100">
              Acrónimo
              <input id="input_acronimo" type="text" class="form-control" placeholder="Ej. BOG" maxlength="4">
            </label>
          </div>
          <div class="form-group">
            <label class="w-100">
              Valor minimo declarado
              <input id="input_valorDeclarado" type="number" class="form-control" placeholder="Ej. 50000" maxlength="7">
            </label>
          </div>
          <div class="form-group">
            <label class="w-100">
              % seguro
              <input id="input_seguro" type="number" class="form-control" placeholder="Ej. 2" maxlength="3">
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnAccionCiudad" type="button" class="btn btn-primary"></button>
        </div>
      </div>
    </div>
  </div>


  <?php  require_once $rutaLocal."/includes/scripts.php"; ?>
  <script src="/js/functions_cities.js"></script>
</body>
