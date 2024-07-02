<?php include("../template/cabecera.php");?>

<?php
include("../config/db.php");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Configurar la zona horaria a Tijuana
$zona_horaria = new DateTimeZone('America/Tijuana');

// Obtener la fecha y hora actual en la zona horaria de Tijuana
$fecha_actual = new DateTime('now', $zona_horaria);

// Preparar la consulta SQL con los comodines % alrededor del marcador de posición :fecha
//$sentenciaSQL = $conexion->prepare("SELECT * FROM `inventarios_diarios` WHERE `fecha` LIKE CONCAT('%', :fecha, '%')");

$sentenciaSQL = $conexion->prepare("SELECT * FROM `inventarios_diarios` WHERE `fecha` IN (SELECT MAX(`fecha`) FROM `inventarios_diarios` WHERE `fecha` LIKE CONCAT('%', :fecha, '%') GROUP BY `oficina`)");

// Formatear la fecha actual en el formato esperado por LIKE
$fecha_actual_formateada = $fecha_actual->format('Y-m-d');

// Vincular el valor de $fecha_actual_formateada al marcador de posición :fecha
$sentenciaSQL->bindParam(':fecha', $fecha_actual_formateada);

// Ejecutar la consulta SQL
$sentenciaSQL->execute();

// Obtener los resultados
$listainventarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


// include("inventario.php");

?>


<div class="inside_form">
    <table class="table_inside">
        
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


<?php include("../template/pie.php");?>
