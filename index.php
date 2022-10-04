<?php

    require "header.php";
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $hora  = date("H");
    $minuto = date("i");
    $zona = "zapopan";
?>
<html>
    <head>
        <title>
            ReporThing || Inicio
        </title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script> function initMap(){} </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly&libraries=geometry"></script>
        <script>
            function zona(){
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
                            //alert("zona = zapopan");
                            var mensaje = document.getElementById("mensaje");
                            var x = document.getElementById("carga");
                            var btn = document.getElementById("btnzona");
                            btn.style.display = "none";
                            mensaje.style.display = "none";
                            x.style.display = "block";
                            $.ajax({
                                url       : 'funciones/pyExecute.php', 
						        type      : 'post',
						        dataType  : 'text',
                                data      : 'zona=zapopan',
                                success   : function(res){
                                    mensaje.style.display = "block";
                                    x.style.display = "none";
                                    $('#mensaje').html('El tipo de suceso más probable es: <br>'+ res);
                                },error: function(){
                                    x.style.display = "none";
						            alert('Error al conectar al servidor...');
						        }
                            });
                        }else if(google.maps.geometry.poly.containsLocation(pos, guadalajara)){
                            //alert("zona = guadalajara");
                            var mensaje = document.getElementById("mensaje");
                            var x = document.getElementById("carga");
                            mensaje.style.display = "none";
                            x.style.display = "block";
                            $.ajax({
                                url       : 'funciones/pyExecute.php', 
						        type      : 'post',
						        dataType  : 'text',
                                data      : 'zona=guadalajara',
                                success   : function(res){
                                    mensaje.style.display = "block";
                                    x.style.display = "none";
                                    $('#mensaje').html('El tipo de suceso más probable es: <br>'+ res);
                                },error: function(){
                                    x.style.display = "none";
						            alert('Error al conectar al servidor...');
						        }
                            });
                        }else if(google.maps.geometry.poly.containsLocation(pos, tlaquepaque)){
                            //alert("zona = tlaquepaque");
                            var mensaje = document.getElementById("mensaje");
                            var x = document.getElementById("carga");
                            mensaje.style.display = "none";
                            x.style.display = "block";
                            $.ajax({
                                url       : 'funciones/pyExecute.php', 
						        type      : 'post',
						        dataType  : 'text',
                                data      : 'zona=tlaquepaque',
                                success   : function(res){
                                    mensaje.style.display = "block";
                                    x.style.display = "none";
                                    $('#mensaje').html('El tipo de suceso más probable es: <br>'+ res);
                                },error: function(){
                                    x.style.display = "none";
						            alert('Error al conectar al servidor...');
						        }
                            });
                        }else if(google.maps.geometry.poly.containsLocation(pos, tonala)){
                            //alert("zona = tonala");
                            var mensaje = document.getElementById("mensaje");
                            var x = document.getElementById("carga");
                            mensaje.style.display = "none";
                            x.style.display = "block";
                            $.ajax({
                                url       : 'funciones/pyExecute.php', 
						        type      : 'post',
						        dataType  : 'text',
                                data      : 'zona=tonala',
                                success   : function(res){
                                    mensaje.style.display = "block";
                                    x.style.display = "none";
                                    $('#mensaje').html('El tipo de suceso más probable es: <br>'+ res);
                                },error: function(){
                                    x.style.display = "none";
						            alert('Error al conectar al servidor...');
						        }
                            });
                        }else{
                            alert("No se pudo determinar tu ubicación, Fuera del area de covertura.");
                        }
                    });
                }else{
                    alert("No se pudo determinar tu ubicación.");
                }
                
            }
        </script>
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
                font-family: sans-serif;
            }
            #ml{
                width: auto;
                height: 300px;
                background-color: #D3D3D3;
            }
            #mltext{
                float: left;
                margin-left: 18%;
                margin-top: 20px;
                height: 255px;
                width: 30%;
                background-color: #87CEFA;
            }
            #mltext b{
                text-align: center;
                color:darkmagenta;
                font-size: 30px;
            }
            #mlout{
                float: right;
                margin-right: 18%;
                margin-top: 20px;
                height: 250px;
                width: 30%;
                color:darkmagenta;
            }
            input[type=button]{
                width: 200px;
                height: 70px;
            }
            #block{
                width: auto;
                height: 300px;
                background-color: #D3D3D3;
                display: block;
            }
            .textboxl{
                float: left;
                margin-left: 18%;
                margin-top: 20px;
                height: 250px;
                width: 30%;
                color:darkmagenta;
            }
            .textboxr{
                float: right;
                margin-right: 18%;
                margin-top: 20px;
                height: 255px;
                width: 30%;
                color:darkmagenta;
                background-color: #87CEFA;
            }
            .textboxr b{
                text-align: center;
                color:darkmagenta;
                font-size: 40px;
            }

        </style>
    </head>
    <body>
    <div id="cuerpo">
        <input type="hidden" id="google_canvas"  class="google_canvas" >    
        <br><br>   
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
        </div><br><br><br><br><br><br>
        <div id="ml">
            <div id="mltext"><br><br><br>
                <b>¿Quieres conocer el tipo de suceso más común según tu zona y hora actual?</b>
            </div>
            <div id="mlout">
                <div id="btnzona">
                    <br><br><br><br><br>
                    <input type="button" onclick="zona()" value="Haz click aqui">
                </div>
                <div id="carga" style="display:none"><br><br><br>
                    <b>Determinando el tipo de suceso, porfavor espere...</b><br>
                    <a><img src="imagenes/recursos/load.gif" id="load" width="130px" height="110px"></a>
                </div><br><br><br><br><br>
                <div id="mensaje"></div>
            </div>
        </div><br><br>
        <div id="block">
            <div class="textboxl">
                <div><br>
                    <div><B>Emergencias</B></div>
                    <div>911</div>
                </div>
                <div><br>
                    <div><B>Protección civil y bomberos</B></div>
                    <div>01(33) 3675 3060</div>
                </div>
                <div><br>
                    <div><B>Cruz roja</B></div>
                    <div>01(33) 3613 8811 / 01(33) 3345 7777</div>
                </div>
                <div><br>
                    <div><B>Atención ciudadana</B></div>
                    <div>01 800 JALISCO (5254726) / (33) 3668 1804</div>
                </div>
            </div>
            <div class="textboxr"><br><br><br>
                <b>Conoce los números de emergencia</b>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
    </body>
</html>
