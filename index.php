<?php
session_start();
$ruta = 100;
$titulo = "Cargo Caribe SAS";

if (isset($_SESSION['caribecargo']['permisos'])) {
    // Creamos un array para almacenar los nombres de los mÃ³dulos como claves Ãºnicas
    $modulosPermitidos = array();
    $permisos = array();

    // Recorremos los permisos y guardamos los nombres de los mÃ³dulos como claves Ãºnicas
    foreach ($_SESSION['caribecargo']['permisos'] as $permiso) {
        $modulo = $permiso[1];
        $permisos[] = $permiso[0];
        $modulosPermitidos[$modulo] = true;
    }
    if($ruta === 100){
        header("Location: ./views/index.php");
    }else if ($ruta === 1000){
        // esto es porque esta en el inicio
//echo "estas en el inicio";
//echo __DIR__;
    }else if(!in_array($ruta, $permisos)){
        echo "Location: /index.php";
        header("Location: ../index.php");
    }
}else{
//    echo "no hay una sesion activa";
}


$rutaImagen = './assets/img/';
if (file_exists($rutaImagen . 'logo.png')) {
    $imagen = './assets/img/logo.png';
} elseif (file_exists($rutaImagen . 'logo.jpg')) {
    $imagen = './assets/img/logo.jpg';
} else {
    $imagen = ""; // En caso de que no se encuentre ninguna de las dos imÃ¡genes
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/css/animate.css">
    <link rel="stylesheet" href="./dist/css/style.css">
    <link rel="stylesheet" href="./dist/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./dist/css/select2.min.css">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dist/css/styleLogin.css">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <title>Iniciar sesion</title>
<body>
     <div class="container">
        <div class="row  d-flex justify-content-center align-items-center vh-100 overflow-hidden">
            <div class="col-12 col-md-4">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-12 col-md-5 imgLogin">
                        </div> -->
                            <div class="col-12">
                                <form id="formLogin">
                                    <div class="form-group text-center mb-3">
                                        <img src="<?= $imagen ?>" class="img-fluid" alt="" style="max-height: 120px">
                                    </div>
                                    <div class="fw-bold h3 text-center mb-3">Iniciar sesion</div>
                                    <div class="form-group mt-3">
                                        <label for="username">Nombre de usuario:</label>
                                        <input type="text" class="form-control" id="user" placeholder="Ingrese su nombre de usuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contrasena:</label>
                                        <input type="password" class="form-control" id="password" placeholder="Ingrese su contrasena">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "./includes/scripts.php";
    ?>
    <script src="./js/functions_login.js"></script>
</body>

</html>