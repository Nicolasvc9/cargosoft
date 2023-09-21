<?php
session_start();
if (isset($_POST['usuario'])) {
  $usuario = $_SESSION['caribecargo']['user'];
  
  // Ruta de destino para guardar las imágenes
  $rutaDestino = "./";
  
  if (isset($_FILES['imagenes'])) {
    $cantidadImagenes = count($_FILES['imagenes']['name']);
    $response = [];
    $status = true;
    
    for ($i = 0; $i < $cantidadImagenes; $i++) {
      $nombreArchivo = "cedula" . ($i + 1) . "_" . $usuario . ".jpg";
      $rutaArchivo = $rutaDestino . $nombreArchivo;
      
      if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $rutaArchivo)) {
        $response[$i] = "Imagen $nombreArchivo guardada correctamente.";
      } else {
        $response[$i] = "Error al guardar la imagen $nombreArchivo.";
        $status = false;
      }
    }
    die(json_encode([
        "status" => $status,
        "response" => $response
    ]));
  }
} else {
    die(json_encode([
        "status" => false,
        "response" => "error no hay usuario"
    ]));
}
?>
