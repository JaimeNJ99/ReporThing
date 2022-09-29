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
                                    $('#mensaje').html('El tipo de suceso más probable es: '+ res);
                                },error: function(){
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
                                    $('#mensaje').html('El tipo de suceso más probable es: '+ res);
                                },error: function(){
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
                                    $('#mensaje').html('El tipo de suceso más probable es: '+ res);
                                },error: function(){
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
                                    $('#mensaje').html('El tipo de suceso más probable es: '+ res);
                                },error: function(){
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
            }
        </style>
    </head>
    <body>
    <div id="cuerpo">
        <input type="hidden" id="google_canvas"  class="google_canvas" >    
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
        <div>
            <b>¿Quieres conocer el tipo de suceso más común según tu zona y hora actual?</b>
            <br><br>
            <input type="button" onclick="zona()" value="Haz click aqui">
            <br><br>
            <div id="carga" style="display:none">
                <b>Determinando el tipo de suceso, porfavor espere...</b><br>
                <a><img src="imagenes/recursos/cargando.gif" id="load"></a>
            </div>
            <div id="mensaje"></div>
        </div>
        
        
    </div>
    <?php require "footer.php"; ?>
    </body>
</html>
