<?php
    require "header.php";
    $zona = 1;
    //$tipo = 1;
    $admin = $_SESSION['admin'];
?>
<html>
    <head>
        <title>Reportes</title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly"></script>
        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script>
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
            function inicio() {
                return map = new google.maps.Map(document.getElementById("google_canvas"));
            }
            function zona(lat, alt, id, map){
                var vertices = [
                    {lat: 20.613377, lng: -103.395842},
                    {lat: 20.636385, lng: -103.307237},
                    {lat: 20.694670, lng: -103.269753},
                    {lat: 20.740587, lng: -103.309156},
                    {lat: 20.709887, lng: -103.406395}
                ];
                var guadalajara = new google.maps.Polygon({
                    path: vertices,
                    map: map,
                });

                var vertices = [
                    {lat: 20.613377, lng: -103.395842},
                    {lat: 20.589646, lng: -103.420527},
                    {lat: 20.553967, lng: -103.350489},
                    {lat: 20.604751, lng: -103.258135},
                    {lat: 20.636385, lng: -103.307237}
                ];
                var tlaquepaque = new google.maps.Polygon({
                    path: vertices,
                    map: map,
                    });

                var vertices = [
                    {lat: 20.609627, lng: -103.479527},
                    {lat: 20.747102, lng: -103.441075},
                    {lat: 20.773427, lng: -103.342884},
                    {lat: 20.740587, lng: -103.309156},
                    {lat: 20.709887, lng: -103.406395},
                    {lat: 20.613377, lng: -103.395842} 
                ];
                var zapopan = new google.maps.Polygon({
                    path: vertices,
                    map: map,
                });
                        
                var vertices = [
                    {lat: 20.694670, lng: -103.269753},
                    {lat: 20.667243, lng: -103.198343},
                    {lat: 20.579684, lng: -103.226229},
                    {lat: 20.636385, lng: -103.307237} 
                ];
                var tonala = new google.maps.Polygon({
                    path: vertices,
                    map: map,
                });
                        

                var posicion = new google.maps.LatLng(lat, alt);
                var d = document.getElementById("tablaZona");
                //////////////cambiar a tu ubicación actual////////////////
                var miZona = new google.maps.LatLng(20.725010, -103.366725);
                ///////////////////////////////////////////////////////////

                if(google.maps.geometry.poly.containsLocation(posicion, zapopan) == true && google.maps.geometry.poly.containsLocation(miZona, zapopan) != true){
                        var d_reporte = document.getElementById("zona"+id);
                        d.removeChild(d_reporte);
                }else if(google.maps.geometry.poly.containsLocation(posicion, guadalajara) == true && google.maps.geometry.poly.containsLocation(miZona, guadalajara) != true){
                        var d_reporte = document.getElementById("zona"+id);
                        d.removeChild(d_reporte);
                }else if(google.maps.geometry.poly.containsLocation(posicion, tonala) == true && google.maps.geometry.poly.containsLocation(miZona, tonala) != true){
                        var d_reporte = document.getElementById("zona"+id);
                        d.removeChild(d_reporte);
                }else if(google.maps.geometry.poly.containsLocation(posicion, tlaquepaque) == true && google.maps.geometry.poly.containsLocation(miZona, tlaquepaque) != true){
                        var d_reporte = document.getElementById("zona"+id);
                        d.removeChild(d_reporte);
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
                background-color: skyblue;
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
        <div><h1 style="text-align:center">Reportes</h1></div>
        <div id="google_canvas"  class="google_canvas" ></div>
        <br>
        <div class="centro">
            <div class="tabla">
                <div class="titulotabla"><h1>Reportes recientes</h1></div>
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
                } mysqli_free_result($tipores); 
                }
                mysqli_free_result($res);
                ?>
            </div>
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
            </div> 
            <div class="tabla" id="tablaZona">
                <div class="titulotabla"><h1>Cerca a tu zona</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE  estatus = 1";
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
                
                            
               <div class="entrada" id="zona<?php echo $consulta[0] ?>">
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
                <script type="text/javascript"> zona(<?php echo $consulta[3] ?> , <?php echo $consulta[4] ?> , <?php echo $consulta[0] ?> , inicio());  </script>
                <?php     
                        } mysqli_free_result($tipores);
                    }
                mysqli_free_result($res);
                //
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
                    $sql = "SELECT nombre, descripcion FROM tipos WHERE id_tipos = $tipo ";
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
                    
                $sql = "SELECT * FROM reportes WHERE tipo = $tipo AND estatus = 1";
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
                    <div class="texto">
                        <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                    </div>
                </div>
                <?php     
                    } mysqli_free_result($tipores); 
                }
                
                mysqli_free_result($res);
                ?>
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
