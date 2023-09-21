<?php

$response = [];
// print_r(($_POST));
// exit;

if (function_exists($_POST["op"])) {
  $_POST["op"]();
} else {
  $response = [
    "status" => false,
    "status_detail" => "La funcion no existe",
    "response" => []
  ];
}

function getPermisosAll()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;
  //   $obj->create();

  $response = [
    "status" => true,
    "status_detail" => "success get permisos all",
    "response" => $obj->getPermisosAll()
  ];
}
function getPermisos()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;
  //   $obj->create();

  $response = [
    "status" => true,
    "status_detail" => "success get permisos",
    "response" => $obj->getPermisos($_POST['id'])
  ];
}
function get()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;
  //   $obj->create();

  $response = [
    "status" => true,
    "status_detail" => "success get usuarios",
    "response" => $obj->get()
  ];
}
function statusUser()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;

  die(json_encode([
    "status" => true,
    "status_detail" => "existe",
    "response" => $obj->statusUser($_POST['id'], $_POST['status'])
  ]));
}
function getUsuario()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;

  $response = [
    "status" => true,
    "status_detail" => "success",
    "response" => $obj->getUsuario($_POST['id'])
  ];
}
function set()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;
  $username = $_POST['username'];
  $name = $_POST['name'];
  $password = $_POST['password'];
  $ciudad = $_POST['ciudadUser'];
  $existe = $obj->checkUser($username);
  if ($existe['num'] >= 1) {
    die(json_encode([
      "status" => false,
      "status_detail" => "existe",
      "response" => "el usuario ya existe"
    ]));
  }
  if ($obj->set($username, $name, $password, $ciudad)) {
    $response = [
      "status" => true,
      "status_detail" => "success",
      "response" => "success"
    ];
  } else {
    $response = [
      "status" => false,
      "status_detail" => "error",
      "response" => "error"
    ];
  }
}
function updateUser()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $password = $_POST['password'];
  $ciudad = $_POST['ciudad'];

  die(json_encode([
    "status" => true,
    "status_detail" => "Usuario editado con exito",
    "response" => $obj->update($id, $nombre, $password, $ciudad)
  ]));
}
function updatePermisos()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/User.php";
  $obj = new User;

  $id = $_POST['permiso'];
  $usuario = $_POST['usuario'];
  $activo = $_POST['activo'];

  if ($respuesta = $obj->updatePermisos($id, $usuario, $activo)) {
    $response = [
      "status" => true,
      "status_detail" => "success",
      "response" => "correcto",
    ];
  } else {
    $response = [
      "status" => false,
      "status_detail" => "error",
      "response" => $respuesta
    ];
  }
}

echo json_encode($response);
