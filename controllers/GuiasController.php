<?php
session_start();
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
function getDataPrint()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  $datosGuia = $obj->getGuiaPrint($_POST['guia']);
  $remitente = ( $datosGuia && $datosGuia->guia == $_POST['guia'] && $datosGuia->id_remitente) ? $obj->getRemitente($datosGuia->id_remitente) : die(json_encode([
    "status" => true,
    "status_detail" => "no hay un remitente",
    "guia" => $datosGuia,
  ]));

  $destinatario = ( $datosGuia && $datosGuia->guia == $_POST['guia'] && $datosGuia->id_destinatario) ? $obj->getRemitente($datosGuia->id_destinatario) : die(json_encode([
    "status" => true,
    "status_detail" => "no hay un destinatario",
    "remitente" => $remitente,
    "guia" => $datosGuia,
  ]));

  $origen = $obj->getCiudad($datosGuia->id_origin_city);
  $destino = $obj->getCiudad($datosGuia->id_destino_city);

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa guia print",
    "guia" => $datosGuia,
    "remitente" => $remitente,
    "destinatario" => $destinatario,
    "origen" => $origen['city'],
    "destino" => $destino['city'],
  ]));
}
function setGuia(){
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  
  $obj = new Guia;
  if ( $response =  $obj->setGuia(
      $_POST["guia"],
      $_POST["guiac"],
      (INT) $_POST["remitente"],
      (INT) $_POST["destinatario"],
      (INT) $_POST["origen"],
      (INT) $_POST["destino"],
      (INT) $_POST["ruta"],
      (INT) $_POST["comercial"],
      $_POST["contenido"],
      $_POST["observaciones"],
      (INT) $_POST["producto"],
      (INT) $_POST["piezas"],
      (INT) $_POST["kg"],
      (INT) $_POST["vol"],
      (INT) $_POST["kg_vol"],
      (INT) $_POST["flete"],
      (INT) $_POST["declarado"],
      (INT) $_POST["seguro"],
      (INT) $_POST["tarifaCombustible"],
      (INT) $_POST["valuacion"],
      (INT) $_POST["vseguro"],
      (INT) $_POST["venvio"],
      (INT) $_POST["valorCombustible"],
      (INT) $_POST["total"],
      (INT) $_SESSION['caribecargo']['idUser'],
      (INT) $_POST["contrapago"],
      (INT) $_POST["formadepago"],
      (INT) $_POST["status"],
      $_POST["adicionales"]      
      ) ) {
      die(json_encode([
        "status" => true,
        "status_detail" => "Guia Actualizada",
        "response" => $response
      ]));
    }
}
function setParcial(){
  // die(json_encode($_POST));
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  require_once "../models/Consecutivo.php";

  $obj = new Guia;
  $obj1 = new Consecutivo;

  if ($response = $obj1->checkConsecutivo((INT) $_POST["origen"], (INT) $_POST["guia"]) ) {
    // si entra aca es porque el ultimo consecutivo que encontro es el mismo que el temp
  }else{
    // si entra aca es prque ya hay una guia con el mismo numero de guia y ciudad.... debe cambiar el numero de guia o actualizarla
    die(json_encode([
      "status" => false,
      "status_detail" => "ya existe una guia con el mismo numero",
      "response" => "por favor revise el numero de guia"
    ]));
  }

  
  $partial = $obj->setParcial(  
    (INT) $_POST["guia"], 
    $_POST["guiac"], 
    (INT) $_POST["comercial"], 
    $_POST["contenido"], 
    (INT) $_POST["destinatario"], 
    (INT) $_POST["destino"], 
    $_POST["observaciones"], 
    (INT) $_POST["origen"], 
    (INT) $_POST["piezas"], 
    (INT) $_POST["producto"], 
    (INT) $_POST["remitente"], 
    (INT) $_POST["ruta"], 
    (INT) $_POST["kg"], 
    (INT) $_POST["vol"],
    $_POST["adicionales"], 
  );
    
    die(json_encode([
      "status" => true,
      "status_detail" => "Guia creada",
      "response" => $partial
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
function getProductos()
{
  require_once "../models/Base.php";
  require_once "../models/Product.php";
  $obj = new Product;

  $response = $obj->all();
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
function getClientes()
{
  require_once "../models/Base.php";
  require_once "../models/Client.php";
  $obj = new Client;

  $response = $obj->getClientes();
  if (!$response) {
    die(json_encode([
      "status" => false,
      "status_detail" => "No hay clientes creados",
      "response" => false
    ]));
  }

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $response
  ]));
}
function getRutasP()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa rutas",
    "response" => $obj->getRutas()
  ]));
}
function getRutas()
{
  require_once "../models/Base.php";
  require_once "../models/Route.php";
  $obj = new Route;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa rutas",
    "response" => $obj->getRutasGuia($_POST['origen'])
  ]));
}
function getGuiasPallet()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getGuiaPallet($_POST['ruta'],$_POST['tipo'],$_POST['desde'],$_POST['hasta'])
  ]));
}
function getGuiasPalletListar()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getGuiasPalletListar($_POST['pallet'])
  ]));
}
function getDetallado()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->getDetaladoLicad($_POST['licad'])
  ]));
}
function deleteGuiaPallet()
{
  require_once "../models/Base.php";
  require_once "../models/Guia.php";
  $obj = new Guia;

  die(json_encode([
    "status" => true,
    "status_detail" => "Consulta exitosa",
    "response" => $obj->deleteGuiaPallet($_POST['guia'])
  ]));
}
