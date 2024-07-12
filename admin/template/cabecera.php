<?php 
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

  if(isset($_COOKIE['usuario'])) {
  } else {
    header("Location: ../index.php");
  }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
          <?php if(isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {?>
          <li class="trans"><a href="<?php echo $url; ?>/admin/section/usuarios.php">Usuarios</a></li>
          <?php }?>
        </ul>
      </div>
      
      <div class="menu_vertical">
        <a><?php echo $_COOKIE["usuario"];?></a>
          <ul>
            <li><a href="<?php echo $url;?>/admin/profile.php">Mi perfil</a></li>
            <li><a href="<?php echo $url;?>/admin/logout.php">Cerrar sesión</a></li>
          </ul>
      </div>

      <div class="navhamb">
      <li><a href="<?php echo $url; ?>/admin/inicio.php"><img src="../img/logos/logopl.png" class="navbar_logo"></a></li>
        <label class="lab_hamb" for="menu_hamb">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="list_icon" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </label>

        <input class="menu_hamb" type="checkbox" id="menu_hamb">

        <ul class="navhamb_vert">
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url;?>/admin/profile.php">Mi perfil</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/reporte.php">Reportes</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/tablas.php">Tablas</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/historial.php">Historial</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/inventario.php">Inventario</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/ollivander_sup.php">Ollivander's</a></li>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/pedidos.php">Pedidos</a></li>
          <?php if(isset($_COOKIE['admin']) && $_COOKIE['admin'] == 1) {?>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url; ?>/admin/section/usuarios.php">Usuarios</a></li>
          <?php }?>
          <li class="li_navhamb"><a class="link_hamb" href="<?php echo $url;?>/admin/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>

    </nav>
  </div>
</header>