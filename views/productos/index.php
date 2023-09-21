<?php 
  $titulo = "Lista de productos | CargoCaribe";
  require_once($_SERVER['DOCUMENT_ROOT'] . '\cargasoft\includes\header.php');
?>

<body onload="getProductos()">
  <?php require_once ROOT."/includes/navbar.php"; ?>

  <div class="w-50 mx-auto my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h4 class="text-secondary fw-bolder">Lista de productos</h4>
      <a href="./create.php" class="btn btn-success">Nuevo</a>
    </div>

    <div id="lista_productos" class="row g-3"></div>
  </div>

  <?php require_once ROOT."/includes/scripts.php"; ?>
  <script src="/cargasoft/js/functions_productos.js"></script>
</body>