<?php 
  $titulo = "Editar producto | CargoCaribe";
  require_once($_SERVER['DOCUMENT_ROOT'] . '\cargasoft\includes\header.php');

  $idproducto = (INT) $_GET["idp"];
  $idproducto > 0 ? "" : die("ERROR DE PRODUCTO");
?>

<body onload="editProducto(<?=$idproducto;?>)">
  <?php require_once ROOT."/includes/navbar.php"; ?>

  <div class="w-50 mx-auto my-5">
    <a href="./show.php?idp=<?=$idproducto;?>" class="btn btn-primary mb-3">Regresar</a>

    <form>
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

      <button id="btn_editarproducto" idproducto="<?=$idproducto;?>" class="btn btn-primary" type="button">Actualizar producto</button>
    </form>
  </div>

  <?php require_once ROOT."/includes/scripts.php"; ?>
  <script src="/cargasoft/js/functions_productos.js"></script>
</body>