<?php 
session_start();
$ruta = 3;
  $titulo = "Clientes | CargoCaribe";
  require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini" onload="getClientes()">
  <div class="wrapper">
    <?php 
      $page = "Clientes";
      require_once $rutaLocal."/includes/navbar.php";
      require_once $rutaLocal."/includes/sidebar.php"; 
    ?>

    <div class="content-wrapper py-3">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-6">
              <h1 class="m-0"><i class="fa-solid fa-user text-secondary"></i> <?= $page ?></h1>
            </div>
            <div class="col-6 text-right">
              <button id="btnModalCrearCliente" class="btn btn_primary"><i class="fa fa-plus"></i> Nuevo cliente</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container-fluid table-responsive">
        <table id="lista_clientes">
          <thead class="bg_primary text-white">
            <tr>
              <th class="border border_primary p-1">Tipo de documento</th>
              <th class="border border_primary p-1">Documento</th>
              <th class="border border_primary p-1">DV</th>
              <th class="border border_primary p-1">Primer nombre</th>
              <th class="border border_primary p-1">Segundo nombre</th>
              <th class="border border_primary p-1">Primer apellido</th>
              <th class="border border_primary p-1">Segundo apellido</th>
              <th class="border border_primary p-1">Razón social</th>
              <th class="border border_primary p-1">Dirección</th>
              <th class="border border_primary p-1">Teléfono</th>
              <th class="border border_primary p-1">Correo</th>
              <th class="border border_primary p-1">Ciudad</th>
              <th class="border border_primary p-1">% seguro</th>
              <th class="border border_primary p-1">Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- ModalCrear -->
  


  <?php
    require_once "modalAddClients.php";
    require_once $rutaLocal."/includes/scripts.php"; ?>
  <script src="/js/functions_clients.js"></script>
</body>
