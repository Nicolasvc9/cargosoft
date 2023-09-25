<?php
session_start();
$ruta = 2;
$titulo = "informes";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body>
  <?php
  $page = "Informes";
  require_once $rutaLocal . "/includes/navbar.php";
  require_once $rutaLocal . "/includes/sidebar.php";
  ?>
  <div class="content-wrapper py-3 px-2">
    <div class="container">
      <div class="row">
        <div class="col-4 form-group">
          <label class="w-100">
            Fecha inicio
            <input type="date" name="" id="desde" class="form-control">
          </label>
        </div>
        <div class="col-4 form-group">
          <label class="w-100">
            Fecha final
            <input type="date" name="" id="hasta" class="form-control">
          </label>
        </div>
        <div class="col-12 col-md-8">
          <button class="btn btn_primary" type="submit">Pagos Guias de Facturas</button>
          <button class="btn btn_primary" type="submit">Guias por Facturas</button>
        </div>

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
        <div class="col-12 col-md-6 form-group border border-primary rounded-2 bg-white py-2">
          <label class="w-100">
            TOTAL SALDOS
            <input id="valorTotal" type="number" class="form-control text-danger fw-bolder" value="$0.0" readonly>
          </label>
        </div>
      </div>
    </div>
  </div>
  <?php require_once $rutaLocal . "/includes/scripts.php"; ?>
  <script src="/js/functions_cities.js"></script>
</body>