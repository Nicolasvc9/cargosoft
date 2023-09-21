<?php 

if(function_exists($_POST["op"]))
{
    $_POST["op"]();
}else {
  $response = [
    "status" => false,
    "status_detail" => "La funcion no existe",
    "response" => []
  ];
}