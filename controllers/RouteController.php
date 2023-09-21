<?php

$response = [];

// echo json_encode($_POST);

if(function_exists($_POST["op"]))
{
  $_POST["op"]();
}
else {
  die(json_encode([
    "status" => false,
    "status_detail" => "Error interno: La función no existe",
    "response" => false
  ]));
}

function set()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  if ($response = $obj->checkRuta((INT) $_POST["idcity_origin"], (INT) $_POST["idcity_destiny"])) {
    die(json_encode([
      "status" => false,
      "status_detail" => "La ruta ya existe",
      "response" => $response
    ]));
  }

  if ( $response =  $obj->set((INT) $_POST["idcity_origin"], (INT) $_POST["idcity_destiny"], (INT) $_POST["status"], (INT) $_POST["flete"],(INT) $_POST["flete_comercial"], (INT) $_POST["gasolina"]) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Ruta creada",
      "response" => $response
    ]));
  }
}

function update()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  if ($response = $obj->checkRuta((INT) $_POST["idcity_origin"], (INT) $_POST["idcity_destiny"], $_POST["idruta"])) {
    die(json_encode([
      "status" => false,
      "status_detail" => "La ruta ya existe",
      "response" => $response
    ]));
  }

  if ( $response =  $obj->update((INT) $_POST["idruta"], (INT) $_POST["idcity_origin"], (INT) $_POST["idcity_destiny"], (INT) $_POST["status"], (INT) $_POST["flete"],(INT) $_POST["flete_comercial"], (INT) $_POST["gasolina"]) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Ruta actualizada",
      "response" => $response
    ]));
  }
}

function getCiudades()
{
  require_once "../models/Base.php";
  require_once "../models/City.php";
  $obj = new City;

  $response = $obj->getCiudades();

  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "No hay ciudades creadas",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}

function getRuta()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getRuta((INT) $_POST["idruta"])
  ]));
}

function getRutas()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getRutas()
  ]));
}
