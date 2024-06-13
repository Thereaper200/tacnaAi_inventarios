<?php 
ini_set('display_errors',0);

error_reporting(E_ALL & ~E_NOTICE);


  if(isset($_COOKIE['usuario'])) {
  } else {
    header("Location: ../index.php");
  }

  // Para hostear en red el sitio eliminar el php echo de las rutas relativas

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  type="text/css" rel="stylesheet" href="../admin/css/styles.css">
    <link  type="text/css" rel="stylesheet" href="../css/styles.css">
    <meta http-equiv="pragma" content="no-cache">
    <title>Portal Administrador</title>
    <!--<link rel="icon" href="../img/logos/iconpl.png" type="image/x-icon">-->
    <link rel="icon" href="../img/logos/iconpl.png" type="image/x-icon">
    <link rel="icon" href="../../img/logos/iconpl.png" type="image/x-icon">
</head>

<?php $url="http://".$_SERVER["HTTP_HOST"]."/Github/tacnaAi_Inventarios";  ?>
<body class="body_navbar">
  <header>
    <div class="cont_navbarinicio">
      <nav class="navbar_cabecera">
      <ul class="nav_horizontal">
      <li><p class="username"><?php echo $_COOKIE["usuario"];?></p></li>
        <li><a href="../../admin/inicio.php"><img src="../img/logos/logopl.png" class="navbar_logo"></a></li>
        <li class="trans"><a href="<?php echo $url; ?>/admin/section/inventario.php">Reporte</a></li>
        <li><a>Registro</a>
            <ul class="nav_vertical">
                <li><a  href="<?php echo $url; ?>/admin/section/tablas.php">Tablas</a></li>
                <li><a  href="<?php echo $url; ?>/admin/section/historial.php">Historial</a></li>
                <li><a  href="<?php echo $url; ?>/admin/section/invent_test.php">Inventario</a></li>
            </ul>
        </li>
        <li class="trans"><a href="<?php echo $url; ?>/admin/section/pedidos.php">Pedidos</a></li>
        <li class="trans">
            <?php if(isset($_COOKIE['usuario']) && ($_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley"  || $_COOKIE["usuario"] == "jovan solis")) {?>
            <a href="<?php echo $url; ?>/admin/section/usuarios.php">Usuarios</a>
            <?php }?>
        </li>
        <li class="trans">
            <a class="visible_a" href="<?php echo $url; ?>/admin/logout.php">Cerrar sesion</a>
        </li>
      </ul>
      </nav>
    </div>
  </header>