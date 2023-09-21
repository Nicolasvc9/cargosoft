<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
  if (isset($_POST['op']) && $_POST['op'] === 'GuardarImg') {
    $user = $_SESSION['caribecargo']['user'];
    $guia = $_POST['guia'];
    
    $origen1 = './huellas/' . $user . '.jpg';
    $destino1 = './docs/huella_' . $guia . '.jpg';
    
    $origen2 = './fotos/' . $user . '.png';
    $destino2 = './docs/foto_' . $guia . '.png';
    
    $origen3_1 = './cedulas/' . $user . '.jpg';
    $origen3_2 = './cedulas/' . $user . '1.jpg';
    $destino3_1 = './docs/cedula1_' . $guia . '.jpg';
    $destino3_2 = './docs/cedula2_' . $guia . '.jpg';
    
    if (copy($origen1, $destino1) && copy($origen2, $destino2) && copy($origen3_1, $destino3_1) && copy($origen3_2, $destino3_2)) {
      unlink($origen1);
      unlink($origen2);
      unlink($origen3_1);
      unlink($origen3_2);
      
      die(json_encode([
        "status" => true,
        "response" => "success"
      ]));
    } else {
        die(json_encode([
          "status" => false,
          "response" => "Error al copiar las imágenes o eliminar las originales."
        ]));
    }
} else {
      die(json_encode([
        "status" => false,
        "response" => "Datos inválidos."
      ]));
    }
} else {
    die(json_encode([
      "status" => false,
      "response" => "Método no válido."
    ]));
}
?>
