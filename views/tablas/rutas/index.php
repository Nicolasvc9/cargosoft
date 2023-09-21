<?php 
session_start();
$ruta = 5;
  $titulo = "Ciudades| CargoCaribe";
  require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini" onload="getRutas()">
  <div class="wrapper">
    <?php 
      $page = "Rutas";
      require_once $rutaLocal."/includes/navbar.php";
      require_once $rutaLocal."/includes/sidebar.php"; 
    ?>

    <div class="content-wrapper py-3">
      <div class="content-header w-75 mx-auto">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-6">
              <h1 class="m-0"><i class="fa-solid fa-map-location-dot text-secondary"></i> <?= $page ?></h1>
            </div>
            <div class="col-6 text-right">
              <button id="btnModalCrearRuta" class="btn btn_primary"><i class="fa fa-plus"></i> Nueva ruta</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container-fluid w-75 mx-auto">
        <table id="lista_rutas">
          <thead class="bg_primary text-white">
            <tr>
              <th class="border border_primary p-1"><i class="fa-solid fa-plane-departure"></i> Origen</th>
              <th class="border border_primary p-1"><i class="fa-solid fa-plane-arrival"></i> Destino</th>
              <th class="border border_primary p-1">Estado</th>
              <th class="border border_primary p-1">Flete</th>
              <th class="border border_primary p-1">Flete Comercial</th>
              <th class="border border_primary p-1">Gasolina</th>
              <th class="border border_primary p-1">Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- ModalCrear -->
  <div class="modal fade" id="modalRuta" role="dialog" aria-labelledby="modalRutaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="modalRutaLabel"><i class="fas fa-map text-secondary"></i> Ruta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <label class="w-100">
                <div>Ciudad origen</div>
                <select id="select_idcity_origin" class="form-select">
                  <option value="" disabled selected>Seleccione un origen...</option>
                </select>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="w-100">
                <div>Ciudad destino</div>
                <select id="select_idcity_destiny" class="form-select">
                  <option value="" disabled selected>Seleccione un destino...</option>
                </select>
              </label>
            </div>
            <div class="col-12">
              <label class="w-100">
                <div>flete</div>
                <input type="text" id="flete" class="form-control" value="0">
                <span class="small">indique por favor el valor del flete para esta ruta</span>
              </label>
            </div>
            <div class="col-12">
              <label class="w-100">
                <div>flete Comercial</div>
                <input type="text" id="fleteCom" class="form-control" value="0">
                <span class="small">indique por favor el valor del flete para esta ruta</span>
              </label>
            </div>
            <div class="col-12">
              <label class="w-100">
                <div>gasolina</div>
                <input type="text" id="gasolina" class="form-control" value="0">
                <span class="small">indique por favor el valor de la gasolina para esta ruta</span>
              </label>
            </div>
            <div class="form-group">
              <label>
                <input type="checkbox" id="check_activo" value="1">
                Ruta activa
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnAccionRuta" type="button" class="btn btn-primary"></button>
        </div>
      </div>
    </div>
  </div>


  <?php  require_once $rutaLocal."/includes/scripts.php"; ?>
  <script src="/js/functions_routes.js"></script>
</body>
