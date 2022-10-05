<?php
    require "header.php";
    if(isset($idu)){
        $admin = $_SESSION['admin'];
    }
    if(isset($_GET["zona"])){
        $zona = $_GET["zona"];
    }
?>
<html>
    <head>
        <title>Reportes</title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script> function initMap(){} </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly&libraries=geometry"></script>
       <!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script> -->
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
            function zona(){
                    <?php if (isset($_GET["zona"])){ ?>
                        return;
                    <?php } ?>
                if(navigator.geolocation){
                    navigator.geolocation.getCurrentPosition(function(position){
                        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        var mapOptions={
                            zoom: 15,
                            mapTypeId: 'roadmap'
                        };
                        var map = new google.maps.Map(document.getElementById("google_canvas"),mapOptions);

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
                
                        if(google.maps.geometry.poly.containsLocation(pos, zapopan)){
                            window.location.href = window.location.href + "?zona=zapopan";
                        }else if(google.maps.geometry.poly.containsLocation(pos, guadalajara)){
                            window.location.href = window.location.href + "?zona=guadalajara";
                        }else if(google.maps.geometry.poly.containsLocation(pos, tlaquepaque)){
                            window.location.href = window.location.href + "?zona=tlaquepaque";
                        }else if(google.maps.geometry.poly.containsLocation(pos, tonala)){
                            window.location.href = window.location.href + "?zona=tonala";
                        }else{
                            alert("No se pudo determinar tu ubicación, Fuera del area de covertura.");
                        }
                    });
                }else{
                    alert("No se pudo determinar tu ubicación.");
                }
                
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
            #load{
                height: 100px; 
                width: 300px;
            }
        </style>
    </head>
    <body onload="zona();">
        <input type="hidden" id="google_canvas"  class="google_canvas" >
        <br>
        <div class="centro">
            <div class="tabla" id="tablaZona" >
            <div class="titulotabla"><?php if($zona){?><h1><?php echo $zona; ?></h1> <?php }else{ ?><h1>Determinando</h1><?php } ?></div>
                <?php  
                $sqlZona = "SELECT * FROM reportes WHERE  estatus = 1 AND zona = '$zona'";
                $res = mysqli_query($conn, $sqlZona);
                $row = mysqli_num_rows($res);
                    
                if($row == 0){ ?>
                    <div class="entrada">
                        <b>Determinando tu zona, porfavor espere...</b><br>
                        <a><img src="imagenes/recursos/load.gif" id="load"></a>
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
                    <div class="texto1"><p>Tipo de reporte:</p><?php echo $tipoConsulta[0]; ?></div>
                    <div class="texto1"><p>Fecha:</p><?php echo $consulta[7]; ?></div> 
                    <div class="texto1"><p>Hora:</p><?php echo $consulta[8]; echo ":"; echo $consulta[10]; ?></div><br><br><br>
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
                    <br>
                    <div class="texto">
                        <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                    </div><br>
                </div>
                <?php     
                        } mysqli_free_result($tipores);
                    }
                mysqli_free_result($res);
                //
                ?>
            </div>
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
