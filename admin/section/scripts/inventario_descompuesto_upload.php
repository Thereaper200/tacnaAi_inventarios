<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "../../config/db.php";

const SQL_ingresar_inventario_descompuesto = (
    "INSERT INTO `inventario_descompuesto` (
    `txtiPadHomeButton`, `txtiPadFaceID`, `txtLapiz1ra`, `txtLapiz2da`, `txtCargasUSBA`, `txtCargasUSBC`, `txtCablesLightning`, 
    `txtCablesUSBC`, `txtCablesDisplayport`, `txtTecladosAlambricos`, `txtTecladosInalambricos`, `txtMouseInalambrico`, `txtMouseAlambrico`, 
    `fecha`) VALUES (:txtiPadHomeButton, :txtiPadFaceID, :txtLapiz1ra, :txtLapiz2da, :txtCargasUSBA, :txtCargasUSBC, :txtCablesLightning, 
    :txtCablesUSBC, :txtCablesDisplayport, :txtTecladosAlambricos, :txtTecladosInalambricos, :txtMouseInalambrico, :txtMouseAlambrico, 
    current_timestamp())"
    );

$nombre = ($_FILES['archivo']['name']);
$guardado = ($_FILES['archivo']['tmp_name']);
$ruta = 'inventario_descompuesto/';

$txtiPadHomeButton = (isset($_POST["txtiPadHomeButton"]) && $_POST["txtiPadHomeButton"] !== "") ? intval($_POST["txtiPadHomeButton"]) : 0;
$txtiPadFaceID = (isset($_POST["txtiPadFaceID"]) && $_POST["txtiPadFaceID"] !== "") ? intval($_POST["txtiPadFaceID"]) : 0;
$txtLapiz1ra = (isset($_POST["txtLapiz1ra"]) && $_POST["txtLapiz1ra"] !== "") ? intval($_POST["txtLapiz1ra"]) : 0;
$txtLapiz2da = (isset($_POST["txtLapiz2da"]) && $_POST["txtLapiz2da"] !== "") ? intval($_POST["txtLapiz2da"]) : 0;
$txtCargasUSBA = (isset($_POST["txtCargasUSBA"]) && $_POST["txtCargasUSBA"] !== "") ? intval($_POST["txtCargasUSBA"]) : 0;
$txtCargasUSBC = (isset($_POST["txtCargasUSBC"]) && $_POST["txtCargasUSBC"] !== "") ? intval($_POST["txtCargasUSBC"]) : 0;
$txtCablesLightning = (isset($_POST["txtCablesLightning"]) && $_POST["txtCablesLightning"] !== "") ? intval($_POST["txtCablesLightning"]) : 0;
$txtCablesUSBC = (isset($_POST["txtCablesUSBC"]) && $_POST["txtCablesUSBC"] !== "") ? $_POST["txtCablesUSBC"] : 0;
$txtCablesDisplayport = (isset($_POST["txtCablesDisplayport"]) && $_POST["txtCablesDisplayport"] !== "") ? intval($_POST["txtCablesDisplayport"]) : 0;
$txtTecladosAlambricos = (isset($_POST["txtTecladosAlambricos"]) && $_POST["txtTecladosAlambricos"] !== "") ? intval($_POST["txtTecladosAlambricos"]) : 0;
$txtTecladosInalambricos = (isset($_POST["txtTecladosInalambricos"]) && $_POST["txtTecladosInalambricos"] !== "") ? intval($_POST["txtTecladosInalambricos"]) : 0;
$txtMouseInalambrico = (isset($_POST["txtMouseInalambrico"]) && $_POST["txtMouseInalambrico"] !== "") ? intval($_POST["txtMouseInalambrico"]) : 0;
$txtMouseAlambrico = (isset($_POST["txtMouseAlambrico"]) && $_POST["txtMouseAlambrico"] !== "") ? intval($_POST["txtMouseAlambrico"]) : 0;


/*
INSERT INTO `inventarios_disponibles` (
`ID`, `txtiPadHomeButton`, `txtiPadFaceID`, `txtLapiz1ra`, `txtLapiz2da`, 
`txtCargasUSBA`, `txtCargasUSBC`, `txtCablesLightning`, `txtCablesUSBC`, 
`txtCablesDisplayport`, `txtTecladosAlambricos`, `txtTecladosInalambricos`, 
`txtMouseInalambrico`, `txtMouseAlambrico`, `fecha`) 
VALUES ('1', '5', '5', '5', '5', '5', '5', '5', '5', '5', 
'5', '5', '5', '5', current_timestamp());
*/

try {
    $sentenciaSQL = $conexion->prepare(SQL_ingresar_inventario_descompuesto);
    $sentenciaSQL->bindParam(':txtiPadHomeButton', $txtiPadHomeButton);
    $sentenciaSQL->bindParam(':txtiPadFaceID', $txtiPadFaceID);
    $sentenciaSQL->bindParam(':txtLapiz1ra', $txtLapiz1ra);
    $sentenciaSQL->bindParam(':txtLapiz2da', $txtLapiz2da);
    $sentenciaSQL->bindParam(':txtCargasUSBA', $txtCargasUSBA);
    $sentenciaSQL->bindParam(':txtCargasUSBC', $txtCargasUSBC);
    $sentenciaSQL->bindParam(':txtCablesLightning', $txtCablesLightning);
    $sentenciaSQL->bindParam(':txtCablesUSBC', $txtCablesUSBC);
    $sentenciaSQL->bindParam(':txtCablesDisplayport', $txtCablesDisplayport);
    $sentenciaSQL->bindParam(':txtTecladosAlambricos', $txtTecladosAlambricos);
    $sentenciaSQL->bindParam(':txtTecladosInalambricos', $txtTecladosInalambricos);
    $sentenciaSQL->bindParam(':txtMouseInalambrico', $txtMouseInalambrico);
    $sentenciaSQL->bindParam(':txtMouseAlambrico', $txtMouseAlambrico);
    $sentenciaSQL->execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    move_uploaded_file($guardado, $ruta.$nombre);
    header("Location: ../inventario_disponible.php");
} catch (Exception $ex) {
    echo $ex->getMessage();
}