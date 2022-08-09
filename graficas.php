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
            display: block;
            background-color: #efefef;
        }
        .grafica{
            width: 75%;
            height: auto;
            margin: 10px;
            border: 1px solid #000;
            display: inline-block;
        }
        .titulog{
            width: 350px;
            height: 30px;
            margin: 10px;
            border: 1px solid #000;
            display: inline-block;
        }


    </style>
    <body>
        <br>
        <div id="base">
            <br>
            <h1>Información General</h1>
	        <div class="grafica">
                <div id="Grafica1"></div>
                <div class="titulog"><label>Grafica de Pastel - Numero de Reportes</label></div>
	        </div><br>
            <div class="grafica">
	            <div id="Grafica2"></div>
                <div class="titulog"><label>Grafica de barras - Rating de Reportes</label></div>
	        </div>
	        
        </div> 
    </body>
    <?php require "footer.php"; ?>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#Grafica1').load('pastel.php');
		$('#Grafica2').load('barras.php'); });
</script>