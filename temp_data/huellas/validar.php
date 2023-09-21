<?php
session_start();
if (isset($_POST['op'])) {
    $user = $_SESSION['caribecargo']['user'];

    // Ruta de la imagen
    $rutaImagen = './' . $user . '.jpg';
    $rutaImagenCedula = '../cedulas/' . $user . '.jpg';
    $rutaImagenCedula1 = '../cedulas/' . $user . '1.jpg';

    if (file_exists($rutaImagen)) {
        if(file_exists($rutaImagenCedula) && file_exists($rutaImagenCedula1)){
            die(json_encode([
                "status" => true,
                "response" => "La imagen $user.jpg existe en la ubicación especificada.",
                "user" => $user
            ]));
        }
    } else {
        die(json_encode([
            "status" => false,
            "response" => "La imagen $user.jpg no existe en la ubicación especificada."
        ]));
    }
} else {
    die(json_encode([
        "status" => false,
        "response" => "No se ha recibido el parámetro 'user' por método POST."
    ]));
}
