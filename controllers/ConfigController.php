<?php

$response = [];

// echo json_encode($_POST);

if(function_exists($_POST["op"]))
{
    $_POST["op"]();
}else {
  $response = [
    "status" => false,
    "status_detail" => "La funcion no existe",
    "response" => []
  ];
}

function get()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/Config.php";
  $obj = new Config;
  
  $response = [
    "status" => true,
    "status_detail" => "success",
    "response" => $obj->get()
  ];
}
function getValuacion()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/Config.php";
  $obj = new Config;
  
  $response = [
    "status" => true,
    "status_detail" => "success",
    "response" => $obj->getValuacion()[0][0]
  ];
}
function update(){
  global $response;
  $id = $_POST['idConfig'];
  
  if($_POST['typeConfig'] === "file"){
    $name  = $_POST['config'];
    $value = $_FILES['configInput']['name'];
    $logoTmpName = $_FILES['configInput']['tmp_name'];
    
    if (file_exists("../assets/img/$name.jpg")) {
      unlink("../assets/img/$name.jpg");
    }
    if (file_exists("../assets/img/$name.png")) {
      unlink("../assets/img/$name.png");
    }
    // start
    
    // Obtener el tipo de imagen
    $tipoImagen = exif_imagetype($logoTmpName);
    
    // Comparar el tipo de imagen con las constantes de tipo de imagen
    if ($tipoImagen === IMAGETYPE_JPEG) {
      // El archivo es de tipo JPG
      $destination = "../assets/img/$name.jpg";
    } elseif ($tipoImagen === IMAGETYPE_PNG) {
      // El archivo es de tipo PNG
      $destination = "../assets/img/$name.png";
    } else {
      // El archivo no es de tipo JPG ni PNG
      echo 'El archivo no es de tipo JPG ni PNG.';
    }
    // fin
    
    if (move_uploaded_file($logoTmpName, $destination)) {
      // Error al mover el archivo
      $response = [
        "status" => true,
        "status_detail" => "success",
        "response" => $_POST['typeConfig']
      ];
      echo json_encode($response);
      exit; // Terminar la ejecución del script
    }else{
      $response = [
        "status" => false,
        "status_detail" => "error",
        "response" => $_POST['typeConfig']
      ];
      echo json_encode($response);
      exit;
    }
  }else{
    $value = $_POST['configInput'];
  }
  require_once "../models/Base.php";
  require_once "../models/Config.php";

  $obj = new Config;

  if($obj->update($id, $value)){
    $response = [
      "status" => true,
      "status_detail" => "success",
      "response" => $_POST['typeConfig']
    ];
  }else{
    $response = [
      "status" => false,
      "status_detail" => "error",
      "response" => "error"
    ];
  }  
}

echo json_encode($response);
