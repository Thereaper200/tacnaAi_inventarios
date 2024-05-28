<?php include("../template/cabecera.php");

$txtSN = (isset($_POST["txtSN"])) ? $_POST["txtSN"] : "";
$txtBill = (isset($_POST["txtBill"])) ? $_POST["txtBill"] : ""; 
$txtCom = (isset($_POST["txtCom"])) ? $_POST["txtCom"] : "";
$lsModel = (isset($_POST["slModel"])) ? $_POST["slModel"] : "";
$lsUbic = (isset($_POST["slUbic"])) ? $_POST["slUbic"] : NULL;
$txtBus = (isset($_POST["txtBus"])) ? $_POST["txtBus"] : "";
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";


include("../config/db.php");

$resultados_por_pagina = 25;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $resultados_por_pagina;


switch ($accion) {
    case "Agregar":
        $serialNumbers = explode(",", $txtSN);
    
        foreach ($serialNumbers as $serial) {
            // Verificar si el número de serie ya existe en la base de datos
            $consultaExistencia = $conexion->prepare("SELECT COUNT(*) as count FROM tacnadb WHERE sn = :sn");
            $consultaExistencia->bindParam(":sn", $serial);
            $consultaExistencia->execute();
            $resultado = $consultaExistencia->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado['count'] > 0) {
                echo "<script>alert('El número de serie $serial ya existe en la base de datos.')</script>";
                continue; // Saltar el proceso de inserción
            }
            
            if ($lsUbic == NULL){
                echo "<script>alert('Agrega una ubicación para continuar')</script>";
                continue;
                }
    
            // Si el número de serie no existe, procede con la inserción
            $sentenciaSQL = $conexion->prepare("INSERT INTO `tacnadb` (`sn`, `facturas`, `comentarios`, `modelo`, `ubicacion`) VALUES (:sn, :facturas, :comentarios, :modelo, :ubicacion)");
            $sentenciaSQL->bindParam(":sn", $serial);
            $sentenciaSQL->bindParam(":facturas", $txtBill);
            $sentenciaSQL->bindParam(":comentarios", $txtCom);
            $sentenciaSQL->bindParam(":modelo", $lsModel);
            $sentenciaSQL->bindParam(":ubicacion", $lsUbic);
            $sentenciaSQL->execute();
        }
        break;
    

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE tacnadb SET facturas = :facturas, comentarios = :comentarios, modelo = :modelo, ubicacion = :ubicacion WHERE sn = :sn");
        $sentenciaSQL->bindParam(":sn", $txtSN);
        $sentenciaSQL->bindParam(":facturas", $txtBill); 
        $sentenciaSQL->bindParam(":comentarios", $txtCom);
        $sentenciaSQL->bindParam(":modelo", $lsModel);
        $sentenciaSQL->bindParam(":ubicacion", $lsUbic);
        $sentenciaSQL->execute();
        break;

    case "Cancelar":
        $txtSN = "";
        $txtBill = "";
        $txtCom = "";
        $lsModel = "";
        $lsUbic = "";
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM tacnadb WHERE sn = :sn");
        $sentenciaSQL->bindParam(":sn", $txtSN);
        $sentenciaSQL->execute();
        $listainventario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtSerialSelec = $listainventario["sn"];
        $txtBill = $listainventario["facturas"];
        $txtCom = $listainventario["comentarios"];
        //$lsModelSelec = $listainventario["modelo"]; Linea original de codigo no funcional actualmente
        $lsModel = $listainventario["modelo"];
        $lsUbicSelec = $listainventario["ubicacion"];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM tacnadb WHERE sn = :sn");
        $sentenciaSQL->bindParam(":sn", $txtSN);
        $sentenciaSQL->execute();
        break;
        

    case "Ubic":
        $serialNumbers = explode(",", $txtSN);
        $sentenciaSQL = $conexion->prepare("UPDATE tacnadb SET ubicacion = :ubicacion WHERE sn = :sn");
                
        foreach ($serialNumbers as $serial) {
            $sentenciaSQL->bindParam(":sn", $serial);
            $sentenciaSQL->bindParam(":ubicacion", $lsUbic);
            $sentenciaSQL->execute();
        }
        break;
        
    case "Buscar":
        $txtBus = "%" . $txtBus . "%"; 
        
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `tacnadb` WHERE `sn` LIKE :sn");
        $sentenciaSQL->bindParam(":sn", $txtBus);
        $sentenciaSQL->execute();
        
        $resultadosBusqueda = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
        break;


}

