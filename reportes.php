<?php
    require "header.php";
    $zona = 1;
    //$tipo = 1;
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

            function cambioTipo(tipo){
                window.location.href =  "reportes.php?tipo="+tipo; 
            }
        </script>
        <style>
            .centro{
                width: 100%;
                height: auto;
                justify-content: center;
                align-items: center;
                display: flex;
               
                
            }
            .tabla{
                border: 1px solid #000;
                max-height: 400px;
                min-height: 400px;
                height: auto;
                width: 25%;
                margin-right: 20px;
                display: inline-block;
                overflow-y: scroll;
            }
            .categorias{
                border: 1px solid #000;
                height: auto;
                min-height: 400px;
                max-height: 400px;
                width: 50%;
                margin-right: auto;
                margin-left: auto;
               
                overflow-y: scroll;
            }
            .titulotabla{
                background-color:steelblue;
                height: auto;
                min-height: 50px;
                width: 98%;
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
                width: 98%;
                height: auto;
                min-height: 100px;
                border: 1px solid #000;
            }
            .texto{
                width: 100%;
                height: auto;
                margin-bottom: 2px;
                display: inline-block;
            }
            .titulo{
                width: 100%;
                height: auto;
                font-size: 150%;
            }
            .descripcion{
                width: 90%;
                height: auto;
                border: 1px solid #000;
                background-color: #efefef;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>

    <body>
        <div><h1 style="text-align:center">Reportes</h1></div>
        <div class="centro">
            <div class="tabla">
                <div class="titulotabla"><h1>Reportes recientes</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes ORDER BY id_reporte DESC LIMIT 10";
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
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                mysqli_free_result($tipores);
                ?>
            </div>
            <div class="tabla">
                <div class="titulotabla"><h1>Más votados</h1></div>
                <?php 
                    //CAMBIAR ESTA CONSULTA
                    $sql = "SELECT * FROM reportes WHERE id_reporte IN
                    (SELECT id_reporte FROM rating ORDER BY calificacion  ASC)  LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no se ha calificado algun reporte</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
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
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                mysqli_free_result($tipores);
                ?>
            </div>
            <div class="tabla">
                <div class="titulotabla"><h1>Cerca a tu zona</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE id_reporte = 
                    (SELECT id_reporte FROM zona WHERE id_zona = $zona 
                    ORDER BY id_reporte DESC LIMIT 10)";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes cerca de ti</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
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
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                //mysqli_free_result($tipores);
                ?>
            </div>
        </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////

                CODIGO DE CATEGORIAS

/////////////////////////////////////////////////////////////////////////////////////////////-->
        <br>    
        <div><h1 style="text-align:center">Categorias</h1></div>
        <br>
        
        <div class="categorias">
            <div class="titulotabla">
                <?php 
                    if (isset($_GET["tipo"])){
                        $tipo = $_GET["tipo"];
                    }
                    else{
                        $tipo = 1;
                    }
                    $sql = "SELECT nombre, descripcion FROM tipos WHERE id_tipos = $tipo";
                    $resTipo = mysqli_query($conn,$sql);
                    $consultaTipo = mysqli_fetch_row($resTipo);
                ?>
                <h1><?php echo $consultaTipo[0]; ?></h1>
                <h2><?php echo $consultaTipo[1]; ?></h2>
                <div>
                    <input type="radio" id="categoria1" value="1" name="categoria_seleccionada" onclick="cambioTipo(1);" <?php if ($tipo == 1){ echo "checked";} ?>>
                    <label for="categoria1">Asalto</label>
                    <input type="radio" id="categoria2" value="2" name="categoria_seleccionada" onclick="cambioTipo(2);" <?php if ($tipo == 2){ echo "checked";} ?>>
                    <label for="categoria2">Accidente</label>
                    <input type="radio" id="categoria3" value="3" name="categoria_seleccionada" onclick="cambioTipo(3);" <?php if ($tipo == 3){ echo "checked";} ?>>
                    <label for="categoria3">Acoso</label>
                    <input type="radio" id="categoria4" value="4" name="categoria_seleccionada" onclick="cambioTipo(4);" <?php if ($tipo == 4){ echo "checked";} ?>>
                    <label for="categoria4">Precaución</label>
                    <input type="radio" id="categoria4" value="5" name="categoria_seleccionada" onclick="cambioTipo(5);" <?php if ($tipo == 5){ echo "checked";} ?>>
                    <label for="categoria4">Otro</label>
                </div>
            </div>
            <script>

            </script>
            <?php 
                    
                    $sql = "SELECT * FROM reportes WHERE tipo = $tipo";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes de este tipo</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
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
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                mysqli_free_result($tipores);
                ?>
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
