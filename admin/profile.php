<?php 
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include("template/cabecera.php"); 
include("./config/db.php"); 

function selector ($columna, $selectedValue) {
    foreach ($columna as $oficina) {
        $selected = $oficina['id'] == $selectedValue ? "selected" : "";
        echo "<option value='{$oficina['id']}' $selected>{$oficina['nombre']}</option>";
    }
}

function selectorP ($columnaP, $selectedValue) {
    foreach ($columnaP as $puesto) {
        $selected = $puesto['id'] == $selectedValue ? "selected" : "";
        echo "<option value='{$puesto['id']}' $selected>{$puesto['nombre']}</option>";
    }
}

const SQL_buscar_foto = "SELECT * FROM `usuarios` WHERE `usuario` = :usuario";
const SQL_buscar_oficina = "SELECT `id`, `nombre` FROM `oficinas`";
const SQL_buscar_puesto = "SELECT `id`, `nombre` FROM `puestos`";
const SQL_actualizar_usuario = "UPDATE `usuarios` SET `oficina` = :oficina, `puesto` = :puesto WHERE `usuario` = :usuario";

$userOf = (isset($_POST['userOf'])) ? $_POST['userOf'] : null;
$userP = (isset($_POST['userP'])) ? $_POST['userP'] : null;
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : null;

$sentenciaSQL = $conexion->prepare(SQL_buscar_foto);
$sentenciaSQL->bindParam(":usuario", $_COOKIE['usuario']);
$sentenciaSQL->execute();

$datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$ruta_foto = "default_user.jpg";
$usuarioOficina = "";
$usuarioPuesto = "";

foreach ($datos as $dato) {
    if (!empty($dato['ruta_foto'])) {
        $ruta_foto = $dato['ruta_foto'];
    }
    $usuarioOficina = $dato['oficina'];
    $usuarioPuesto = $dato['puesto'];
}

$consultaOficinas = $conexion->prepare(SQL_buscar_oficina);
$consultaOficinas->execute();

$lista_oficinas = $consultaOficinas->fetchAll(PDO::FETCH_ASSOC);

$consultaPuestos = $conexion->prepare(SQL_buscar_puesto);
$consultaPuestos->execute();

$lista_puestos = $consultaPuestos->fetchAll(PDO::FETCH_ASSOC);

switch ($accion) {
    case "Modificar":
        $actualizarUsuario = $conexion->prepare(SQL_actualizar_usuario);
        $actualizarUsuario->bindParam(':usuario', $_COOKIE['usuario']);
        $actualizarUsuario->bindParam(':oficina', $userOf);
        $actualizarUsuario->bindParam(':puesto', $userP);
        $actualizarUsuario->execute();
        break;
}
?>

<div id="profile_container">
    <section id="profile_img">
        <img src="../admin/img/img_profiles/<?= htmlspecialchars($ruta_foto) ?>" alt="Foto del Trabajador">
        <div class="overlay"></div>
        <i class="icono fa fa-camera"></i>
    </section>

    <header class="profile">
        <p><?= htmlspecialchars($_COOKIE['usuario']) ?></p>
        <form method="POST" enctype="multipart/form-data">
            <label for="userOf">Oficina:</label>
            <select id="userOf" name="userOf" class="profile_select">
            <?php selector($lista_oficinas, $usuarioOficina); ?>
            </select>
            
            <label for="userP">Puesto:</label>
            <select id="userP" name="userP" class="profile_select">
            <?php selectorP($lista_puestos, $usuarioPuesto); ?>
            </select>

            <div class="btn_group" role="group" aria-label="">
                <button type="submit" name="accion" value="Modificar" class="btn btn_submit">Actualizar</button>
            </div>
        </form>
    </header>
</div>
<script src="./section/js/profile_photo.js"></script>
