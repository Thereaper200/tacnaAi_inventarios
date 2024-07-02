<?php
include "../template/cabecera.php";
include "../config/db.php";

if ($_COOKIE["admin"] != 1) {
    header("Location: ../inicio.php");
}



// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$txtNombre = (isset($_POST["txtNombre"])) ? $_POST["txtNombre"] : NULL;
$txtNombreSelec = (isset($_POST["txtNombre"])) ? $_POST["txtNombre"] : NULL;
$slOficina = (isset($_POST["slOficina"])) ? $_POST["slOficina"] : NULL;
$slPuesto = (isset($_POST["slPuesto"])) ? $_POST["slPuesto"] : NULL;
$boolAdmin = (isset($_POST["boolAdmin"])) ? 1 : 0;
$txtContra = (isset($_POST["txtContra"])) ? $_POST["txtContra"] : NULL;
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

$passhash = password_hash($txtContra, PASSWORD_DEFAULT);


// INSERT INTO `usuarios` (`usuario`, `clave`, `oficina`, `puesto`, `admin`) VALUES ('PRUEBA', 'PRUEBA', 'Oficina 3', 'IT', '1');

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO `usuarios` (`usuario`, `clave`, `oficina`, `puesto`, `admin`) VALUES (:usuario, :clave, :oficina, :puesto, :adminWEB)");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->bindParam(":clave", $passhash);
        $sentenciaSQL->bindParam(":oficina", $slOficina);
        $sentenciaSQL->bindParam(":puesto", $slPuesto);
        $sentenciaSQL->bindParam(":adminWEB", $boolAdmin);
        $sentenciaSQL->execute();
        break;

    case "Cambiar_Pass":
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET clave = :clave WHERE usuario = :usuario");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->bindParam(":clave", $passhash);
        $sentenciaSQL->execute();
        break;

    case "Agregar_Admin":
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET admin = :adminWEB WHERE usuario = :usuario");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->bindParam(":adminWEB", $boolAdmin);
        $sentenciaSQL->execute();
        break;

    case "Cancelar":
        $txtNombre = "";
        $txtContra = "";
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->execute();
        $listaUsuario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombreSelec = $listaUsuario["usuario"];

        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM usuarios WHERE usuario = :usuario");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->execute();
        break;

}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listaUsuarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Crear usuario:</h2>

        <div class="form_container">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form_boxes">
                    <label for="txtNombre">Usuario:</label>
                    <input type="text" class="input_button" value="<?php echo $txtNombreSelec; ?>" name="txtNombre" id="txtNombre" placeholder="Usuario" pattern="[a-zA-Z0-9,]*{0,32}" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtContra">Contraseña:</label>
                    <input type="text" class="input_button"  name="txtContra" id="txtContra" placeholder="Contraseña" autocomplete="off">
                </div>

                <div class="form_boxes">
                <label for="slOficina">Oficina:</label>
                    <select name="slOficina" class="sel_bigger">
                        <option selected disabled>-- Seleccione la oficina --</option>
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
                        <option value="Ollivanders"<?php if ($lsUbicSelec == 'Ollivanders') echo ' selected'; ?>>Ollivander's</option>
                        <option value="Administrativo"<?php if ($lsUbicSelec == 'Administrativo') echo ' selected'; ?>>Administrativo</option>
                    </select>
                </div>
                
                <div class="form_boxes">
                    <label for="slPuesto">Puesto:</label>
                    <select name="slPuesto" class="sel_bigger">
                        <option selected disabled>-- Seleccione el puesto --</option>
                        <option value="Supervisor"<?php if ($slSupSelec == 'Supervisor') echo ' selected'; ?>> Supervisor </option>
                        <option value="Administrador"<?php if ($slSupSelec == 'Administrador') echo ' selected'; ?>> Administrador </option>
                        <option value="Client"<?php if ($slSupSelec == 'Client') echo ' selected'; ?>> Client </option>
                        <option value="Lider"<?php if ($slSupSelec == 'Lider') echo ' selected'; ?>> Lider </option>
                        <option value="IT"<?php if ($slSupSelec == 'IT') echo ' selected'; ?>> IT </option>
                    </select>
                </div>
                

                <div class="form_boxes">
                    <label for="boolAdmin">Administrador:</label>
                    <input type="checkbox" class="input_button"  name="boolAdmin" id="boolAdmin" autocomplete="off">
                </div>

                <div class="form_boxes" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Cambiar_Pass" class="btn btn_warning">Cambiar clave</button>
                    <button type="submit" name="accion" value="Agregar_Admin" class="btn btn_submit">Agregar Admin</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="inside_form">
    <table class="table_insideuser table_inside">
        
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Oficina</th>
                <th>Puesto</th>
                <th>Administrador</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        

        <?php foreach($listaUsuarios as $usuarios):  ?>
            <tr>
                <td><?php echo $usuarios["usuario"];?></td>
                <td><?php echo $usuarios["oficina"]?></td>
                <td><?php echo $usuarios["puesto"]?></td>
                <td><?php echo $usuarios["admin"] == 0 ? "" : "Admin"?></td>

                <td>
                    <form method="POST">
                        <input type="hidden" name="txtNombre" id="txtNombre" value="<?php echo $usuarios["usuario"];?>" />
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

                        <button type="submit" name="accion" value="Borrar" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </button>

                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../template/pie.php';?>