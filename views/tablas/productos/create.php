<?php 
session_start();
$ruta = 4;
$titulo = "Crear producto | CargoCaribe";
$page = "Clientes";

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<body>
<?php require_once $rutaLocal."/includes/navbar.php";
require_once $rutaLocal."/includes/sidebar.php"; ?>
<div class="w-10/12 mx-auto bg-gray-200">
    <!-- <span>Lorem ipsum dolor </span> -->
<div class="w-50 mx-auto my-5">
  <a href="./" class="btn btn-primary mb-3">Regresar</a>

  <form class="bg-white p-4 rounded-3 shadow-sm">
    <div class="form-group">
      <label for="input_codigo">Código</label>
      <input type="text" id="input_codigo" class="form-control" placeholder="Ingrese el código del producto">
    </div>
    <div class="form-group">
      <label for="input_nombre">Nombre</label>
      <input type="text" id="input_nombre" class="form-control" placeholder="Ingrese un nombre al producto">
    </div>
    <div class="form-group">
      <label>
        <input type="checkbox" id="check_especial" value="1">
        Producto especial
      </label>
    </div>

    <button id="btn_crearproducto" class="btn btn-primary" type="button">Crear producto</button>
  </form>
</div>

<?php require_once $rutaLocal."/includes/scripts.php"; ?>
<script src="/js/functions_productos.js"></script>
</body>
</html>