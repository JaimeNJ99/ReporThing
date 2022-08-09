<?php
    require "header.php";
    if(isset($idu)){
        $admin = $_SESSION['admin'];
    }
?>
<html>
    <head>
        <title>Reportes</title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            function rating(id){
                var calif = $('#calif'+id).val();
                
                if(calif != ''){
                    $.ajax({
					    url       : 'funciones/rating.php?calificacion='+calif+'&id='+id, 
						type      : 'post',
						dataType  : 'text',
						success   : function(res){ //manda la consulta y recibe verdadero o falso
						    if(res == 0){ //si se encontraron registros con datos iguales
						    	$('#mensaje'+id).html('Puntuacion registrada');
						    }
						},error: function(){
						    alert('Error al conectar al servidor...');
						}
					});
                }
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
                width: 24%;
                height: auto;
                margin-bottom: 2px;
                margin: 2px;
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
                height: 40px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 2px;
                background-color: 7D2DFF;
                color: aliceblue;
                font-size: 175%;
            }
            .descripcion{
                width: 60%;
                height: auto;
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
        </style>
    </head>
    <body>
        <br>
        <div class="centro">
            <!-- tabla reportes recientes -->
            <div class="tabla">
                <div class="titulotabla"><h1>Recientes</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE estatus = 1 ORDER BY id_reporte DESC LIMIT 20";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                            $sql = "SELECT nombre FROM tipos WHERE id_tipos = $consulta[2]";
                            $tipores = mysqli_query($conn, $sql);
                            $tipoConsulta = mysqli_fetch_row($tipores);
                ?>
                <div class="entrada">
                    <div class="titulo"><?php echo $consulta[1]; ?></div><br>
                    <div class="texto1"><p>Zona:</p><?php echo $consulta[9];?></div>
                    <div class="texto1"><p>Tipo:</p><?php echo $tipoConsulta[0]; ?></div>
                    <div class="texto1"><p>Fecha:</p><?php echo $consulta[7]; ?></div> 
                    <div class="texto1"><p>Hora:</p><?php echo $consulta[8]; ?></div><br><br><br>
                    <div class="descripcion"><?php echo $consulta[5]; ?></div>
                    <!--<p>Calificalo:</p> 
                    <input type="number" id="calif<?php echo $consulta[0]; ?>" min="1" max="5">
                    <input type="submit" value="Calificalo" onclick="rating(<?php echo $consulta[0]; ?>)">
                    <div class="texto">Calificación:
                        <?php 
                            
                            $sqlCalif = "SELECT AVG(calificacion) FROM rating WHERE id_reporte = '$consulta[0]'";
                            $resCalif = mysqli_query($conn, $sqlCalif);
                            $consultaCalif = mysqli_fetch_row($resCalif);
                            if($consultaCalif[0] != ''){
                                echo $consultaCalif[0];
                            }else{
                                echo "Sin calificación"; 
                            }
                            mysqli_free_result($resCalif);
                        ?>
                    </div> -->
                    <br> 
                    <input type="submit" value="Ver ubicación" onclick="verReporte(<?php echo $consulta[0]; ?>)">
                    <div id="mensaje<?php echo $consulta[0]; ?>" 
                        style="width: 100%; height: auto; color:skyblue;"></div>
                    <div class="texto">
                        <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                    </div><br>
                </div>
               
                <?php     
                } mysqli_free_result($tipores); 
                }
                mysqli_free_result($res);
                ?>
            </div>
            <!-- tabla reportes más votados -->
            <!-- <br><br>
            <div class="tabla">
                <div class="titulotabla"><h1>Más votados</h1></div>
                <?php 
                    //Consulta los 20 reportes más votados
                    $sql = "SELECT AVG(rating.calificacion),id_reporte FROM rating 
                        GROUP by id_reporte ORDER BY AVG(calificacion) DESC LIMIT 20";
                    $resAVG = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($resAVG);
                    
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no se ha calificado algun reporte</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            //toma el id del siguiente reporte más votado
                            $avg = mysqli_fetch_row($resAVG);
                            //
                            $sql = "SELECT * FROM reportes WHERE id_reporte = $avg[1]
                                    AND estatus = 1";
                            $res = mysqli_query($conn, $sql);
                            $row1 = mysqli_num_rows($res);
                            for($j = 0; $j < $row1; $j++){
                                $consulta = mysqli_fetch_row($res);
                                $sql = "SELECT nombre FROM tipos WHERE id_tipos = $consulta[2]";
                                $tipores = mysqli_query($conn, $sql);
                                $tipoConsulta = mysqli_fetch_row($tipores);
                    ?>
                    <div class="entrada">
                        <div class="texto"><div class="titulo"><?php echo $consulta[1]; ?></div></div>
                        <div class="texto">Ubicación:<br><?php echo $consulta[3]; echo ", "; echo $consulta[4]; ?></div>
                        <div class="texto">Tipo de reporte:<br><?php echo $tipoConsulta[0]; ?></div>
                        <p>Descripción: </p>
                        <div class="texto"><div class="descripcion"><?php echo $consulta[5]; ?></div></div>
                        <br>Calificalo: 
                        <input type="number" id="calif<?php echo $consulta[0]; ?>" min="1" max="5">
                        <input type="submit" value="Calificalo" onclick="rating(<?php echo $consulta[0]; ?>)">
                        <div id="mensaje<?php echo $consulta[0]; ?>" 
                                style="width: 100%; height: auto; color:skyblue;"></div>
                        <div class="texto">Calificación:
                        <?php 
                            
                                $sqlCalif = "SELECT AVG(calificacion) FROM rating WHERE id_reporte = '$consulta[0]'";
                                $resCalif = mysqli_query($conn, $sqlCalif);
                                $consultaCalif = mysqli_fetch_row($resCalif);
                                if($consultaCalif[0] != ''){
                                    echo $consultaCalif[0];
                                }else{
                                    echo "Sin calificación"; 
                                }
                                mysqli_free_result($resCalif);
                        ?>
                                </div>
                    <div class="texto">
                        <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                    </div>
                </div>
                <?php
                                mysqli_free_result($tipores); 
                            } 
                            mysqli_free_result($res);
                        }
                   
                }
                mysqli_free_result($resAVG);
                
                ?>
            </div> -->
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
