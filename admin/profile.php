<?php 
include("template/cabecera.php"); 
include("./config/db.php"); 

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

const SQL_buscar_foto = "SELECT * FROM `usuarios` WHERE `usuario` = :usuario";

$senteciaSQL = $conexion->prepare(SQL_buscar_foto);
$senteciaSQL->bindParam(":usuario", $_COOKIE['usuario']);
$senteciaSQL->execute();

$datos = $senteciaSQL->fetchAll(PDO::FETCH_ASSOC);

$ruta_foto = "default_user.jpg"; // Imagen por defecto

foreach ($datos as $dato) {
    if (!empty($dato['ruta_foto'])) {
        $ruta_foto = $dato['ruta_foto'];
    }
}
?>

<div id="profile_container">
    <header class="profile_">
        <h1> <?= htmlspecialchars($_COOKIE['usuario']) ?></h1>
        <p>Puesto: <?= htmlspecialchars($_COOKIE['puesto']) ?></p>
        <p>Oficina: <?= htmlspecialchars($_COOKIE['oficina']) ?></p>
    </header>
    <section id="profile_img">
        <img src="../admin/img/img_profiles/<?= htmlspecialchars($ruta_foto) ?>" alt="Foto del Trabajador">
    </section>
    <section id="add_info">
        <h2>Información Adicional</h2>
    </section>
</div>

<?php include("template/pie.php"); ?> 
