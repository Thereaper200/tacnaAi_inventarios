<?php
ob_start(); // Iniciar el buffer de salida

include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($clave, $row["clave"])) {
            ob_end_clean(); // Limpiar el buffer de salida
            setcookie('usuario', $usuario, time()+3600);
            header("Location: inicio.php");
            exit; // Detener la ejecución del script después de la redirección
        } else {
            echo '<script type="text/javascript">
                window.alert("Contraseña Incorrecta");
                window.location.href = "../admin/index.php"; // Redirigir si la contraseña es incorrecta
            </script>';
            exit;
        }
    } else {
        echo '<script type="text/javascript">
            window.alert("Usuario Incorrecto");
            window.location.href = "../admin/index.php"; // Redirigir si el usuario es incorrecto
        </script>';
        exit;
    }
}

ob_end_flush(); // Enviar el buffer de salida
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Portal de Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="logo" href="../img/logos/iconpl.png">
    <link rel="stylesheet"  type= "text/css" href="../admin/css/styles.css">

  </head>

<body>
    <?php $url="http://".$_SERVER["HTTP_HOST"]."/tacnatest";  ?>
        <nav class="container-navbarprelog">
            <div class="nabvar_nav">
                <a class="navbar_logoprelog" href="../index.php">
                <img class="navbar_logoprelog" src="../img/logos/logopl.png" alt="Logo de Tacna AI" ></a>
            </div>
        </nav>

<section class="formulario_container">
  <div class="box">
    <span class="borderline"></span>
    <form class="formulario" method="POST">
    <!-- <h2>Iniciar sesión</h2> -->
    
    <img src="../img/logos/iconpl.png" class="icon_form">
            <div class="inputBox">
                <input name="usuario" id="usuario" type="text" required="required">
                <span>Usuario</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input name="clave" id="clave" type="password" required="required">
                <span>Contraseña</span>
                <i></i>
            </div>
            <input type="submit" value="Iniciar sesión">
    </form>
  </div>
</section>
    </div>
</body>

<footer class="footer">
        <div class="footer-content">
            <div class="footer-info">
                <p>Dirección: Águila Coronada 19491, Cerro Colorado, 22215 Tijuana, B.C.</p>
                <p>Teléfono: 6646811400</p>
                <a href="https://tacna.net/" target="_blank">Visita Tacna</a>
            </div>
        </div>
        <p class="copyright">© 2024 Todos los derechos reservados</p>
    </footer>
</html>