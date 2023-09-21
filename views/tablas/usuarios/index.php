<?php 
session_start();
$titulo = "Usuarios";
$ruta = 6;
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php 
    $page = "Usuarios";
    require_once $rutaLocal."/includes/navbar.php";
    require_once $rutaLocal."/includes/sidebar.php"; 
    ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-6">
              <h1 class="m-0"><?= $page ?></h1>
            </div><!-- /.col -->
            <div class="col-6">
              <button class="btn btn_primary" id="btnAddUser"><i class="fa-duotone fa-user-plus"></i> Agregar Usuario</button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
        <div class="container-fluid">
            <div class="rounded border-2 border_primary">
                <div class="text-center">
                    <div class="card">
                      <div class="card-body">
                        <div class="" id="listUsers"></div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
    <!-- modal agregar -->
    <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar usuario <i class="fa-duotone fa-user-plus"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="">
            <form id="formAddUser">
                <div class="form-group">
                <label for="userName">Nombre de usuario:</label>
                <input class="form-control" type="text" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" type="text" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña:</label>
                <input class="form-control" type="password" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="password">Ciudad:</label>
                <select name="ciudadUser" id="ciudadUser" class="form-select" required></select>
              </div>

              <!-- Agrega más campos aquí según tus necesidades -->
              <div class="form-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="formAddUser" class="btn btn-primary">Registrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal -->
    <!-- modal editar -->
    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar usuario <i class="fa-duotone fa-user-plus"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="">
            <form id="formEditUser">
                <div class="form-group">
                <label for="userName">Nombre de usuario:</label>
                <input class="form-control" type="text" id="usernameEdit" name="usernameEdit" required disabled>
                <input type="hidden" id="idUserEdit">
              </div>
              <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" type="text" id="nameEdit" name="nameEdit" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña:</label>
                <input class="form-control" type="password" id="passwordEdit" name="passwordEdit" placeholder="dejar en blanco para no cambiarla">
              </div>
              <div class="form-group">
                <label for="password">Ciudad:</label>
                <select name="ciudadUserEdit" id="ciudadUserEdit" class="form-select" required></select>
              </div>

              <!-- Agrega más campos aquí según tus necesidades -->
              <div class="form-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="formEditUser" class="btn btn-primary">Editar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal -->
    <!-- modal agregar permisos -->
    <div class="modal fade" id="modalAddPermisosUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edita Permisos <i class="fa-duotone fa-user-plus"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="">
            <input type="hidden" id="idUserPermiso">
            <div class="" id="bodyPermisos"></div>
            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnActualizarPermisos" class="btn btn-primary">Actualizar permisos</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal -->
<?php 
    require_once $rutaLocal."/includes/scripts.php";
?>
<script src="/js/functions_users.js"></script>
</body>
</html>