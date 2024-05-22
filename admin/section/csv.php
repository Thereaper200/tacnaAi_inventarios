<?php
include "../config/db.php";

header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"dispositivos.csv\"");

$sentenciaSQL = $conexion->prepare("SELECT * FROM `tacnadb`");
$sentenciaSQL->execute();

while ($row = $sentenciaSQL->fetch(PDO::FETCH_NAMED)) {
    echo implode(
        ",", [
            $row['sn'], $row['facturas'], $row['comentarios'], $row['modelo'], $row['ubicacion'] 
        ]
);
echo "\r\n";
}


?>