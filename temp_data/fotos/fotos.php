<?php
session_start();
if (isset($_POST['foto'])) {

  $fotoDataUrl = $_POST['foto'];

  // Obtener la extensión de la imagen
  $extension = '.png'; // Por defecto, asumimos que la imagen es PNG

  // Verificar la extensión de la imagen (puedes ajustar esto según tus necesidades)
  if (strpos($fotoDataUrl, 'data:image/jpeg;base64,') === 0) {
    $extension = '.jpg';
  } elseif (strpos($fotoDataUrl, 'data:image/png;base64,') === 0) {
    $extension = '.png';
  } elseif (strpos($fotoDataUrl, 'data:image/gif;base64,') === 0) {
    $extension = '.gif';
  } else {
    // La extensión no es válida, manejar el error
    die(json_encode([
        "status" => false,
        "response" => "Error: La imagen tiene un formato no válido."
    ]));
  }

  // Generar un nombre único para la imagen
  $nombreImagen = $_SESSION['caribecargo']['user']. $extension;

  // Decodificar la imagen base64
  $imagen = base64_decode(str_replace('data:image/png;base64,', '', $fotoDataUrl));

  // Ruta donde se guardará la imagen en el servidor
  $rutaDestino = './' . $nombreImagen;

  // Guardar la imagen en el servidor
  if (file_put_contents($rutaDestino, $imagen)) {
    die(json_encode([
        "status" => true,
        "response" => "La imagen se ha guardado correctamente como $nombreImagen",
        "foto" => $nombreImagen
    ]));
  } else {
    die(json_encode([
        "status" => false,
        "response" => "Error al guardar la imagen."
    ]));
  }
} else {
    die(json_encode([
        "status" => false,
        "response" => "Error: No se ha recibido ninguna imagen."
    ]));
}
?>
