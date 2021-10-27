<?php
    require "funciones/conexion.php";
    $conn = conexion(); //conexion a la BD
    
?>
<html>
    <head>
        <style>
            #header{
                width:100%;
                height: 70px;
                background-color: #87CEFA;
            }
            #logo{
                width: auto;
                height: auto;
                display: inline-block;
            }
            #nombreheader{
                width: 84%;
                height: auto;
                display: inline-block;
                text-align: left;
            }
            #usuario{
                width: 9%;
                display: inline-block;
            }
            #menu{
                width: 100%;
                height: 25px;
                background-color: #87CEFA;
            }
            .botonmenu{
                width: 19%;
                height: auto;
                text-align: center;
                border: 1px solid #000;
                display: inline-block;
                background-color: #F0F8FF;
            }
        </style>
    </head>
    <body>
        <div id = "header">
            <div id = "logo"><a href="index.php"><img src = "imagenes/recursos/logo.png" width="60px" height="60px"></a></div>
            <div id = "nombreheader"><h1>ReporThing</h1></div>
            <div id = "usuario"><a><img src = "imagenes/avatar/default.png" width="100px" height="60px"></a></div>
        </div>
        <div id = "menu">
            <div class ="botonmenu"><a href="index.php">Inicio</a></div>
            <div class ="botonmenu"><a href="">Mapa</a></div>
            <div class ="botonmenu"><a href="">Reportes</a></div>
            <div class ="botonmenu"><a href="">Gráficas</a></div>
            <div class ="botonmenu"><a href="login.php">Iniciar sesión</a></div>
        </div>
    </body>
</html>