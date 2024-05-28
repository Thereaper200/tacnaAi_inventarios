<?php
include "../template/cabecera.php";
include "../config/db.php";



//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$txtNombre = (isset($_POST["txtNombre"])) ? $_POST["txtNombre"] : NULL;
$txtNombreSelec = (isset($_POST["txtNombre"])) ? $_POST["txtNombre"] : NULL;
$txtContra = (isset($_POST["txtContra"])) ? $_POST["txtContra"] : NULL;
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

$passhash = password_hash($txtContra, PASSWORD_DEFAULT);



switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO `usuarios` (`usuario`, `clave`) VALUES (:usuario, :clave)");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->bindParam(":clave", $passhash);
        $sentenciaSQL->execute();
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET clave = :clave WHERE usuario = :usuario");
        $sentenciaSQL->bindParam(":usuario", $txtNombre);
        $sentenciaSQL->bindParam(":clave", $passhash);
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
                    <label for="txtNombre">Nombre de Usuario:</label>
                    <input type="text" class="input_button" value="<?php echo $txtNombreSelec; ?>" name="txtNombre" id="txtNombre" placeholder="Usuario" pattern="[a-zA-Z0-9,]*{0,32}" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtContra">Contraseña:</label>
                    <input type="text" class="input_button"  name="txtContra" id="txtContra" placeholder="Contraseña" autocomplete="off">
                </div>

                <br>

                <br>
                
                <div class="form_boxes" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn_warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="inside_form">
    <table class="table_insideuser">
        
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        

        <?php foreach($listaUsuarios as $usuarios):  ?>
            <tr>
                <td><?php echo $usuarios["usuario"];?></td>
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
