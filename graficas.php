<?php
    require "header.php";
?>

<html>
    <head>
        <title>Graficas</title>
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
            width: 250px;
            height: 250px;
            margin: 10px;
            border: 1px solid #000;
            display: inline-block;
        }
        .titulog{
            width: 250px;
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
            <div class="grafica">aqui va una grafica</div>
            <div class="grafica">aqui va una grafica</div>
            <div class="grafica">aqui va una grafica</div>
            <br>
            <div class="titulog"><label>titulo grafica</label></div>
            <div class="titulog"><label>titulo grafica</label></div>
            <div class="titulog"><label>titulo grafica</label></div>
        </div>
    </body>
    <?php require "footer.php"; ?>
</html>