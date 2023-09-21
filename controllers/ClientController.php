<?php
session_start();
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
function getSeguro(){
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  if ($response = $obj->getSeguro((INT) $_POST["city"])) {
    die(json_encode([
      "status" => true,
      "status_detail" => "seguro traido correctamente",
      "response" => $response
    ]));
  }
}
function set()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  if ($obj->checkDocumento((INT) $_POST["iddocument_type"], $_POST["document"], (INT) $_POST["dv"])) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese documento",
      "response" => false
    ]));
  }

  if ( $obj->checkTelefono($_POST["phone"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese teléfono",
      "response" => false
    ]));
  }
  
  if ( $obj->checkCorreo(mb_strtoupper($_POST["email"])) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese correo",
      "response" => false
    ]));
  }
  
  if ((INT) $_POST["iddocument_type"] === 2) {
    $_POST["business_name"] = "{$_POST["first_name"]} {$_POST["second_name"]} {$_POST["first_surname"]} {$_POST["second_surname"]}";
  }

  if ($response = $obj->set((INT) $_POST["iddocument_type"], $_POST["document"], (INT) $_POST["dv"], mb_strtoupper($_POST["first_name"]), mb_strtoupper($_POST["second_name"]), mb_strtoupper($_POST["first_surname"]), mb_strtoupper($_POST["second_surname"]), mb_strtoupper($_POST["business_name"]), mb_strtoupper($_POST["direction"]), $_POST["phone"], mb_strtoupper($_POST["email"]), (INT) $_POST["idcity"],(INT) $_POST["seguro"], $_SESSION['caribecargo']['idUser'])) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Cliente creado correctamente",
      "response" => $response
    ]));
  }
}

function update()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  if ($obj->checkDocumento((INT) $_POST["iddocument_type"], $_POST["document"], (INT) $_POST["dv"], (INT) $_POST["idcliente"])) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese documento",
      "response" => false
    ]));
  }

  if ( $obj->checkTelefono($_POST["phone"], (INT) $_POST["idcliente"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese teléfono",
      "response" => false
    ]));
  }
  
  if ( $obj->checkCorreo(mb_strtoupper($_POST["email"]), (INT) $_POST["idcliente"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Ya existe un cliente con ese correo",
      "response" => false
    ]));
  }
  
  if ((INT) $_POST["iddocument_type"] === 2) {
    $_POST["business_name"] = "{$_POST["first_name"]} {$_POST["second_name"]} {$_POST["first_surname"]} {$_POST["second_surname"]}";
  }

  if ($response = $obj->update((INT) $_POST["idcliente"], (INT) $_POST["iddocument_type"], $_POST["document"], (INT) $_POST["dv"], mb_strtoupper($_POST["first_name"]), mb_strtoupper($_POST["second_name"]), mb_strtoupper($_POST["first_surname"]), mb_strtoupper($_POST["second_surname"]), mb_strtoupper($_POST["business_name"]), mb_strtoupper($_POST["direction"]), $_POST["phone"], mb_strtoupper($_POST["email"]), (INT) $_POST["idcity"],(INT) $_POST["seguro"])) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Cliente actualizado correctamente",
      "response" => $response
    ]));
  }
}

function getTiposDocumento()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getTiposDocumento()
  ]));
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

function getCliente()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getCliente((INT) $_POST["idcliente"])
  ]));
}

function getClientes()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getClientes()
  ]));
}
