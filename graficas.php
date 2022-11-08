<?php
    require "header.php";
?>

<html>
    <head>
    <title>Graficas</title>
	<script src="JavaScript/plotly-2.6.3.min.js"></script>
    </head>
    <style>
        #base{
            width: 80%;
            height: auto;
            min-height: 80%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            
            background-color: #efefef;
        }
        .grafica{
            width: 75%;
            height: 350px;
            margin: 10px;
            border-bottom: 1px solid #000;
            display: inline-block;
        }
        .titulog{
            width: 350px;
            height: 25px;
            margin: 10px;
            border: 1px solid #000;
            background-color: #87CEFA;
            font-weight: bold;
            display: inline-block;
        }
        .graf{
            margin: auto;
            display: inline-block;
        }

    </style>
    <body>
        <h1 style="text-align:center">Gráficas</h1>
        <br>
        <div id="base">
            <br>
	        <div class="grafica">
                <div class="titulog"><label>Número de Reportes totales</label></div>
                <div id="Grafica1" class="graf"></div>
	        </div><br>
            <div class="grafica">
                <div class="titulog" class="graf"><label>Último mes</label></div>
                <div id="Grafica2" class="graf"></div>
            </div><br>
	        <div class="grafica">
                <div class="titulog"><label>Último mes, en Guadalajara</label></div>
                <div id="Grafica3" class="graf"></div>
            </div><br>
            <div class="grafica">
                <div class="titulog"><label>Último mes, en Zapopan</label></div>
                <div id="Grafica4" class="graf"></div>
	        </div><br>
            <div class="grafica">
                <div class="titulog"><label>Último mes, en Tlaquepaque</label></div>
                <div id="Grafica5" class="graf"></div>
	        </div><br>
            <div class="grafica">
                <div class="titulog"><label>Último mes, en Tonalá</label></div>
                <div id="Grafica6" class="graf"><b></b></div>
	        </div><br>
        </div> 
    </body>
    <?php require "footer.php"; ?>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#Grafica1').load('funciones/graficas/total_reportes.php');
		$('#Grafica2').load('funciones/graficas/ultimo_mes.php'); 
        $('#Grafica3').load('funciones/graficas/guadalajara.php');
        $('#Grafica4').load('funciones/graficas/zapopan.php');
        $('#Grafica5').load('funciones/graficas/tlaquepaque.php');
        $('#Grafica6').load('funciones/graficas/tonala.php');
    });
</script>