//$sentenciaSQL = $conexion->prepare("SELECT * FROM tacnadb");
$sentenciaSQL = $conexion->prepare("SELECT * FROM tacnadb INNER JOIN ipad_models ON tacnadb.modelo = ipad_models.model LIMIT :offset, :limit;");
$sentenciaSQL->bindParam(':offset', $offset, PDO::PARAM_INT);
$sentenciaSQL->bindParam(':limit', $resultados_por_pagina, PDO::PARAM_INT);
$sentenciaSQL->execute();
$listainventario = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL_conjunta = $conexion->prepare("SELECT * FROM tacnadb INNER JOIN ipad_models ON tacnadb.modelo = ipad_models.model LIMIT :offset, :limit;");
$sentenciaSQL_conjunta->bindParam(':offset', $offset, PDO::PARAM_INT);
$sentenciaSQL_conjunta->bindParam(':limit', $resultados_por_pagina, PDO::PARAM_INT);
$sentenciaSQL_conjunta->execute();
$listainventarioCombinada = $sentenciaSQL_conjunta->fetchAll(PDO::FETCH_ASSOC);

$listaCombinada = array_merge($listainventarioCombinada, $listainventario);
$listaUnica = array_unique($listaCombinada);

$dispositivosUnicos = array();

// Recorre la lista combinada y agrega los dispositivos únicos al array
foreach ($listaCombinada as $dispositivo) {
    $serial = $dispositivo["sn"];
    if (!in_array($serial, array_column($dispositivosUnicos, "sn"))) {
        $dispositivosUnicos[] = $dispositivo;
    }
}

?>


<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Reporte</h2>

        <div class="form_container">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form_boxes">
                    <label for="txtSN">Serial Number:</label>
                    <input type="text" class="input_button" value="<?php echo $txtSN; ?>" name="txtSN" id="txtSN" placeholder="SDLXQC05ZGMW4" pattern="[a-zA-Z0-9,]*{0,32}" autocomplete="off">
                </div>
                <div class="form_boxes">
                    <label for="txtBill">Factura:</label>
                    <input type="text" class="input_button" value="<?php echo $txtBill; ?>" name="txtBill" id="txtBill" placeholder="PLA-00048A" pattern="[a-z, A-Z, 0-9, \-]{0,32}" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCom">Comentarios:</label>
                    <input type="text" class="input_button" value="<?php echo $txtCom; ?>" name="txtCom" id="txtCom" placeholder="Modelo obsoleto." pattern="[a-z, A-Z, 0-9,[], ()]{0,}" autocomplete="off">

                <div class="form_boxes">
                    <label for="slModel">Modelo:</label>
                    <input type="text" class="input_button" value="<?php echo $lsModel; ?>" name="slModel" id="slModel" placeholder="Modelo" pattern="[a-zA-Z0-9]{0,32}" autocomplete="off">
                </div>
                    <br>
                <label for="slUbic">Ubicacion:</label>
                <select class="form_boxes" name="slUbic">
                    <option selected disabled>-- Seleccione la ubicación --</option>
                    <option value="Oficina 1"<?php if ($lsUbicSelec == 'Oficina 1') echo ' selected'; ?>>Oficina 1</option>
                    <option value="Oficina 2"<?php if ($lsUbicSelec == 'Oficina 2') echo ' selected'; ?>>Oficina 2</option>
                    <option value="Oficina 3"<?php if ($lsUbicSelec == 'Oficina 3') echo ' selected'; ?>>Oficina 3</option>
                    <option value="Oficina 4"<?php if ($lsUbicSelec == 'Oficina 4') echo ' selected'; ?>>Oficina 4</option>
                    <option value="Oficina 5"<?php if ($lsUbicSelec == 'Oficina 5') echo ' selected'; ?>>Oficina 5</option>
                    <option value="AgTech"<?php if ($lsUbicSelec == 'AgTech') echo ' selected'; ?>>AgTech</option>
                    <option value="Phoenix"<?php if ($lsUbicSelec == 'Phoenix') echo ' selected'; ?>>Phoenix</option>
                    <option value="QC"<?php if ($lsUbicSelec == 'QC') echo ' selected'; ?>>QC</option>
                    <option value="Alpha"<?php if ($lsUbicSelec == 'Alpha') echo ' selected'; ?>>Alpha</option>
                    <option value="Azkaban"<?php if ($lsUbicSelec == 'Azkaban') echo ' selected'; ?>>Azkaban</option>
                    <option value="Cabina"<?php if ($lsUbicSelec == 'Cabina') echo ' selected'; ?>>Cabina</option>
                    <option value="Administrativo"<?php if ($lsUbicSelec == 'Administrativo') echo ' selected'; ?>>Administrativo</option>
                </select>

                <br>


                <br>
                
                <div class="btn_group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn_success">Agregar</button>
                    <?php if($_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley"){?>
                    <button type="submit" name="accion" value="Modificar" class="btn btn_warning">Modificar</button>
                    <?php }?>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                    <button type="submit" name="accion" value="Ubic" class="btn btn_submit">Update Ubic</button>
                </div>

                <div class="form_boxes">
                    <br>
                    <label for="txtBus">Búsqueda:</label>
                    <input type="text" class="busqueda" value="<?php echo $txtBus; ?>" name="txtBus" id="txtBus" placeholder="Búsqueda" autocomplete="off">
                    <input type="submit" name="accion" value="Buscar" class="btn btn_submit">
                </div>

            </form>
        </div>
    </div>
