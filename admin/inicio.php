<?php include("template/cabecera.php"); ?>
<div class="contenedor_tareas">
        <div class="perfil">
            <div id="fecha">  </div>
            <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
            <span>Recuerda terminar tus tareas</span>
        </div>

        <div class="agregar_tarea">
            <input type="text" id="input" placeholder="Agrega una tarea">
            <i id="enter" class="fas fa-plus-circle"></i>
        </div>

        <div class="seccion_tarea">
            <h3>Tareas pendientes:</h3>
            <ul id="lista">
                <!-- EJEMPLO DE COMO SE VERIA CADA OBJETO DE LA LISTA
                <li>
                <i class="far fa-circle co" data="realizado" id="0"></i>
                <p class="text line-through">Hacer la tarea de español</p>
                <i class="fas fa-trash de" data="eliminado"></i>
                </li> -->
            </ul>
        </div>
    </div> 
    <script src="todolist.js"></script>

<?php include("template/pie.php"); ?> 