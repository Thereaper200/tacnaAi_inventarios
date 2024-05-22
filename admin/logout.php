<?php

if(isset($_COOKIE['usuario'])) {
    setcookie('usuario', '', time()-3600);
    header('Location: ../index.php');
} else {
    header('Location: index.php');
}

?>