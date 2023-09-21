<?php
$rutaLocal = $_SERVER['DOCUMENT_ROOT'];
if (isset($_SESSION['caribecargo']['permisos'])) {
    // Creamos un array para almacenar los nombres de los módulos como claves únicas
    $modulosPermitidos = array();
    $permisos = array();

    // Recorremos los permisos y guardamos los nombres de los módulos como claves únicas
    foreach ($_SESSION['caribecargo']['permisos'] as $permiso) {
        $modulo = $permiso[1];
        $permisos[] = $permiso[0];
        $modulosPermitidos[$modulo] = true;
    }
    if($ruta === 100){
        // header("Location: ./views/index.php");
        echo "hay una sesion ativa";
    }else if ($ruta === 1000){
        // esto es porque esta en el inicio
    }else if(!in_array($ruta, $permisos)){
        echo "Location: /index.php";
        // header("Location: ../index.php");
    }
}else{
    echo "no hay una sesion activa";
    // header("Location: ../index.php");
}

require_once $rutaLocal.'/models/Base.php';
require_once $rutaLocal.'/models/Config.php';
$Config = new Config;
$config = $Config->get();

$primary = "";
$secondary = "";

if ($config) {
    foreach ($config as $key => $value) {
        if ($value[1] === 'color') {
            $primary = $value[2];
        }
    }
}

function isColorDark($color)
{
    // Obtener los componentes RGB del color
    $r = hexdec(substr($color, 1, 2)) / 255.0;
    $g = hexdec(substr($color, 3, 2)) / 255.0;
    $b = hexdec(substr($color, 5, 2)) / 255.0;

    // Calcular el brillo relativo
    $l = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;

    // Comparar con el umbral y devolver true si es oscuro, false si es claro
    return $l < 0.5;
}

function generateSecondaryColor($color)
{
    // Determinar si el color base es oscuro o claro
    $isDark = isColorDark($color);

    // Tratar colores blanco y negro de manera especial
    if ($color === "#ffffff") {
        return "#CACACA"; // Color secundario más claro u oscuro, respectivamente
    } elseif ($color === "#000000") {
        return "#7B7B7B"; // Color secundario más oscuro o claro, respectivamente
    }
    // Obtener los componentes RGB del color base
    $r = hexdec(substr($color, 1, 2));
    $g = hexdec(substr($color, 3, 2));
    $b = hexdec(substr($color, 5, 2));

    // Definir los factores de oscurecimiento o aclarado
    // $darkenFactor = 0.8; // Factor de oscurecimiento
    // $lightenFactor = 5.2; // Factor de aclarado
    // Definir el valor de ajuste basado en si el color base es oscuro o claro
    $adjustment = $isDark ? 60 : -30;
    // Aplicar el ajuste a los componentes RGB
    $r = max(0, min(255, $r + $adjustment));
    $g = max(0, min(255, $g + $adjustment));
    $b = max(0, min(255, $b + $adjustment));
    // Asegurar que los componentes RGB estén dentro del rango válido (0-255)
    $r = max(0, min(255, $r));
    $g = max(0, min(255, $g));
    $b = max(0, min(255, $b));

    // Convertir los componentes RGB a formato hexadecimal
    $secondaryColor = "#" . str_pad(dechex($r), 2, "0", STR_PAD_LEFT) .
        str_pad(dechex($g), 2, "0", STR_PAD_LEFT) .
        str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

    return $secondaryColor;
}

if (isColorDark($primary)) {
    $TextPrimary = "#fff";
} else {
    $TextPrimary = "#000";
}
$secondary = generateSecondaryColor($primary);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/css/animate.css">
    <link rel="stylesheet" href="/dist/css/style.css">
    <link rel="stylesheet" href="/dist/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/dist/css/select2.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <title><?= $titulo ?? "titulo" ?></title>
    <style>
        body {
            background-color: #E5E5E5;
        }

        .bg_primary {
            background-color: <?= $primary ?> !important;
        }

        .bg_secondary {
            background-color: <?= $secondary ?>;
        }

        .text_primary {
            color: <?= $TextPrimary ?>;
        }

        .border_primary {
            border-color: <?= $primary ?>;
        }

        .btn_primary {
            background-color: <?= $primary ?>;
            color: <?= $TextPrimary ?>;
        }

        .btn_primary:hover {
            background-color: <?= $secondary ?>;
            color: <?= $TextPrimary ?>;
        }

        .btn_secondary {
            background-color: <?= $secondary ?>;
            color: <?= $TextPrimary ?>;
        }
    </style>
</head>