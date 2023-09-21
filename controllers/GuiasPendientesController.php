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
function getConsecutivo(){
  require_once "../models/Base.php";
  require_once "../models/Consecutivo.php";
  $obj = new Consecutivo;
  
  $response = $obj->getConsecutivo($_POST['ciudad']);
  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "No hay productos creados",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}

function getFlete(){
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;
  $response = $obj->getFlete($_POST['ruta']);
  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "No hay productos creados",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}
function getSeguro(){
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;
  $response = $obj->getCliente($_POST['cliente']);
  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}
function getGuiaPendiente()
{
  require_once "../models/Base.php";
  require_once "../models/GuiaPendiente.php";
  $obj = new GuiaPendiente;

  $response = $obj->getGuiaP($_POST['guia']);
  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "Esta guia no esta pendiente selecione una diferente o comuniquese con un administrador",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}

function getGuiasPendientes()
{
  require_once "../models/Base.php";
  require_once "../models/GuiaPendiente.php";
  $obj = new GuiaPendiente;

  $response = $obj->getGuiasPendientes($_SESSION['caribecargo']['ciudad']);
  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "No hay Guias Pendientes",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
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
