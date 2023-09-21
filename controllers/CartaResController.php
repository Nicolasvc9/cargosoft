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
  require_once "../models/City.php";
  $obj = new City;

  if ( $response = $obj->checkCiudad(mb_strtoupper($_POST["ciudad"])) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El ciudad ya existe",
      "response" => $response
    ]));
  }

  if ( $response = $obj->checkAcronimo(mb_strtoupper($_POST["acronimo"])) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El acrónimo ya existe",
      "response" => $response
    ]));
  }

  if ( $response = $obj->set(strtoupper($_POST["acronimo"]), mb_strtoupper($_POST["ciudad"]), (INT) $_POST['valdeclarado'],(INT) $_POST['seguro'] ) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Ciudad creada",
      "response" => $response
    ]));
  }
}

function update()
{
  require_once "../models/Base.php";
  require_once "../models/City.php";
  $obj = new City;

  if ( $response = $obj->checkCiudad(strtoupper($_POST["ciudad"]), $_POST["idciudad"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El ciudad ya existe",
      "response" => $response
    ]));
  }
  
  if ( $response = $obj->checkAcronimo(strtoupper($_POST["acronimo"]), $_POST["idciudad"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El acrónimo ya existe",
      "response" => $response
    ]));
  }

  if ( $response = $obj->update((INT) $_POST["idciudad"], strtoupper($_POST["acronimo"]), mb_strtoupper($_POST["ciudad"]), $_POST["valdeclarado"],(INT) $_POST['seguro']) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Ciudad actualizada",
      "response" => $response
    ]));
  }
}

function getCiudades()
{
  require_once "../models/Base.php";
  require_once "../models/City.php";
  $obj = new City;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getCiudades()
  ]));
}

function get()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getGuiaRes($_POST["guia"])
  ]));
}
