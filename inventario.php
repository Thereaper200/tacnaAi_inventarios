<?php
include("template/cabecera.php");
include("admin/config/db.php");

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sentenciaSQL = $conexion->prepare("SELECT * FROM tacnadb WHERE sn LIKE :search");
    $sentenciaSQL->bindValue(':search', "%$search%");
    $sentenciaSQL->execute();
    $datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sentenciaSQL = $conexion->prepare("SELECT * FROM tacnadb");
    $sentenciaSQL->execute();
    $datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
}
?>


<section>
    <form class="find_bar">
        <div>
            <input class="search_input" type="text" name="search" placeholder="Buscar por número de serie">
            <button class="search_button">Buscar</button>
        </div>
    </form>
</section>



<?php foreach ($datos as $item) { ?>
    <div class="holder">
        <img src="<?php echo $item['url_de_la_imagen']; ?>">
        <div class="info_devices">
            <h4 id="serie_number"><?php echo $item['sn']; ?></h4>
            <p class="info_inv">Número de Serie: <?php echo $item['modelo']; ?></p>
            <p class="info_inv">Facturas: <?php echo $item['facturas']; ?></p>
            <p class="info_inv">Comentarios: <?php echo $item['comentarios']; ?></p>
            <p class="info_inv">Ubicación: <?php echo $item['ubicacion']; ?></p>
        </div>
    </div>
<?php } ?>

<?php include("template/pie.php"); ?>