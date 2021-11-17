<?php
    require "header.php";
    $zona = 0;
    $tipo = 0;
?>
<html>
    <head>
        <title>Reportes</title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script> 
            function rating(id){
                var calif = $('#calif'+id).val();
                //window.location.href = 'funciones/rating.php?calificacion='+calif+'&id='+id;
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
                ?>
                <div class="entrada">
                    <div class="texto"><div class="titulo"><?php echo $consulta[1]; ?></div></div>
                    <div class="texto">Ubicación:<br><?php echo $consulta[3]; ?></div>
                    <p>Descripción: </p>
                    <div class="texto"><div class="descripcion"><?php echo $consulta[4]; ?></div></div>
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
                ?>
            </div>
            <div class="tabla">
                <div class="titulotabla"><h1>Más votados</h1></div>
                <?php 
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
                ?>
                <div class="entrada">
                    <div class="texto"><div class="titulo"><?php echo $consulta[1]; ?></div></div>
                    <div class="texto">Ubicación:<br><?php echo $consulta[3]; ?></div>
                    <p>Descripción: </p>
                    <div class="texto"><div class="descripcion"><?php echo $consulta[4]; ?></div></div>
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
                ?>
               <div class="entrada">
                    <div class="texto"><div class="titulo"><?php echo $consulta[1]; ?></div></div>
                    <div class="texto">Ubicación:<br><?php echo $consulta[3]; ?></div>
                    <p>Descripción: </p>
                    <div class="texto"><div class="descripcion"><?php echo $consulta[4]; ?></div></div>
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
                ?>
            </div>
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////

                CODIGO DE CATEGORIAS

//////////////////////////////////////////////////////////////////////////////////////////////////-->
        <br>    
        <div><h1 style="text-align:center">Categorias</h1></div>
        <br>
        
        <div class="categorias">
            <div class="titulotabla">
                <h1>Categorías</h1>
                <div>
                    <input type="radio" id="categoria1" value="1" name="categoria_seleccionada">
                    <label for="categoria1">tipo1</label>
                    <input type="radio" id="categoria2" value="2" name="categoria_seleccionada">
                    <label for="categoria2">tipo2</label>
                    <input type="radio" id="categoria3" value="3" name="categoria_seleccionada">
                    <label for="categoria3">tipo3</label>
                    <input type="radio" id="categoria4" value="4" name="categoria_seleccionada">
                    <label for="categoria4">tipo4</label>
                </div>
            </div>
            <script>

            </script>
            <?php 
                    $sql = "SELECT * FROM reportes ORDER BY id_reporte DESC LIMIT 3";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes cerca de ti</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
               <div class="entrada">
                    <div class="texto"><div class="titulo"><?php echo $consulta[1]; ?></div></div>
                    <div class="texto">Ubicación:<br><?php echo $consulta[3]; ?></div>
                    <p>Descripción: </p>
                    <div class="texto"><div class="descripcion"><?php echo $consulta[4]; ?></div></div>
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
                ?>
        </div>
        <!-- 
        <div class="centro">
        <div class="categorias">
                <div class="titulotabla"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    <br>Calificalo: 
                    <select name="rating" onchange="if (this.selectedIndex) rating();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="titulotabla"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    <br>Calificalo: 
                    <select name="rating" onchange="if (this.selectedIndex) rating();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="titulotabla"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    <br>Calificalo: 
                    <select name="rating" onchange="if (this.selectedIndex) rating();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="titulotabla"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    <br>Calificalo: 
                    <select name="rating" onchange="if (this.selectedIndex) rating();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="titulotabla"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    <br>Calificalo: 
                    <select name="rating" onchange="if (this.selectedIndex) rating();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?> 
            </div>
        </div> -->
        <?php require "footer.php" ?>
    </body>
</html>
