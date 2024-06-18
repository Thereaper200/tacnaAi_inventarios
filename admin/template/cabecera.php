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

    <div id="logo_container">
        <ul class="nav_horizontal">
          <li><a href="<?php echo $url; ?>/admin/inicio.php"><img src="../img/logos/logopl.png" class="navbar_logo"></a></li>
        </ul>
      </div>

      <div id="links_nav">
        <ul class="nav_horizontal">
          <li class="trans"><a href="<?php echo $url; ?>/admin/section/reporte.php">Reportes</a></li>
          <li class="dropdown">
            <a>Registro</a>
            <ul class="nav_vertical">
              <li><a href="<?php echo $url; ?>/admin/section/tablas.php">Tablas</a></li>
              <li><a href="<?php echo $url; ?>/admin/section/historial.php">Historial</a></li>
              <li><a href="<?php echo $url; ?>/admin/section/inventario.php">Inventario</a></li>
              <li class="trans"><a href="<?php echo $url; ?>/admin/section/ollivander_sup.php">Ollivander's</a></li>
            </ul>
          </li>
          <li class="trans"><a href="<?php echo $url; ?>/admin/section/pedidos.php">Pedidos</a></li>
          <?php if(isset($_COOKIE['usuario']) && ($_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley"  || $_COOKIE["usuario"] == "jovan solis")) {?>
          <li class="trans"><a href="<?php echo $url; ?>/admin/section/usuarios.php">Usuarios</a></li>
          <?php }?>
        </ul>
      </div>
      
      <div class="menu_vertical">
        <a><?php echo $_COOKIE["usuario"];?></a>
          <ul>
            <li><a href="<?php echo $url;?>/admin/logout.php">Cerrar sesión</a></li>
          </ul>
      </div>
      
    </nav>
  </div>
</header>