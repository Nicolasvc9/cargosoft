<?php 
session_start();
$ruta = 2; 
  $titulo = "prefactura";
  require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body>
    <?php 
      $page = "Ciudades";
      require_once $rutaLocal."/includes/navbar.php";
      require_once $rutaLocal."/includes/sidebar.php"; 
    ?>


  <?php  require_once $rutaLocal."/includes/scripts.php"; ?>
  <script src="/js/functions_cities.js"></script>
</body>
