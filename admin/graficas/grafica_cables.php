<?php
require_once "../config/jpgraph-4.4.2/src/jpgraph.php";
require_once "../config/jpgraph-4.4.2/src/jpgraph_bar.php";

include("../config/db.php");

$sql = "SELECT oficina, cable FROM inventarios_diarios WHERE fecha IN (SELECT MAX(fecha) FROM inventarios_diarios GROUP BY oficina)";

$resultado = $conexion->query($sql);

$oficinas = array();
$cables = array();

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $oficinas[] = $fila['oficina'];
    $cables[] = $fila['cable'];
}

// Crear el gráfico de barras
$grafico = new Graph(850,300);
$grafico->SetScale('textlin');
$grafico->SetShadow();

// Crear un gráfico de barras
$barras = new BarPlot($cables);

// Agregar las barras al gráfico
$grafico->Add($barras);

// Establecer etiquetas para el eje X
$grafico->xaxis->SetTickLabels($oficinas);

// Título del gráfico
$grafico->title->Set("Inventarios Diarios de Cables");

// Título del eje X
$grafico->xaxis->title->Set("Oficinas");

// Título del eje Y
//$grafico->yaxis->title->Set("Cantidad de Cables");

// Mostrar el gráfico
$grafico->Stroke();


?>