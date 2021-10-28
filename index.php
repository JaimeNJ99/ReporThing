<?php
    
    require "header.php";
    
    $consulta = mysqli_query($conn,"SELECT titulo FROM reportes WHERE id_reporte = 4");
    //$row = mysqli_num_rows($sql);
    //$consulta = mysqli_fetch_array($sql);
    //$nombre = $consulta["titulo"];
?>
<html>
    <head>
        <title>
            ReporThing || Inicio
        </title>
    </head>
    <body>
        <div>
            Pagina principal
        </div>
       <div><?php echo $row ?></div>
        <label> Bienvenido </label>
        <div></div>
	<center> 
		<h1> <br> <img src = "imagenes/recursos/logo.png" width="60px" height="60px">
			<img src = "imagenes/recursos/Report.jpg" width="100px" height="60px"> 
			<img src = "imagenes/recursos/Thing.png" width="120px" height="60px"></h1>
		<h4>ReporThing es una plataforma en la cual se busca ayudar a mantener informadas a las personas 
		<br> acerca de distintos sucesos peligrosos o interesantes en su entorno</h4>	
	</center> 
        <?php require "footer.php"; ?>        
    </body>
</html> 