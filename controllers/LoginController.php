<?php
session_start();

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
function login()
{
    require_once "../models/Base.php";
    require_once "../models/Login.php";

    $obj = new Login;

    if ($response =  $obj->login($_POST['user'], $_POST['password'])) {
        // si entra aca es porque es valido 
        // hay que obtener los permisos
        if ($permisos = $obj->permisos($response['id'])) {
            $_SESSION['caribecargo']['active'] = true;
            $_SESSION['caribecargo']['idUser'] = $response['id'];
            $_SESSION['caribecargo']['user'] = $response['user'];
            $_SESSION['caribecargo']['permisos'] = $permisos;
            if($response['ciudad'] != null){
                $_SESSION['caribecargo']['ciudad'] = $response['ciudad'];
            }

            die(json_encode([
                "status" => true,
                "status_detail" => "login exitoso",
                "response" => $response,
                "permisos" => $permisos
            ]));
        }else{
            session_destroy();
            die(json_encode([
                "status" => false,
                "response" => "usuario sin permisos"
            ]));
        }

        echo json_encode([
            "status" => "success",
            "response" => $response
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "response" => "usuario o contraseña incorrecta"
        ]);
    }
}
