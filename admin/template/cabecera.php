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
    <title>Portal Administrador</title>
    <!--<link rel="icon" href="../img/logos/iconpl.png" type="image/x-icon">-->
</head>


<body class="body_navbar">

<?php $url="http://".$_SERVER["HTTP_HOST"]."/tacnatest";  ?>

  <header class="header">
    <section class="container_navbar">
        <nav class="navbar">

            <ul class="nav_list">
                <li class="nav_link"><a href="../admin/inicio.php"><img src="../img/logos/logopl.png" class="navbar_logo"></li>
                
                <li class="nav_link"><span><?php echo $_COOKIE["usuario"];?></span></a></li>x

                <li class="nav_link"><a href="<?php echo $url; ?>/admin/section/inventario.php"><span>Reporte</span></a></li>

                <li class="nav_link"><a>Inventarios</a>
                    <ul class="submenu">
                        <li class="sub_link"><a href="<?php echo $url; ?>/admin/section/tablas.php">Tablas</a></li>
                        <li class="sub_link"><a href="<?php echo $url; ?>/admin/section/historial.php">Historial</a></li>
                        <li class="sub_link"><a href="<?php echo $url; ?>/admin/section/invent_test.php">Inventario</a></li>
                    </ul>
                </li>
                <li class="nav_link"><a href="<?php echo $url; ?>/admin/section/pedidos.php">Pedidos</a></li>
                <li class="nav_link">
                    <?php if(isset($_COOKIE['usuario']) && $_COOKIE["usuario"] == "Brandon" || $_COOKIE["usuario"] == "Abel" || $_COOKIE["usuario"] == "Shirley" ) {?>
                    <a href="<?php echo $url; ?>/admin/section/usuarios.php">Usuarios</a>
                    <?php }?>
                </li>
                <li class="nav_link">
                    <a class="log_out" href="<?php echo $url; ?>/admin/logout.php">Cerrar sesion</a>
                </li>
            </ul>
        </nav>
    </section>
  </header>
