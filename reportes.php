<?php
    require "header.php";
    require "funciones/conexionReplica.php";
    $bandera=0;
    if(!isset($conn)){
      $bandera=1;
      $conn=conexionR();
    }
    if(isset($idu)){
        $id = $idu;
        if($_SESSION['admin'] == 1){
            $admin = $_SESSION['admin'];
        }
    }else{
        $id = time() * rand(1,20);
    }
?>
<html>
    <head>
        <title>Reportes</title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            function reportado(reporte, usuario){
                    $.ajax({
					    url       : 'funciones/reporteReportado.php?reporte='+reporte+'&usuario='+usuario, 
						type      : 'post',
						dataType  : 'text',
						success   : function(res){ 
						    if(res != 0){
						    	$('#mensaje'+reporte).html('Reporte registrado');
						    }else{
                                $('#mensaje'+reporte).html('Ya se ha registrado tu reporte');
                            }
						},error: function(){
						    alert('Error al conectar al servidor...');
						}
					});
            }
            function eliminaAdmin(id){
                $.ajax({
                    url         : 'funciones/Adminelimina.php?id='+id,
                    type        : 'post',
                    dataType    : 'text',
                    success     : function(res){
                        if(res == 0){
                            $('#mensaje'+id).html('No se pudo eliminar');
                        }else{
                            $('#mensaje'+id).html('Reporte eliminado');
                        }
                    }
                });
            }
            function verReporte(id){
                window.location.href = "ver_reporte.php?val="+ id;
            }
            function close(){
                
            }
            $(document).ready(function(){
                $("#cerrar").click(function(){
                    $("#aviso").hide();
                });
            });
        </script>
        <style>
            .centro{
                width: 90%;
                height: auto;
                justify-content: center;
                align-items: center;
                display: flex;
                margin: auto;
                
            }
            .tabla{
                border: 1px solid #000;
                max-height: 400px;
                min-height: 400px;
                height: auto;
                width: 60%;
                margin-right: 20px;
                display: inline-block;
                overflow-y: scroll;
            }

            .titulotabla{
                background-color: skyblue;
                height: auto;
                min-height: 50px;
                width: auto;
                border: 1px solid #000;
                text-align: center;
            }
            .titulotabla div h1{
                width: auto;
                height: auto;
                background-color: silver;
            }
            .entrada{
                text-align: center;
                width: auto;
                height: auto;
                min-height: 100px;
                border: 1px solid #000;
                display: block;
            }
            .texto{
                width: 60%;
                height: auto;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 2px;
            }
            .texto1{
                width: 23%;
                height: auto;
                margin-bottom: 2px;
                margin-left: 8px;
                float: left;
                font-size: 100%;
                background-color: #efefef;
                border: 1px solid #000;
            }
            .texto1 p{
                background-color: B6CEFB;
                font-size: 130%;
            }
            .titulo{
                width: auto;
                height: auto;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 2px;
                background-color: #7D2DFF;
                color: aliceblue;
                font-size: 175%;
            }
            .descripcion{
                width: 60%;
                height: auto;
                min-height: 20px;
                border: 1px solid #000;
                background-color: #efefef;
                margin-left: auto;
                margin-right: auto;
                font-size: 115%;
                margin-bottom: 2px;
            }
            .texto input{
                margin-left: auto;
                margin-right: auto;
                <?php
                    if($admin == 0){
                        echo 'display: none;';
                    }
                ?>
            }
            #aviso{
                width: 500px;
                height: auto;
                background: lightsteelblue;
                border: 1px solid #000;
                display: block;
                margin: auto;
                text-align: center;
            }
            #cerrar{
                float: right;
                margin-right: 1px;
                
            }
        </style>
    </head>
    <body>
        <br>
        <div id="aviso">
            <b style="text-align: center;">¡Aviso!</b>
            <button id="cerrar">x</button><br>
            <b>Los reportes de está pagina son generados por los usuarios por lo que puede haber reportes falsos,</b>
            <b> te recomendamos siempre consultar fuentes oficiales.</b>
        </div><br>
        <div class="centro">
            <!-- tabla reportes recientes -->
            <div class="tabla">
                <div class="titulotabla"><h1>Recientes</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE estatus = 1 ORDER BY id_reporte DESC LIMIT 50";
                    $res = pg_query($conn, $sql);
                    $row = pg_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = pg_fetch_row($res);
                            $sql = "SELECT nombre FROM tipos WHERE id_tipos = $consulta[2]";
                            $tipores = pg_query($conn, $sql);
                            $tipoConsulta = pg_fetch_row($tipores);
                ?>
                <div class="entrada">
                    <div class="titulo"><?php echo $consulta[1]; ?></div><br>
                    <div class="texto1"><p>Zona:</p><?php echo $consulta[9];?></div>
                    <div class="texto1"><p>Tipo:</p><?php echo $tipoConsulta[0]; ?></div>
                    <div class="texto1"><p>Fecha:</p><?php echo $consulta[7]; ?></div> 
                    <div class="texto1"><p>Hora:</p><?php echo $consulta[8]; echo ":"; echo $consulta[10]; ?></div><br><br><br>
                    <div class="descripcion"><?php echo $consulta[5]; ?></div>
                    <br> 
                    <input type="submit" value="Ver ubicación" onclick="verReporte(<?php echo $consulta[0]; ?>)">
                    <br>
                    <?php if(isset($idu) && $bandera==0){ ?>
                        <div class="texto">
                            <input type="submit" value="Reportar abuso" onclick="reportado(<?php echo $consulta[0]; ?>, <?php echo $id; ?>)">
                            <?php if(isset($admin)){ ?>
                                <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                            <?php } ?>
                        </div>
                    <br>
                    <?php } ?>
                    <div id="mensaje<?php echo $consulta[0]; ?>" style="width: 100%; height: auto; color:skyblue;"></div>
                </div>
               
                <?php     
                } pg_free_result($tipores); 
                }
                pg_free_result($res);
                ?>
            </div>
            
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
