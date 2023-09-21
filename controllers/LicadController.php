<?php


// echo json_encode($_POST);

if (function_exists($_POST["op"])) {
    $_POST["op"]();
} else {
    die(json_encode([
        "status" => false,
        "status_detail" => "Error interno: La función no existe",
        "response" => false
    ]));
}
function getPallets()
{
    require_once "../models/Base.php";
    require_once "../models/Licad.php";

    $obj = new Licad;

    if ($response =  $obj->getPallets()) {
        die(json_encode([
            "status" => true,
            "status_detail" => "Pallets listados",
            "response" => $response
        ]));
    }
}
function getConsecutivoLicad()
{
    require_once "../models/Base.php";
    require_once "../models/Licad.php";

    $obj = new Licad;

    if ($response =  $obj->getConsecutivoLicad($_POST['ruta'])) {
        die(json_encode([
            "status" => true,
            "status_detail" => "Pallets listados",
            "response" => $response
        ]));
    }
}
function setPallet()
{
    require_once "../models/Base.php";
    require_once "../models/Pallet.php";

    $obj = new Pallet;

    if ($response =  $obj->setPallet($_POST["data"], $_POST["pallet"])) {
        die(json_encode([
            "status" => true,
            "status_detail" => "Guia Actualizada",
            "response" => $response
        ]));
    }
}

function getGuiasPallet()
{
    require_once "../models/Base.php";
    require_once "../models/Guia.php";
    $obj = new Guia;

    die(json_encode([
        "status" => true,
        "status_detail" => "Consulta exitosa",
        "response" => $obj->getGuiaPallet($_POST['ruta'], $_POST['tipo'], $_POST['desde'], $_POST['hasta'])
    ]));
}
