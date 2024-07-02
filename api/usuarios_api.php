<?php

$host = "localhost";
$usuario = "root";
$password = "";
$basededatos = "id21595802_tacnadb";

$conexion = new mysqli($host, $usuario, $password, $basededatos);

if($conexion->connect_error){
    die ("Conexión no establecida". $conexion->connect_error);
}

header("Content_Type: application/json");
$metodo = $_SERVER ['REQUEST_METHOD'];
print_r($metod);

switch ($metodo){

    case 'GET':
        // echo "Consulta de registros - GET";
        consultaSelect ($conexion);
        break;

    default: 
        echo "Método no permitido";
        break;
}

function consultaSelect ($conexion){
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    if($resultado) {
        $datos= array();
        while($fila= $resultado->fetch_assoc()){
            $datos[]= $fila;
        }
    }
    echo json_encode($datos);
}

?>