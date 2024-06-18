<?php

include "../config/db.php";

include "../template/cabecera.php";

// SELECT * FROM `inventarios_disponibles` WHERE `fecha` = (SELECT MAX(`fecha`) FROM `inventarios_disponibles`);

const SQL_consulta_inventarios_diponibles_reciente = (
    "SELECT * FROM `inventarios_disponibles` WHERE `fecha` = (SELECT MAX(`fecha`) FROM `inventarios_disponibles`)"
);

$sentenciaSQL = $conexion->prepare(SQL_consulta_inventarios_diponibles_reciente);
$sentenciaSQL->execute();
$listainventarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<button id="notificacion_boton">Notificacion</button>

<h1 class="">Inventario Disponible</h1>

<div class="inside_form">
    <table class="table_inside">
        
        <thead>
            <tr>
                <th>iPad Home Button</th>
                <th>iPad Face ID</th>
                <th>Lapiz 1er</th>
                <th>Lapiz 2da</th>
                <th>Cubo USB</th>
                <th>Cubo Tipo C</th>
                <th>Cable Lightning</th>
                <th>Cable Tipo C</th>
                <th>Cable Displayport</th>
                <th>Teclado Alambrico</th>
                <th>Teclado Inalambrico</th>
                <th>Mouse Inalambrico</th>
                <th>Mouse Alambrico</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listainventarios as $inventario):  ?>
            <tr>
                <td id="inventario_disponible"><?php echo $inventario["txtiPadHomeButton"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtiPadFaceID"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtLapiz1ra"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtLapiz2da"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtCargasUSBA"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtCargasUSBC"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtCablesLightning"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtCablesUSBC"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtCablesDisplayport"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtTecladosAlambricos"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtTecladosInalambricos"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtMouseInalambrico"];?></td>
                <td id="inventario_disponible"><?php echo $inventario["txtMouseAlambrico"];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h1>Inventario Descompuesto</h1>

<?php

const SQL_consulta_inventario_descompuesto = (
    "SELECT * FROM `inventario_descompuesto` WHERE `fecha` = (SELECT MAX(`fecha`) FROM `inventario_descompuesto`)"
);

$sentenciaSQL = $conexion->prepare(SQL_consulta_inventario_descompuesto);
$sentenciaSQL->execute();

$lista_inventario_descompuesto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="inside_form">
    <table class="table_inside">
        
        <thead>
            <tr>
                <th>iPad Home Button</th>
                <th>iPad Face ID</th>
                <th>Lapiz 1er</th>
                <th>Lapiz 2da</th>
                <th>Cubo USB</th>
                <th>Cubo Tipo C</th>
                <th>Cable Lightning</th>
                <th>Cable Tipo C</th>
                <th>Cable Displayport</th>
                <th>Teclado Alambrico</th>
                <th>Teclado Inalambrico</th>
                <th>Mouse Inalambrico</th>
                <th>Mouse Alambrico</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_inventario_descompuesto as $inventario):  ?>
            <tr>
                <td id="inventario_descompuesto"><?php echo $inventario["txtiPadHomeButton"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtiPadFaceID"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtLapiz1ra"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtLapiz2da"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtCargasUSBA"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtCargasUSBC"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtCablesLightning"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtCablesUSBC"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtCablesDisplayport"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtTecladosAlambricos"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtTecladosInalambricos"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtMouseInalambrico"];?></td>
                <td id="inventario_descompuesto"><?php echo $inventario["txtMouseAlambrico"];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h1>Inventario Total</h1>

<?php

const SQL_suma_inventario_disponible_inventario_descompuesto = ("WITH inventarios AS (
    SELECT 
        SUM(txtiPadHomeButton) AS txtiPadHomeButton,
        SUM(txtiPadFaceID) AS txtiPadFaceID,
        SUM(txtLapiz1ra) AS txtLapiz1ra,
        SUM(txtLapiz2da) AS txtLapiz2da,
        SUM(txtCargasUSBA) AS txtCargasUSBA,
        SUM(txtCargasUSBC) AS txtCargasUSBC,
        SUM(txtCablesLightning) AS txtCablesLightning,
        SUM(txtCablesUSBC) AS txtCablesUSBC,
        SUM(txtCablesDisplayport) AS txtCablesDisplayport,
        SUM(txtTecladosAlambricos) AS txtTecladosAlambricos,
        SUM(txtTecladosInalambricos) AS txtTecladosInalambricos,
        SUM(txtMouseInalambrico) AS txtMouseInalambrico,
        SUM(txtMouseAlambrico) AS txtMouseAlambrico
    FROM inventarios_disponibles
    WHERE fecha = (SELECT MAX(fecha) FROM inventarios_disponibles)
),
descompuestos AS (
    SELECT 
        SUM(txtiPadHomeButton) AS txtiPadHomeButton,
        SUM(txtiPadFaceID) AS txtiPadFaceID,
        SUM(txtLapiz1ra) AS txtLapiz1ra,
        SUM(txtLapiz2da) AS txtLapiz2da,
        SUM(txtCargasUSBA) AS txtCargasUSBA,
        SUM(txtCargasUSBC) AS txtCargasUSBC,
        SUM(txtCablesLightning) AS txtCablesLightning,
        SUM(txtCablesUSBC) AS txtCablesUSBC,
        SUM(txtCablesDisplayport) AS txtCablesDisplayport,
        SUM(txtTecladosAlambricos) AS txtTecladosAlambricos,
        SUM(txtTecladosInalambricos) AS txtTecladosInalambricos,
        SUM(txtMouseInalambrico) AS txtMouseInalambrico,
        SUM(txtMouseAlambrico) AS txtMouseAlambrico
    FROM inventario_descompuesto
    WHERE fecha = (SELECT MAX(fecha) FROM inventario_descompuesto)
)

SELECT
    COALESCE(i.txtiPadHomeButton, 0) + COALESCE(d.txtiPadHomeButton, 0) AS txtiPadHomeButton,
    COALESCE(i.txtiPadFaceID, 0) + COALESCE(d.txtiPadFaceID, 0) AS txtiPadFaceID,
    COALESCE(i.txtLapiz1ra, 0) + COALESCE(d.txtLapiz1ra, 0) AS txtLapiz1ra,
    COALESCE(i.txtLapiz2da, 0) + COALESCE(d.txtLapiz2da, 0) AS txtLapiz2da,
    COALESCE(i.txtCargasUSBA, 0) + COALESCE(d.txtCargasUSBA, 0) AS txtCargasUSBA,
    COALESCE(i.txtCargasUSBC, 0) + COALESCE(d.txtCargasUSBC, 0) AS txtCargasUSBC,
    COALESCE(i.txtCablesLightning, 0) + COALESCE(d.txtCablesLightning, 0) AS txtCablesLightning,
    COALESCE(i.txtCablesUSBC, 0) + COALESCE(d.txtCablesUSBC, 0) AS txtCablesUSBC,
    COALESCE(i.txtCablesDisplayport, 0) + COALESCE(d.txtCablesDisplayport, 0) AS txtCablesDisplayport,
    COALESCE(i.txtTecladosAlambricos, 0) + COALESCE(d.txtTecladosAlambricos, 0) AS txtTecladosAlambricos,
    COALESCE(i.txtTecladosInalambricos, 0) + COALESCE(d.txtTecladosInalambricos, 0) AS txtTecladosInalambricos,
    COALESCE(i.txtMouseInalambrico, 0) + COALESCE(d.txtMouseInalambrico, 0) AS txtMouseInalambrico,
    COALESCE(i.txtMouseAlambrico, 0) + COALESCE(d.txtMouseAlambrico, 0) AS txtMouseAlambrico
FROM inventarios i, descompuestos d;");

$sentenciaSQL = $conexion->prepare(SQL_suma_inventario_disponible_inventario_descompuesto);
$sentenciaSQL->execute();

$lista_inventario_sumado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="inside_form">
    <table class="table_inside">
        
        <thead>
            <tr>
                <th>iPad Home Button</th>
                <th>iPad Face ID</th>
                <th>Lapiz 1er</th>
                <th>Lapiz 2da</th>
                <th>Cubo USB</th>
                <th>Cubo Tipo C</th>
                <th>Cable Lightning</th>
                <th>Cable Tipo C</th>
                <th>Cable Displayport</th>
                <th>Teclado Alambrico</th>
                <th>Teclado Inalambrico</th>
                <th>Mouse Inalambrico</th>
                <th>Mouse Alambrico</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_inventario_sumado as $inventario):  ?>
            <tr>
                <td id="inventario_total"><?php echo $inventario["txtiPadHomeButton"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtiPadFaceID"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtLapiz1ra"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtLapiz2da"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtCargasUSBA"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtCargasUSBC"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtCablesLightning"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtCablesUSBC"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtCablesDisplayport"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtTecladosAlambricos"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtTecladosInalambricos"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtMouseInalambrico"];?></td>
                <td id="inventario_total"><?php echo $inventario["txtMouseAlambrico"];?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="./js/verificacion_numeros.js"></script>


<?php include "../template/pie.php";?>
