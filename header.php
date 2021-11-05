<?php
    session_start();

    require "funciones/conexion.php";
    $conn = conexion(); //conexion a la BD

    //si existe la sesion tomamos el id
    if($_SESSION["idu"]){
        $idu     = $_SESSION["idu"];
        $nameu   = $_SESSION["nombre"];
        $correou = $_SESSION["correo"];
        $adminu  = $_SESSION["admin"];
        $avataru = $_SESSION["avatar"];
    }

    if($avataru == ''){
        $avataru = "default.png";
    }

?>
<html>
    <head>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        
        
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
                width: 50%;
                height: auto;
                display: inline-block;
                text-align: left;
            }
            .logom{
                width: auto;
                height: 60px;
                margin-top: 5px;
                display: inline-block;
            }
            #usuario{
                width: 60px;
                height: 60px;
                float: right;
                overflow: hidden;
                margin-right: 30px;
                margin-top: 5px;
                border-radius: 50%;
                <?php if(!$idu){ ?>
                    display: none;
                <?php } ?>
            }
            #img{
                width: 60px; 
                height: 60px;
            }
            #menu{
                width: 100%;
                height: 25px;
                background-color: #87CEFA;
            }
            #loginm{
                width: auto;
                height: auto;
                float: right;
                margin-right: 10px;
                margin-top: 5px;
                border: 2px solid #F0F8FF;
                <?php if($idu){ ?>
                    display: none;
                <?php } ?>
                
            }
            .botonmenu{
                width: 19%;
                height: auto;
                margin-left: 5px;
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
            <div id = "nombreheader">
                <a href="index.php"><img src = "imagenes/recursos/Reporthing.png" class="logom" ></a>
            </div>
            <div id = "usuario"><a href="login.php"><img src = "imagenes/avatar/<?php echo $avataru; ?>" id="img"></a></div>
            <div id = "loginm"><a href="login.php"><img src="imagenes/recursos/login.png"></a></div>
        </div>
        <div id = "menu">
            <div class ="botonmenu"><a href="index.php">Inicio</a></div>
            <div class ="botonmenu"><a href="nuevoReporte.php">Nuevo Reporte</a></div>
            <div class ="botonmenu"><a href="mapa.php">Mapa</a></div>
            <div class ="botonmenu"><a href="reportes.php">Reportes</a></div>
            <div class ="botonmenu"><a href="graficas.php">Gráficas</a></div>
        </div>
    </body>
</html>
