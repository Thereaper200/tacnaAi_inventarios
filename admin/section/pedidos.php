<?php include("../template/cabecera.php"); ?>

<?php

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);


$txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
$txtSupervisor = (isset($_COOKIE["usuario"])) ? $_COOKIE["usuario"] : "";
$txtPedido = (isset($_POST["txtPedido"])) ? $_POST["txtPedido"] : "";
$txtComentarios = (isset($_POST["txtComentarios"])) ? $_POST["txtComentarios"] : "";
$txtProceso = (isset($_POST["txtProceso"])) ? $_POST["txtProceso"] : "En espera";
$txtProcesoSelec = (isset($_POST["txtProceso"])) ? $_POST["txtProceso"] : "En espera";
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";


include("../config/db.php");


//INSERT INTO `pedidos` (`id`, `oficina`, `pedido`, `comentario`, `fecha_pedido`) VALUES ('1', 'Oficina 1', '50 Pencils', 'Nos faltan lapices en la oficina', '2023-10-18');
//UPDATE `pedidos_prueba` SET `comentario` = 'cheems' WHERE `pedidos_prueba`.`id` = 2;
//UPDATE `pedidos_prueba` SET `oficina` = 'Cheems', `pedido` = 'chikito', `comentario` = 'de la vida' WHERE `pedidos_prueba`.`id` = 1;


switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO `pedidos_prueba` (`oficina`, `pedido`, `comentario`, `proceso`) VALUES (:oficina, :pedido, :comentario, :proceso)");
        $sentenciaSQL->bindParam(":oficina", $txtSupervisor);
        $sentenciaSQL->bindParam(":pedido", $txtPedido);
        $sentenciaSQL->bindParam(":comentario", $txtComentarios);
        $sentenciaSQL->bindParam(":proceso", $txtProceso);
        $sentenciaSQL->execute();
        break;

    case "Modificar":
        //UPDATE `pedidos_prueba` SET `oficina` = 'Brandon', `pedido` = '100 Pencil', `comentario` = 'Reponer material', `proceso` = 'Rechazado' WHERE `pedidos_prueba`.`id` = 21;
        $sentenciaSQL = $conexion->prepare("UPDATE `pedidos_prueba` SET `oficina` = :oficina, `pedido` = :pedido, `comentario` = :comentario, `proceso` = :proceso WHERE `pedidos_prueba`.`id` = :id;");
        $sentenciaSQL->bindParam(":id", $txtID);
        $sentenciaSQL->bindParam(":oficina", $txtSupervisor); 
        $sentenciaSQL->bindParam(":pedido", $txtPedido);
        $sentenciaSQL->bindParam(":comentario", $txtComentarios);
        $sentenciaSQL->bindParam(":proceso", $txtProcesoSelec);
        $sentenciaSQL->execute();
        break;

    case "Cancelar":
        $txtID = "";
        $txtSupervisor = "";
        $txtPedido = "";
        $txtComentarios = "";
        $txtFechaPedido = "";
        break;


    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM pedidos_prueba WHERE id = :id");
        $sentenciaSQL->bindParam(":id", $txtID);
        $sentenciaSQL->execute();
        $listainventario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtSerialSelec = $listainventario["id"];
        $txtSupervisor = $listainventario["oficina"];
        $txtPedido = $listainventario["pedido"];
        $txtComentarios = $listainventario["comentario"];
        $txtProcesoSelec = $listainventario["proceso"];
        
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM pedidos_prueba WHERE id = :id");
        $sentenciaSQL->bindParam(":id", $txtID);
        $sentenciaSQL->execute();
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM pedidos_prueba");
$sentenciaSQL->execute();
$listainventario = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Pedidos</h2>
        <div class="form_container">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form_boxes">
                    <input type="hidden" class="input_button" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID"  autocomplete="off">
                </div>
                

                <div class="form_boxes">
                    <label for="txtSupervisor">Supervisor:</label>
                    <input type="text" class="input_button" value="<?php echo $txtSupervisor; ?>" name="txtSupervisor" id="txtSupervisor" placeholder="Supervisor" pattern="[a-z, A-Z]{4,8}" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtPedido">Pedido:</label>
                    <input type="text" class="input_button" value="<?php echo $txtPedido; ?>" name="txtPedido" id="txtPedido" placeholder="Pedido" pattern="[a-z, A-Z, 0-9]{0,255}" autocomplete="off">
                </div>

                
                <div class="form_boxes">
                    <label for="txtComentarios">Motivo:</label>
                    <input type="text" class="input_button" value="<?php echo $txtComentarios; ?>" name="txtComentarios" id="txtComentarios" placeholder="Motivo" pattern="[a-z, A-Z, 0-9]{0,255}" autocomplete="off">
                </div>
                
                
                <?php if($_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley"){?>
                <label for="txtProceso">Estado:</label>
                <select class="form_boxes" name="txtProceso" value="<?php echo $txtProcesoSelec;?>">
                    <option selected disabled>-- Seleccione la ubicación --</option>
                    <option value="Notificado"<?php if ($txtProcesoSelec == 'Notificado') echo ' selected'; ?>>Notificado</option>
                    <option value="Rechazado"<?php if ($txtProcesoSelec == 'Rechazado') echo ' selected'; ?>>Rechazado</option>
                    <option value="En camino"<?php if ($txtProcesoSelec == 'En camino') echo ' selected'; ?>>En camino</option>
                    <option value="Entregado"<?php if ($txtProcesoSelec == 'Entregado') echo ' selected'; ?>>Entregado</option>
                </select>
                <?php }?>

                <div class="btn_group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn_warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="inside_form">
    <table class="table_inside">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supervisor</th>
                <th>Pedido</th>
                <th>Fecha del pedido</th>
                <th>Motivo</th>
                <th>Seguimiento</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listainventario as $dispositivo):  ?>
            <tr>
                <td><?php echo $dispositivo["id"];?></td>
                <td><?php echo $dispositivo["oficina"];?></td>
                <td><?php echo $dispositivo["pedido"];?></td>
                <td><?php echo $dispositivo["fecha_time"];?></td>
                <td><?php echo $dispositivo["comentario"];?></td>
                <td><?php echo $dispositivo["proceso"];?></td>
                <td>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $dispositivo["id"];?>" />
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn_primary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn_danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php"); ?>
