<?php include("template/cabecera.php"); ?>

<div class="jumbotron">
    <h1 class="page_title">Bienvenido a la página de inventario de Tacna AI</h1>
    <div class="img_viewer">
        <div class="img_container">
            <img class="gifs_inicio" src="img/colaboradores/colab2.gif" alt="Colaboradores de Tacna">
            <img class="gifs_inicio" src="img/colaboradores/colaboradores.gif" alt="Colaboradores de Tacna">
            <img class="gifs_inicio" src="img/colaboradores/halloween.gif" alt="Colaboradores de Tacna">
        </div>
    </div>
</main>

<main class="grafs_container">

    <h2 class="title">Gráficas diarias</h2>

    <div class="container_section">

        <aside class="grafs_navbar">
            <nav class="index_contents">
                <a href="#adaptaders">Adaptadores</a>
                <a href="#Wire">Cables</a>
                <a href="#ipad">iPad's</a>
                <a href="#ipencil">iPencil's</a>
            </nav>
        </aside>

        <div class="grafs">

            <div class="img_grafs">
                <img src="admin/graficas/grafica_adaptadores.php" id="adaptaders">
            </div>

            <div class="img_grafs">
                <img src="admin/graficas/grafica_cables.php" id="wire">
            </div>

            <div class="img_grafs">
                <img src="admin/graficas/grafica_ipad.php" id="ipad">
                <img src="admin/graficas/pastel_ipad.php">
            </div>

            <div class="img_grafs">
                <img src="admin/graficas/grafica_lapiz.php" id="ipencil">
            </div>

        </div>

    </div>

</main>

<?php include("template/pie.php"); ?>