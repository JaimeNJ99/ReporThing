<?php
    require "header.php";
?>
<html>
    <head>
        <style>
            .centro{
                width: 100%;
                height: auto;
                justify-content: center;
                align-items: center;
                display: flex;
               
                
            }
            .tabla{
                border: 1px solid #000;
                height: 400px;;
                width: 25%;
                margin-right: 20px;
                display: inline-block;
                overflow: scroll;
            }
            .categorias{
                border: 1px solid #000;
                height:400px;
                width: 200px;
                margin-right: 10px;
                display: inline-block;
                overflow: scroll;
            }
            .entrada{
                text-align: center;
                width: 98%;
                height: 100px;
                border: 1px solid #000;
            }
        </style>
    </head>

    <body>
        <div><h1 style="text-align:center">Reportes</h1></div>
        <div class="centro">
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Reportes recientes</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Más votados</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Cerca a tu zona</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
        </div>

            <div><h1 style="text-align:center">Categorias</h1></div>

        <div class="centro">
        <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="categorias">
                <div class="entrada"style="background-color:steelblue"><h1>categoria</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
                <div class="entrada"><b>Nombre del reporte<br>ubicacion <br> fecha y hora</b></div>
            </div>
        </div>
        
    </body>
</html>
