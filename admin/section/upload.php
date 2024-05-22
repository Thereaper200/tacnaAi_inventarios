<?php

//INSERT INTO `inventarios_diarios` (`nombre`, `ruta`, `oficina`, `fecha`) VALUES ('Inventario', '../inventarios_diarios/', 'Oficina 1', current_timestamp());

include("../config/db.php");

//print_r($_FILES);
$nombre=($_FILES['archivo']['name']);
$guardado=($_FILES['archivo']['tmp_name']);
$ruta='inventarios_diarios/';
$oficina=$_POST['slUbic'];
$txtiPad = (isset($_POST["txtiPad"]) && $_POST["txtiPad"] !== "") ? intval($_POST["txtiPad"]) : 0;
$txtLapiz = (isset($_POST["txtLapiz"]) && $_POST["txtLapiz"] !== "") ? intval($_POST["txtLapiz"]) : 0;
$txtCargas = (isset($_POST["txtCargas"]) && $_POST["txtCargas"] !== "") ? intval($_POST["txtCargas"]) : 0;
$txtCables = (isset($_POST["txtCables"]) && $_POST["txtCables"] !== "") ? intval($_POST["txtCables"]) : 0;
$txtTeclados = (isset($_POST["txtTeclados"]) && $_POST["txtTeclados"] !== "") ? intval($_POST["txtTeclados"]) : 0;
$txtMacbook = (isset($_POST["txtMacbook"]) && $_POST["txtMacbook"] !== "") ? intval($_POST["txtMacbook"]) : 0;
$txtHDD = (isset($_POST["txtHDD"]) && $_POST["txtHDD"] !== "") ? intval($_POST["txtHDD"]) : 0;
$txtMouse = (isset($_POST["txtMouse"]) && $_POST["txtMouse"] !== "") ? intval($_POST["txtMouse"]) : 0;
$txtComent = (isset($_POST["txtComent"])) ? $_POST["txtComent"] : "";
$supervisor=(isset($_POST['txtNom'])) && $_POST['txtNom'] != "" ? $_POST['txtNom'] : $_COOKIE['usuario'];

$ruta_final=$ruta.$nombre;

//INSERT INTO `inventarios_diarios` (`ID`, `nombre`, `ruta`, `supervisor`, `oficina`, `ipad`, `lapiz`, `carga`, `cable`, `teclado`, `macbook`, `hdd`, `mouse`, `fecha`) VALUES (NULL, 'gatopollo', '/rutoncio', 'Brandon', 'Oficina 3', '10', '10', '10', '10', '10', '10', '10', '10', current_timestamp());

try {
    $sentenciaSQL = $conexion->prepare("INSERT INTO `inventarios_diarios` (`nombre`, `ruta`, `supervisor`, `oficina`, `ipad`, `lapiz`, `carga`, `cable`, `teclado`, `macbook`, `hdd`, `mouse`, `comentario`, `fecha`) VALUES (:nombre, :ruta, :supervisor, :oficina, :ipad, :lapiz, :carga, :cable, :teclado, :macbook, :hdd, :mouse, :comentario, current_timestamp())");
    $sentenciaSQL->bindParam(":nombre", $nombre);
    $sentenciaSQL->bindParam(":ruta", $ruta_final);
    $sentenciaSQL->bindParam(":supervisor", $supervisor);
    $sentenciaSQL->bindParam(":oficina", $oficina);
    $sentenciaSQL->bindParam(":ipad", $txtiPad);
    $sentenciaSQL->bindParam(":lapiz", $txtLapiz);
    $sentenciaSQL->bindParam(":carga", $txtCargas);
    $sentenciaSQL->bindParam(":cable", $txtCables);
    $sentenciaSQL->bindParam(":teclado", $txtTeclados);
    $sentenciaSQL->bindParam(":macbook", $txtMacbook);
    $sentenciaSQL->bindParam(":hdd", $txtHDD);
    $sentenciaSQL->bindParam(":mouse", $txtMouse);
    $sentenciaSQL->bindParam(":comentario", $txtComent);
    $sentenciaSQL->execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}

try {
    move_uploaded_file($guardado, $ruta.$nombre);
    header('Location: invent_test.php');
} catch (Exception $ex) {
    echo $ex->getMessage();
}


?>