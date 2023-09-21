<?php 
session_start();

$ruta = 1000;
$titulo = "Cargo Caribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// pruebas
// require_once(ROOT . "/models/Base.php");
// require_once(ROOT . "/models/Config.php");
// $Config = new Config;
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <?php 
      $page = "Dashboard";
      require_once $rutaLocal."/includes/navbar.php";
      require_once $rutaLocal."/includes/sidebar.php"; 
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        <div class="bg_primary">
          <span class="text_primary">COLOR PRIMARIO</span>
        </div>
        <div class="bg_secondary">
          <span class="text_primary">COLOR SECUNDARIO</span>
        </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    </div>
<?php 
    require_once $rutaLocal."/includes/scripts.php";
?>
</body>
</html>