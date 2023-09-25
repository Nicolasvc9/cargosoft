<?php
session_start();
$ruta = 2;
$titulo = "Control";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body>
  <?php
  $page = "Control";
  require_once $rutaLocal . "/includes/navbar.php";
  require_once $rutaLocal . "/includes/sidebar.php";
  ?>
  <div class="content-wrapper py-3 px-2">
    <div class="container">
    <h1 class="text-center">CONTROL DE GUIAS</h1>
      <div class="col-12 form-group  border border-primary">
        <div class="porc-40 overflow-y-auto">

          <table id="tablaGuias" class="table table-sm">
            <thead>
              <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Guia</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Saldo</th>
                <th>Fecha_Pago</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="7">
                  <div class="alert alert-warning" role="alert">
                    no hay guias disponibles, verifique los parametros de busqueda
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <button class="btn btn_primary" type="submit">Exportar PDF</button>
      <button class="btn btn_primary" type="submit">Exportar CSV</button>
    </div>
  </div>
  <?php require_once $rutaLocal . "/includes/scripts.php"; ?>
  <script src="/js/functions_cities.js"></script>
</body>