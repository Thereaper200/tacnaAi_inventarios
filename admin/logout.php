<?php

if(isset($_COOKIE['usuario'])) {
    setcookie('usuario', '', time()-3600);
    setcookie('puesto', $row["puesto"], time()-3600);
    setcookie('oficina', $row["oficina"], time()-3600);
    setcookie('admin', $row['admin'], time()-3600);
    header('Location: ../index.php');
} else {
    header('Location: index.php');
}

?>