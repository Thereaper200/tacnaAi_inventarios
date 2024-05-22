<?php include("../template/cabecera.php");?> // Importar la cabecera
<?php include("../config/db.php");?> // Importar la base de datos


<?php 
$txtNumeroGeneral = (isset($_POST["txtNumeroGeneral"])) ? $_POST["txtNumeroGeneral"] : "";
$txtOficina = (isset($_POST["txtOficina"])) ? $_POST["txtOficina"] : "";
$txtSN = (isset($_POST["txtSN"])) ? $_POST["txtSN"] : "";
?>

