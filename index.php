<?php

    require "header.php";
    /*----------Ejemplo de como hacer consultas a la bd------------------------
    $sql = "SELECT titulo FROM reportes WHERE id_reporte = 4"; //se realiza la consulta sql
    $consulta = mysqli_query($conn,$sql); //devuelve un objeto con la consulta
    $row = mysqli_num_rows($consulta);  //devuelve el numero de columnas de la consulta
    $res = mysqli_fetch_array($consulta);   //devuelve un array con los campos de la consulta
    $nombre = $res["0"];    //guarda el campo 0 de la consulta
    */
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $hora  = date("H:i:s");
    $zona = "zapopan"
?>
<html>
    <head>
        <title>
            ReporThing || Inicio
        </title>
        <style>
            #nuevo_reporte{
                width: 260px;
                height: 90px;
                margin-left: auto;
                margin-right: auto;
            }
            #nuevo_reporte a img{
                width: 250px; 
                height: 80px;
                margin: auto;
            }
            #nuevo_reporte a img:hover{
               width: 260px;
            }
            #cuerpo{
                width: auto;
                min-height: 60%;
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div id="cuerpo">
        <br>   
		<h1><img src = "imagenes/recursos/logo.png" width="60px" height="60px">
		    <img src = "imagenes/recursos/Report.jpg" width="100px" height="60px">
	    	<img src = "imagenes/recursos/Thing.png" width="120px" height="60px">
        </h1>
		<h4>ReporThing es una plataforma en la cual se busca ayudar a mantener informadas a las personas
		<br> acerca de distintos sucesos peligrosos o interesantes en su entorno
        </h4>
        <br>
        <div id="nuevo_reporte">
            <a href="nuevoReporte.php"><img class="imagen"src="./imagenes/recursos/Nuevo_reporte.png"></a>
        </div>
        <input type="button">
        <?php //aqui se mostraría el resultado de aplicar machine learning 
            $out = shell_exec("python KNN/tipoSucesoknn.py '$zona' '$fecha' '$hora'");
            echo $out; 
        ?>
    </div>
    <?php require "footer.php"; ?>
    </body>
</html>
