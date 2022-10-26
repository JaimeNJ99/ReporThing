<!DOCTYPE html>
<?php
    session_start();

    require "funciones/conexion.php";
    $conn = conexion(); //conexion a la BD
    header('Content-Type: text/html; charset=UTF-8');
    //si existe la sesion tomamos el id
    if(isset($_SESSION["idu"])){
        $idu     = $_SESSION["idu"];
        $nameu   = $_SESSION["nombre"];
        $correou = $_SESSION["correo"];
        $adminu  = $_SESSION["admin"];
        $avataru = $_SESSION["avatar"];
    }

    if(isset($avataru) && $avataru == ''){
        $avataru = "default.png";
    }

?>
<html>
    <head>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <style>
            *{
                margin: 0%;
                padding: 0%;
            }
            #header{
                width:100%;
                height: 70px;
                background-color: #87CEFA;
                position:fixed;
                z-index: 5;
            }
            #bg{
                height: 110px;
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
                <?php if(!isset($idu)){ ?>
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
                <?php if(isset($idu)){ ?>
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
            .botonmenu a{
                color: #000;
                text-decoration: none;
            }
            .botonmenu a:hover{
                color: #33BAFF;
            }
            #usuario ul{
                position: absolute;
                width: 200px;
                height: auto;
                top: 12%;
                left: 80%;
                display: none;
                border: 2px solid #000;
                background-color: #C1C9C6;
            }
            #usuario ul li a{
                color: #397E88;
                text-decoration: none;
            }
            #usuario ul li a:hover{
                color: #33BAFF;
            }
            #usuario ul li {
                width: 90%;
                margin: auto;
                text-align: center;
                background-color: #DAE6E2;
                display: none;
            }
            #usuario:hover ul{
                display: block;
            }
            #usuario:hover ul li{
                display: block;
            }
            #usuario ul a img{
                margin: auto;
                width: auto;
                height: auto;
                max-width: 150px;
                max-height: 80px;
                display: block;
            }
            #usuario ul b{
                margin: auto;
                text-align: center;
            }

            .botonmenu ul{
                position: absolute;
                width: 197px;
                height: auto;
                top: 130%;
                left: 61%;
                display: none;
                border: 2px solid #000;
                background-color: #33BAFF;
            }
            .botonmenu ul li a{
                color: #000;
                text-decoration: none;
            }
            .botonmenu ul li a:hover{
                color: #33BAFF;
            }
            .botonmenu ul li {
                width: 98%;
                height: 25px;
                margin: auto;
                text-align: center;
                border: 1px solid #000;
                background-color: #F0F8FF;
                display: none;
            }
            .botonmenu:hover ul{
                display: block;
            }
            .botonmenu:hover ul li{
                display: block;
            }

        </style>
    </head>
    <body>
        <div id = "header">
            <div id = "logo"><a href="index.php"><img src = "imagenes/recursos/logo.png" width="60px" height="60px"></a></div>
            <div id = "nombreheader">
                <a href="index.php"><img src = "imagenes/recursos/Reporthing.png" class="logom" ></a>
            </div>
            <?php if(isset($idu)){ ?>
            <div id = "usuario">
                <a><img src = "imagenes/avatar/<?php echo $avataru; ?>" id="img"></a>
                <ul>
                    <br>
                    <a><img src = "imagenes/avatar/<?php echo $avataru; ?>" ></a>
                    <h3 style="text-align: center; color: #397E88;"><?php echo $nameu ?></h3>
                    <li><a href="perfil.php">Mi cuenta</a></li>
                    <li><a href="Modificar_perfil.php">Modificar perfil</a></li>
                    <li><a href="funciones/cerrarSesion.php">Cerrar sesión</a></li>
                    <br>
                </ul>
            </div>
            <?php } ?>
            <div id = "loginm"><a href="login.php"><img src="imagenes/recursos/login.png"></a></div>
            <div id = "menu">
            <div class ="botonmenu"><a href="index.php">Inicio</a></div>
            <div class ="botonmenu"><a href="nuevoReporte.php">Nuevo Reporte</a></div>
            <div class ="botonmenu"><a href="mapa.php">Mapa</a></div>
            <div class ="botonmenu"><a style="color:#000;">Reportes</a>
                <ul>
                   <li><a href="reportes.php">Reportes recientes</a></li>
                   <li><a href="reportes_zona.php">Reportes en tu zona</a></li>
                   <li><a href="reportes_categoria.php">Reportes por categoría</a></li> 
                </ul>
            </div>
            <div class ="botonmenu"><a href="graficas.php">Gráficas</a></div>
        </div>
        
        </div>
        <div id="bg"></div>
    </body>
</html>
