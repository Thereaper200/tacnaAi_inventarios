<?php include("../template/cabecera.php"); ?>

<?php

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
$Nombre = (isset($_POST["Nombre"])) ? $_POST["Nombre"] : "";

$txtNosup = (isset($_POST["txtNosup"])) ? $_POST["txtNosup"] : "";
$lsUbic = (isset($_POST["slUbic"])) ? $_POST["slUbic"] : "";
$lsUbicSelec = (isset($_POST["slUbic"])) ? $_POST["slUbic"] : "" ;
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

include("../config/db.php");

$resultados_por_pagina = 75;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $resultados_por_pagina;

// Consulta SQL con limit y offset para la paginación
$sentenciaSQL = $conexion->prepare("SELECT * FROM inventarios_diarios LIMIT :offset, :limit");
$sentenciaSQL->bindParam(':offset', $offset, PDO::PARAM_INT);
$sentenciaSQL->bindParam(':limit', $resultados_por_pagina, PDO::PARAM_INT);
$sentenciaSQL->execute();
$listainventarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

switch ($accion) {
    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM inventarios_diarios WHERE ID = :ID");
        $sentenciaSQL->bindParam(":ID", $txtID);
        $sentenciaSQL->execute();
        break;
}

?>


<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Inventario</h2>

        <div class="form_container">
            <form action="upload.php" method="POST" enctype="multipart/form-data">

                <?php switch($accion){ case "Supervisor no fijo":?>
                    <div class="form_boxes">
                        <label for="txtNom">Supervisor:</label>
                        <input type="text" class="input_button"  name="txtNom" id="txtNom" placeholder="Supervisor"  autocomplete="off">
                    </div>
                <?php }?>

                <div class="form_boxes">
                    <label for="file">Archivo:</label>
                    <input type="file" class="input_button"  name="archivo" id="archivo"  accept=".numbers, .xlsx" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtiPad">iPad:</label>
                    <input type="input" class="input_button"  name="txtiPad" id="txtiPad" placeholder="Agrega la cantidad" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtLapiz">Lapices:</label>
                    <input type="input" class="input_button"  name="txtLapiz" id="txtLapiz" placeholder="Agrega la cantidad" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCargas">Adaptadores:</label>
                    <input type="input" class="input_button"  name="txtCargas" id="txtCargas" placeholder="Agrega la cantidad" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCables">Cables:</label>
                    <input type="input" class="input_button"  name="txtCables" id="txtCables" placeholder="Agrega la cantidad" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtTeclados">Teclados:</label>
                    <input type="input" class="input_button"  name="txtTeclados" id="txtTeclados" placeholder="Agrega la cantidad" autocomplete="off">
                </div>

                <?php if($_COOKIE["usuario"] == "Briza" || $_COOKIE["usuario"] == "Priscilla" || $_COOKIE["usuario"] == "Brandon"){?>
                    <div class="form_boxes">
                        <label for="txtMacbook">MacBook:</label>
                        <input type="input" class="input_button"  name="txtMacbook" id="txtMacbook" placeholder="MacBook" autocomplete="off">
                    </div>
                <?php }?>

                <?php if($_COOKIE["usuario"] == "Cesar" || $_COOKIE["usuario"] == "Alex" || $_COOKIE["usuario"] == "Brandon"){ ?>
                    <div class="form_boxes">
                        <label for="txtHDD">HDD:</label>
                        <input type="input" class="input_button"  name="txtHDD" id="txtHDD" placeholder="HDD" autocomplete="off">
                    </div>

                    <div class="form_boxes">
                        <label for="txtMouse">Mouse:</label>
                        <input type="input" class="input_button"  name="txtMouse" id="txtMouse" placeholder="Mouse" autocomplete="off">
                    </div>
                <?php }?>
                
                <div class="form_boxes">
                    <label for="txtComent">Comentarios:</label>
                    <input type="input" class="input_button"  name="txtComent" id="txtComent" placeholder="Comentarios" autocomplete="off">
                </div>
        
                
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
                <div class="btn_group" role="group" aria-label="">
                    <button type="submit" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>
            </form>

            <form method="POST">
                <input type="submit" name="accion" value="Supervisor no fijo" class="btn btn_warning"> 
            </form>
        </div>
    </div>
</div>



<div class="inside_form">
    <table class="table_inside">
        
        <thead>
            <tr>
                <th>ID</th>
                <th>Ubicacion</th>
                <th>Supervisor</th>
                <th>Archivado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        

        <?php foreach($listainventarios as $inventario):  ?>
            <tr>
                <td><?php echo $inventario["ID"];?></td>
                <td><?php echo $inventario["oficina"];?></td>
                <td><?php echo $inventario["supervisor"];?></td>
                <td><?php echo $inventario["fecha"];?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $inventario["ID"];?>" />
                        <input type="hidden" name="slModel" value="<?php echo $lsModelSelec; ?>" />
                        
                        <?php if($inventario["ruta"] != "inventarios_diarios/") {?>
                        <a class="btn btn_primary" href="<?php echo $inventario["ruta"];?>" download="<?php echo $inventario["nombre"];?>">Descargar</a>
                        <?php } else {?>
                        <p>No Cargó Archivos</p>
                        <?php }?>


                        <?php if(isset($_COOKIE['usuario']) && $_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley" ){ ?>
                                 <input type="submit" name="accion" value="Borrar" class="btn btn_danger">
                                 <?php }?>
                        
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php

        try {

            // Preparar la consulta SQL para contar las filas
            $sentenciaSQL = $conexion->prepare("SELECT COUNT(*) AS total_filas FROM inventarios_diarios");
            $sentenciaSQL->execute();

            // Obtener el resultado
            $resultado = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            // Mostrar el resultado
            //echo "La tabla $tabla tiene " . $resultado['total_filas'] . " filas.";
        } catch (PDOException $e) {
           // echo "Error: " . $e->getMessage();
        }

    ?>

    <div class="pagination">
        <?php
        $total_resultados = $resultado['total_filas'] /* Obtén el total de resultados de tu base de datos */;
        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

        for ($i = 1; $i <= $total_paginas; $i++) {
            echo "<a class='btn border margin-left padding-left' href='invent_test.php?pagina=$i'>$i</a> ";
        }
        ?>
    </div>

</div>



<?php include("../template/pie.php"); ?>

