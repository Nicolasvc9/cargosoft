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

// index.php
function all()
{
  require_once "../models/Base.php";
  require_once "../models/Product.php";
  $obj = new Product;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->all()
  ]));
}

// show.php
function get()
{
  require_once "../models/Base.php";
  require_once "../models/Product.php";
  $obj = new Product;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->get((INT) $_POST["idproducto"])
  ]));
}

// === create.php
function set()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/Product.php";
  $obj = new Product;

  if( $checkCode = $obj->checkCodigo(strtoupper($_POST["codigo"])) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El producto ya existe",
      "response" => $checkCode
    ]));
  }

  if ( $response = $obj->set(strtoupper($_POST["codigo"]), strtoupper($_POST["nombre"]), (INT) $_POST["especial"]) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Producto creado",
      "response" => $response
    ]));
  }
}


// === edit.php
function update()
{
  global $response;
  require_once "../models/Base.php";
  require_once "../models/Product.php";
  $obj = new Product;

  if( $checkCode = $obj->checkCodigo(strtoupper($_POST["codigo"]), $_POST["idproducto"]) ) {
    die(json_encode([
      "status" => false,
      "status_detail" => "El producto ya existe",
      "response" => $checkCode
    ]));
  }

  if ($obj->update($_POST["idproducto"], strtoupper($_POST["codigo"]), strtoupper($_POST["nombre"]), (INT) $_POST["especial"]) ) {
    die(json_encode([
      "status" => true,
      "status_detail" => "Producto actualizado",
      "response" => $_POST["idproducto"]
    ]));
  }
}
