<?php 
session_start();
$ruta = 4;
  $titulo = "Producto | CargoCaribe";
  require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

  $idproducto = (INT) $_GET["idp"];
  $idproducto > 0 ? "" : die("ERROR DE PRODUCTO");
?>

<body onload="getProducto(<?=$idproducto;?>)">
  <?php 
  require_once $rutaLocal."/includes/navbar.php";
  require_once $rutaLocal."/includes/sidebar.php";
   ?>

  <div class="w-50 mx-auto my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <a href="./" class="btn btn-primary">Regresar</a>
      <a href="./edit.php?idp=<?=$idproducto;?>" class="btn btn-warning">Editar</a>
    </div>

    <div id="mostrar_producto">Cargando...</div>
  </div>

  <?php require_once $rutaLocal."/includes/scripts.php"; ?>
  <script src="/js/functions_productos.js"></script>
</body>