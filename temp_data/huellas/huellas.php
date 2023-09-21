<?php
// Ruta donde se guardarán las imágenes
$uploadDir = "./";
// Verificar si se recibió un archivo
if(!isset($_POST['user']) && !isset($_POST['password']) && !isset($_POST['type'])){
    die("error");
}
if (isset($_FILES['file']) && $_POST['type'] == 'huella') {
    $file = $_FILES['file'];

    // Verificar si hubo un error en la carga del archivo
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tempName = $file['tmp_name'];
        $fileName = $file['name'];

        // Mover el archivo a la ubicación deseada
        move_uploaded_file($tempName, $uploadDir . $_POST['user'].".jpg");

        echo "Imagen recibida y guardada.";
    } else {
        echo "Error al recibir la imagen.";
    }

} 
