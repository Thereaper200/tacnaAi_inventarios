<?php
include '../template/cabecera.php';
include '../config/db.php';

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$txtFecha = isset($_POST['txtFecha']) ? $_POST['txtFecha'] : NULL;

$zona_horaria = new DateTimeZone('America/Tijuana');

$fecha_actual = new DateTime('now', $zona_horaria);

$sentenciaSQL = $conexion->prepare("SELECT * FROM `inventarios_diarios` WHERE `fecha` LIKE CONCAT('%', :fecha, '%')");
$sentenciaSQL->bindParam(":fecha", $txtFecha);
$sentenciaSQL->execute();

$listainventarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="inside_form">
    <table class="table_inside">
        <div>
            <form method="POST" enctype="multipart/form-data">
                <input type="date" name="txtFecha" id="txtFecha">
                <input type="submit" name="accion" value="Buscar" class="btn btn_primary">
            </form>
        </div>
        <thead>
            <tr>
                <th>Oficina</th>
                <th>Supervisor</th>
                <th>iPad</th>
                <th>Lapiz</th>
                <th>Adaptador</th>
                <th>Cables</th>
                <th>Teclados</th>
                <th>Fecha</th>
                <th>Comentarios</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listainventarios as $inventario):  ?>
            <tr>
                <td><?php echo $inventario["oficina"];?></td>
                <td><?php echo $inventario["supervisor"];?></td>
                <td><?php echo $inventario["ipad"];?></td>
                <td><?php echo $inventario["lapiz"];?></td>
                <td><?php echo $inventario["carga"];?></td>
                <td><?php echo $inventario["cable"];?></td>
                <td><?php echo $inventario["teclado"];?></td>
                <td><?php echo $inventario["fecha"];?></td>
                <td><?php echo $inventario["comentario"];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../template/pie.php';?>