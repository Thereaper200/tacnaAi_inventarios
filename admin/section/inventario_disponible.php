<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "../config/db.php";

include "../template/cabecera.php";



?>

<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Inventario Disponible</h2>

        <div class="form_container">
            <form action="scripts/inventario_disponible_upload.php" method="POST" enctype="multipart/form-data">

                <div class="form_boxes">
                    <label for="file">Archivo:</label>
                    <input type="file" class="input_button"  name="archivo" id="archivo"  accept=".numbers, .xlsx" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtiPadHomeButton">iPad HB:</label>
                    <input type="input" class="input_button"  name="txtiPadHomeButton" id="txtiPadHomeButton" placeholder="iPad HB" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtiPadFaceID">iPad Face ID:</label>
                    <input type="input" class="input_button"  name="txtiPadFaceID" id="txtiPadFaceID" placeholder="iPad Face ID" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtLapiz1ra">Lapices 1ra:</label>
                    <input type="input" class="input_button"  name="txtLapiz1ra" id="txtLapiz1ra" placeholder="Lapices 1ra" autocomplete="off">
                </div>
                
                <div class="form_boxes">
                    <label for="txtLapiz2da">Lapices 2da:</label>
                    <input type="input" class="input_button"  name="txtLapiz2da" id="txtLapiz2da" placeholder="Lapices 2da" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCargasUSBA">Adaptadores USB:</label>
                    <input type="input" class="input_button"  name="txtCargasUSBA" id="txtCargasUSBA" placeholder="Adaptadores USB" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCargasUSBC">Adaptadores Tipo C:</label>
                    <input type="input" class="input_button"  name="txtCargasUSBC" id="txtCargasUSBC" placeholder="Adaptadores Tipo C" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesLightning">Cables Lightning:</label>
                    <input type="input" class="input_button"  name="txtCablesLightning" id="txtCablesLightning" placeholder="Cables Lightning" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesUSBC">Cables USB C:</label>
                    <input type="input" class="input_button"  name="txtCablesUSBC" id="txtCablesUSBC" placeholder="Cables USB C" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesDisplayport">Cables Displayport:</label>
                    <input type="input" class="input_button"  name="txtCablesDisplayport" id="txtCablesDisplayport" placeholder="Cables Displayport" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtTecladosAlambricos">Teclados Alambricos:</label>
                    <input type="input" class="input_button"  name="txtTecladosAlambricos" id="txtTecladosAlambricos" placeholder="Teclados Alambricos" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtTecladosInalambricos">Teclados Inalambricos:</label>
                    <input type="input" class="input_button"  name="txtTecladosInalambricos" id="txtTecladosInalambricos" placeholder="Teclados Inalambricos" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtMouseInalambrico">Mouse Inalambrico:</label>
                    <input type="input" class="input_button"  name="txtMouseInalambrico" id="txtMouseInalambrico" placeholder="Mouse Inalambrico" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtMouseAlambrico">Mouse Alambrico:</label>
                    <input type="input" class="input_button"  name="txtMouseAlambrico" id="txtMouseAlambrico" placeholder="Mouse Alambrico" autocomplete="off">
                </div>
        
                <br>
   
                <br>
                
                <div class="btn_group" role="group" aria-label="">
                    <button type="submit" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>
            </form>

            <br>

            <br>

        </div>
    </div>
</div>

<div class="principal_columns">
    <div class="head_form">
        <h2 class="form_title">Inventario Descompuesto</h2>

        <div class="form_container">
            <form action="scripts/inventario_descompuesto_upload.php" method="POST" enctype="multipart/form-data">

                <div class="form_boxes">
                    <label for="file">Archivo:</label>
                    <input type="file" class="input_button"  name="archivo" id="archivo"  accept=".numbers, .xlsx" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtiPadHomeButton">iPad HB:</label>
                    <input type="input" class="input_button"  name="txtiPadHomeButton" id="txtiPadHomeButton" placeholder="iPad HB" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtiPadFaceID">iPad Face ID:</label>
                    <input type="input" class="input_button"  name="txtiPadFaceID" id="txtiPadFaceID" placeholder="iPad Face ID" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtLapiz1ra">Lapices 1ra:</label>
                    <input type="input" class="input_button"  name="txtLapiz1ra" id="txtLapiz1ra" placeholder="Lapices 1ra" autocomplete="off">
                </div>
                
                <div class="form_boxes">
                    <label for="txtLapiz2da">Lapices 2da:</label>
                    <input type="input" class="input_button"  name="txtLapiz2da" id="txtLapiz2da" placeholder="Lapices 2da" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCargasUSBA">Adaptadores USB:</label>
                    <input type="input" class="input_button"  name="txtCargasUSBA" id="txtCargasUSBA" placeholder="Adaptadores USB" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCargasUSBC">Adaptadores Tipo C:</label>
                    <input type="input" class="input_button"  name="txtCargasUSBC" id="txtCargasUSBC" placeholder="Adaptadores Tipo C" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesLightning">Cables Lightning:</label>
                    <input type="input" class="input_button"  name="txtCablesLightning" id="txtCablesLightning" placeholder="Cables Lightning" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesUSBC">Cables USB C:</label>
                    <input type="input" class="input_button"  name="txtCablesUSBC" id="txtCablesUSBC" placeholder="Cables USB C" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtCablesDisplayport">Cables Displayport:</label>
                    <input type="input" class="input_button"  name="txtCablesDisplayport" id="txtCablesDisplayport" placeholder="Cables Displayport" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtTecladosAlambricos">Teclados Alambricos:</label>
                    <input type="input" class="input_button"  name="txtTecladosAlambricos" id="txtTecladosAlambricos" placeholder="Teclados Alambricos" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtTecladosInalambricos">Teclados Inalambricos:</label>
                    <input type="input" class="input_button"  name="txtTecladosInalambricos" id="txtTecladosInalambricos" placeholder="Teclados Inalambricos" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtMouseInalambrico">Mouse Inalambrico:</label>
                    <input type="input" class="input_button"  name="txtMouseInalambrico" id="txtMouseInalambrico" placeholder="Mouse Inalambrico" autocomplete="off">
                </div>

                <div class="form_boxes">
                    <label for="txtMouseAlambrico">Mouse Alambrico:</label>
                    <input type="input" class="input_button"  name="txtMouseAlambrico" id="txtMouseAlambrico" placeholder="Mouse Alambrico" autocomplete="off">
                </div>
        
                <br>
   
                <br>
                
                <div class="btn_group" role="group" aria-label="">
                    <button type="submit" class="btn btn_success">Agregar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn_danger">Cancelar</button>
                </div>
            </form>

            <br>

            <br>

        </div>
    </div>
</div>


<?php
include "../template/pie.php"
?>