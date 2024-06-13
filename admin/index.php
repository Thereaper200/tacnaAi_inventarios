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
    <meta http-equiv="pragma" content="no-cache">

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
  <div>
    <form class="formulario" method="POST">
      <div>
        <img src="../img/logos/iconpl.png" class="icon_form">
        <label for="usuario">Usuario: </label>
        <input class="inp_user" type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" autocomplete="off">
        <small id="emailHelp">Nunca compartas tu contraseña con nadie</small>
      </div>
      <div>
        <label for="clave">Contraseña: </label>
        <input class="inp_password" type="password" name="clave" id="clave" placeholder="Ingresa tu contraseña" autocomplete="off">
      </div>
      <button class="btn_submit" type="submit">Ingresar</button>
    </form>
  </div>
</section>
    </div>
</body>

<footer class="footer">
            <div class="footer-info">
                <p>Dirección: Águila Coronada 19491, Cerro Colorado, 22215 Tijuana, B.C.</p>
                <p>Teléfono: 6646811400</p>
                <a href="https://tacna.net/" target="_blank">Visita Tacna</a>
            </div>
    </footer>
</html>