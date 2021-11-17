<?php
    require "header.php";
?>

<html>
    <head>
        <title>Graficas</title>
	<link rel="stylesheet" type="text/css" href="JavaScript/bootstrap/css/bootstrap.css">
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
        .grafica1{
            width: 405px;
            height: 305px;
            margin: 10px;
            border: 1px solid #000;
            display: inline-block;
        }

	.grafica2{
            width: 405px;
            height: 455px;
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
	    <div class="grafica1">
	    <div id="Grafica1"></div>
            <div class="titulog"><label>Grafica de Pastel - Reportes</label></div>
	    </div>
            <div class="grafica2">
	    <div id="Grafica2">>/div>
	    </div>
	    <div class="titulog"><label>Grafica de barras - Zonas donde hay mas reportes</label></div>

        </div>
    </body>
    <?php require "footer.php"; ?>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#Grafica1').load('pastel.php');
		$('#Grafica2').load('barras.php'); g});
</script>