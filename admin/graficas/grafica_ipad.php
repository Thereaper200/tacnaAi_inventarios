<?php 
require_once "../config/jpgraph-4.4.2/src/jpgraph.php";
require_once "../config/jpgraph-4.4.2/src/jpgraph_bar.php";

include("../config/db.php");

// Consulta SQL para obtener los datos más recientes por cada oficina
$sql = "SELECT oficina, ipad FROM inventarios_diarios WHERE fecha IN (SELECT MAX(fecha) FROM inventarios_diarios GROUP BY oficina)";
$resultado = $conexion->query($sql);

// Arrays para almacenar los datos de la consulta
$oficinas = array();
$ipads = array();

// Recuperar los datos y almacenarlos en los arrays
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $oficinas[] = $fila['oficina'];
    $ipads[] = $fila['ipad'];
}

// Crear el gráfico de barras
$grafico = new Graph(850,300);
$grafico->SetScale('textlin');
$grafico->SetShadow();

// Crear un gráfico de barras
$barras = new BarPlot($ipads);

// Agregar las barras al gráfico
$grafico->Add($barras);

// Establecer etiquetas para el eje X
$grafico->xaxis->SetTickLabels($oficinas);

// Título del gráfico
$grafico->title->Set("Inventarios Diarios de iPads");

// Título del eje X
$grafico->xaxis->title->Set("Oficinas");

// Título del eje Y
//grafico->yaxis->title->Set("Cantidad de iPads");

// Mostrar el gráfico
$grafico->Stroke();




?>