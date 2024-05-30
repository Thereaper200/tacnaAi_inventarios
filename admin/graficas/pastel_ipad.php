<?php
require_once "../config/jpgraph-4.4.2/src/jpgraph.php";
require_once "../config/jpgraph-4.4.2/src/jpgraph_pie.php";
include "../config/db.php";

// Ruta a las fuentes
//define('TTF_DIR','~/Library/Fonts/');



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

// Crear el gráfico de pastel
$grafico = new PieGraph(700,550);
$grafico->SetShadow();

// Crear un gráfico de pastel
$pastel = new PiePlot($ipads);

// Agregar las barras al gráfico
$grafico->Add($pastel);

// Etiquetas para el gráfico de pastel
$pastel->SetSliceColors(array('blue', 'red', 'green', 'yellow', 'orange'));

// Etiquetas para las porciones del pastel
$pastel->SetLabels($oficinas);

// Título del gráfico
$grafico->title->Set("Inventarios Diarios de iPads");

// Mostrar el gráfico
$grafico->Stroke();


?>
