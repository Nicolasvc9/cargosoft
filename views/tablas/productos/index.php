<?php
session_start();
$ruta = 4;
$titulo = "Lista de productos | CargoCaribe";
$page = "Productos";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body onload="getProductos()">
  <?php
  require_once $rutaLocal . "/includes/navbar.php";
  require_once $rutaLocal . "/includes/sidebar.php";
  ?>

  <div class="w-50 mx-auto my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h4 class="text-secondary fw-bolder">Lista de productos</h4>
      <a href="./create.php" class="btn btn-success">Nuevo</a>
    </div>

    <div id="lista_productos" class="row g-3"></div>
  </div>

  <?php require_once $rutaLocal . "/includes/scripts.php"; ?>
  <script src="/js/functions_productos.js"></script>
</body>