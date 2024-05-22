<?php 
ini_set('display_errors',0);

error_reporting(E_ALL & ~E_NOTICE);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="logo" href="img/logos/iconpl.png">
    <title>Portal de inventario</title>
    <!--Hoja de estilo de la barra de navegación-->
    <link rel="stylesheet"  type= "text/css" href="css/style.css">
</head>
<!--Body de la barra de navegacion-->
<body class="body_navbar">
    <header class="header">
        <!--Seccion donde se genera un contenedor para la barra de navegacion-->
        <section class="container-navbar">
        <!--Barra de navegacion-->
            <nav class="navbar">
                <!--Division donde se encuentra solo los enlaces de la lista desordenada para el menu-->
                <div class="navbar_nav">
                    <!--Lista desordenada para el menu-->
                    <ul class="nav_list">

                    <!--Enlaces principales-->
                    <li>
                        <a href="index.php"><img class="navbar_logo" src="img/logos/logopl.png" alt="Logo de Tacna AI"></a>
                    </li>
                    <div class="ajuste_nav">
                        <li class="nav_link">
                        <a href="acerca-de.php">Acerca de nosotros</a>
                        </li>
                        <li class="nav_link">
                            <a href="inventario.php">Inventario</a>
                        </li>
                        <li class="nav_link">
                            <a href="./admin/index.php">Login</a>
                        </li>
                        </div>
                    </ul>
                </div>    
            </nav>
        </section>
    </header>
    <div class="container">
    <div class="row">