<?php
// include("../template/cabecera.php");

const api_usuarios = "http://localhost/Github/tacnaAi_Inventarios/api/usuarios_api.php";

$ch = curl_init(api_usuarios);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$data = json_decode($result, true);
curl_close($ch);

// var_dump($data);
?>

<p><?= $data[2]["usuario"]?></p>
