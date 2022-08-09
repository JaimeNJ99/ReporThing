<?php
    require "header.php";

    if(!isset($idu)){
      $id = time();
    }else{
      $id = $idu; 
    }
      $hora = date("H:i");
      $fecha = date("d/m/Y");
?>
<html>
    <head>
    <title>
        Nuevo Reporte
    </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
    <script> function initMap(){} </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly&libraries=geometry"></script>
    <!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script> -->
        <script>
            function registrar(){
                //tomamos las variables del formulario
                var titulo = registro.title.value;
                var tipo = registro.tipo.value;
                var longitud = registro.longitud.value;
                var latitud = registro.latitud.value;
                var descripcion = registro.descripcion.value;
                var zona = registro.zona.value;

                if(titulo == '' || tipo == 0 || descripcion == '' || longitud == ''|| latitud == '' || zona == '0' ){ //si faltan campos
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('')", 5000);
                    return false;
                }else{
                    document.registro.method = 'post';
                    document.registro.action = 'funciones/registroReporte.php'
                    document.registro.submit(); 
                }

            }
        </script>
        <style>
            #base{
                width: 80%;
                height: auto;
                margin: auto;
                background-color: #efefef;
            }
            #base h3{
              width: 350px;
              margin-left: 80px;
              text-align: center;
            }
            .columna{
                margin-right: auto;
                margin-left: auto;
                
                text-align: center;
                display: flexbox;

            }
            .error{
                color: FF0000;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                padding: 1px;
            }
            .google_canvas{
              height: 280px;
              width: 350px;
              float: left;
              margin-left: 80px;
            }
            .columna textarea{
              resize: none;
              width: 350px;
              height: 130px;
            }
            .columna input[name ="enviar"] {
              width: 50px;
              height: 30px;
            }
        </style>
    </head>
    <body>
        <form  name="registro" action="funciones/registroReporte.php" method="post" enctype="multipart/form-data">
            <br>
            <h2 style="text-align: center">Nuevo Reporte</h2>
            <br>
            <div id="base">
                <br>
                <div class="columna"><label>Titulo: </label><input type="text" id="titulo" name="titulo" placeholder="Titulo del reporte." style="text-align:center;"></div><br>
                <div id="google_canvas"  class="google_canvas"></div>
                <div class="columna"><label>Tipo: </label></div><br>
                <div class="columna"><select name="tipo" id="tipo">
                  <option value="0" selected="selected"> Selecciona</option>
                  <option value="1"> Asalto</option>
                  <option value="2"> Accidente</option>
                  <option value="3"> Acoso</option>
                  <option value="4"> Precaución</option>
                  <option value="5"> Otro</option>
                </select></div><br><br>
                <div class="columna"><label>Descripci&oacute;n:</label><br>
                <textarea id="descripcion" class="descripcion" name="descripcion" rows="8" cols="25"></textarea></div><br>
                <br><h3>Arrastra el marcador</h3>
                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
                <input type="hidden" id="zona" name="zona">
                <div class="columna"><input onClick="registrar(); return false;" type="submit" value="Enviar" name="enviar"></div>
                <div id="mensaje" class="error"></div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <br>
            </div>
        </form>
        <!-- Función Mapa -->
        <script type="text/javascript">
          (function(){
            if(!!navigator.geolocation){
              var map;
              var mapOptions={
                zoom: 15,
                mapTypeId: 'roadmap'
              };
              map = new google.maps.Map(document.getElementById("google_canvas"),mapOptions);
              navigator.geolocation.getCurrentPosition(function(position){
                var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                var latitud=position.coords.latitude;
                document.getElementById("latitud").value=latitud;
                var longitud=position.coords.longitude;
                document.getElementById("longitud").value=longitud;
                
                //crea marcador
                var marker = new google.maps.Marker({
                  position: geolocate,
                  draggable: true
                });

                //crea vertices de zona
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
                  strokeColor: 'rgb(255,140,0)',
                  fillColor: 'rgb(255, 255, 0)',
                  strokeWeight: 4,
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
                  strokeColor: 'rgb(0,139,139)',
                  fillColor: 'rgb(32,178,170)',
                  strokeWeight: 4,
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
                  strokeColor: 'rgb(75,0,130)',
                  fillColor: 'rgb(75,0,130)',
                  strokeWeight: 4,
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
                  strokeColor: 'rgb(0,100,0)',
                  fillColor: 'rgb(173,255,47)',
                  strokeWeight: 4,
                });
                
                //registra posición del marcador despues de moverlo
                google.maps.event.addListener(marker, 'dragend', function() {
                  latitud = marker.getPosition().lat();
                  longitud = marker.getPosition().lng();
                  document.getElementById("latitud").value=latitud;
                  document.getElementById("longitud").value=longitud;

                  //compara zona del marcador con los poligonos preestablecidos
                  if(google.maps.geometry.poly.containsLocation(marker.getPosition(), zapopan)){
                    document.getElementById("zona").value="zapopan";
                  }else if(google.maps.geometry.poly.containsLocation(marker.getPosition(), guadalajara)){
                    document.getElementById("zona").value="guadalajara";
                  }else if(google.maps.geometry.poly.containsLocation(marker.getPosition(), tlaquepaque)){
                    document.getElementById("zona").value="tlaquepaque";
                  }else if(google.maps.geometry.poly.containsLocation(marker.getPosition(), tonala)){
                    document.getElementById("zona").value="tonala";
                  }else{
                    alert("Debes seleccionar una ubicación dentro del area designada.");
                    document.getElementById("zona").value='0';
                  }
              
                });

                
                map.setCenter(geolocate);
                marker.setMap(map);
              });
            }else {
              document.getElementById("google_canvas").innerHTML="No Soportado";
            }
          }());
        </script> 

    </body>


    <?php require "footer.php" ?>
</html>
