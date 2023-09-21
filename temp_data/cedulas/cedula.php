<?php
// Ruta donde se guardarán las imágenes
$uploadDir = "./";
// Verificar si se recibió un archivo
if(!isset($_POST['user']) && !isset($_POST['password'])){
    die("error");
}
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Verificar si hubo un error en la carga del archivo
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tempName = $file['tmp_name'];
        $fileName = $file['name'];

        if (file_exists("./". $_POST['user'].".jpg")) {
            move_uploaded_file($tempName, $uploadDir . $_POST['user']."1.jpg");
        } else {
            move_uploaded_file($tempName, $uploadDir . $_POST['user'].".jpg");
        }

        // Mover el archivo a la ubicación deseada
        echo "Imagen recibida y guardada.";
    } else {
        echo "Error al recibir la imagen.";
    }

} 