<?php
session_start();
$response = [];

// echo json_encode($_POST);

if (function_exists($_POST["op"])) {
    $_POST["op"]();
} else {
    $response = [
        "status" => false,
        "status_detail" => "La funcion no existe",
        "response" => []
    ];
}

function validar()
{
    if(isset( $_SESSION['caribecargo']['active'])){
        die (json_encode([
            "status" => true,
            "status_detail" => "sesion activa",
            "response" => "activo",
        ]));
    }else{
        die (json_encode([
            "status" => false,
            "status_detail" => "sesion inactiva",
            "response" => "activo",
        ]));
    }
}
