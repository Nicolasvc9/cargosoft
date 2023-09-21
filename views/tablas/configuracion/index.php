<?php 
session_start();
$ruta = 1;
$titulo = "Configuracion";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// pruebas
// require_once(ROOT . "/models/Base.php");
// require_once(ROOT . "/models/Config.php");
// $Config = new Config;

?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php 
    $page = "Configuraciones";
    require_once $rutaLocal."/includes/navbar.php";
    require_once $rutaLocal."/includes/sidebar.php"; 
    ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $page ?></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <div class="container-fluid">
            <div class="rounded border-2 border_primary">
                <div class="text-center">
                    <div class="card">
                      <div class="card-body">
                        <div class="" id="listConfigs"></div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
    <!-- modal editar -->
    <div class="modal fade" id="modalEditConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Configuración <i class="fa-duotone fa-gear-code"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="">
            <form id="formEditarConfig"></form>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal -->
<?php 
    require_once $rutaLocal."/includes/scripts.php";
?>
<script src="/js/functions_configs.js"></script>
</body>
</html>