</div>


<div class="inside_form">
    <table class="table_inside">
        
        <thead>
            <tr>
                <th>SN</th>
                <th>Factura</th>
                <th>Comentarios</th>
                <!--<th>Modelo</th>-->
                <th>Dispositivo</th>
                <th>Ubicacion</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        

        <?php foreach($dispositivosUnicos as $dispositivo):  ?>
            <tr>
                <td><?php echo $dispositivo["sn"];?></td>
                <td><?php echo $dispositivo["facturas"];?></td>
                <td><?php echo $dispositivo["comentarios"];?></td>
                <td><?php echo $dispositivo["device"];?></td>
                <td><?php echo $dispositivo["ubicacion"];?></td>
                <td><?php echo $dispositivo["fecha"];?></td>
                
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtSN" id="txtSN" value="<?php echo $dispositivo["sn"];?>" />
                        <input type="hidden" name="slModel" value="<?php echo $lsModelSelec; ?>" />
                        <button type="submit" name="accion" value="Seleccionar" class="btn btn_primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-click" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 12l3 0" />
                            <path d="M12 3l0 3" />
                            <path d="M7.8 7.8l-2.2 -2.2" />
                            <path d="M16.2 7.8l2.2 -2.2" />
                            <path d="M7.8 16.2l-2.2 2.2" />
                            <path d="M12 12l9 3l-4 2l-2 4l-3 -9" />
                            </svg>
                        </button>
                        <?php if($_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley"){?>
                        <button type="submit" name="accion" value="Borrar" class="btn btn_danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </button>
                        <?php }?>
                            <br>
                            <br>
                        <input 
                        class="form_check_input" type = "checkbox" name = "outofservice">

                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
        <?php 
    
            try {
                $sentenciaSQL = $conexion->prepare("SELECT COUNT(*) AS total_filas FROM tacnadb INNER JOIN ipad_models ON tacnadb.modelo = ipad_models.model");
                $sentenciaSQL->execute();
        
                $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        
            } catch (PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
        
            
        
        ?>
        
        <div class="pagination">
            <?php
            $total_resultados = $resultado['total_filas'] /* Obtén el total de resultados de tu base de datos */;
            $total_paginas = ceil($total_resultados / $resultados_por_pagina);
        
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo "<a class='btn border margin-left padding-left' href='inventario.php?pagina=$i'>$i</a> ";
            }
            ?>
        </div>
        <form action="csv.php" method="POST" enctype="multipart/form-data">
            <input type="submit" value="Exportar" name=csv class='btn border margin-left padding-left'></a>
        </form>
        </div>

<div class="principal_columns">
    <table class="table_inside">
        <thead>
            <tr>
                <th>SN</th>
                <th>Factura</th>
                <th>Comentarios</th>
                <th>Ubicacion</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($resultadosBusqueda as $encontrado): ?>

            <tr>
                <td><?php echo $encontrado["sn"]; ?></td>
                <td><?php echo $encontrado["facturas"]; ?></td>
                <td><?php echo $encontrado["comentarios"]; ?></td>
                <td><?php echo $encontrado["ubicacion"]; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtSN" value="<?php echo $encontrado["sn"]; ?>" />
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
