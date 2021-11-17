<?php
    require "header.php";

    if(!$idu){
      $id = time();
    }else{
      $id = '00'+$idu;
    }
?>
<html>
    <head>
    <title>
        Nuevo Reporte
    </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
    <script
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly"></script>

    </script>
        <script>
            function registrar(){
                //tomamos las variables del formulario
                var titulo = registro.title.value;
                var tipo = registro.tipo.value;
                var longitud = registro.longitud.value;
                var latitud= registro.latitud.value;
                var descripcion = registro.descripcion.value;

                if(titulo == '' || tipo == 0 || descrip == '' || longitu == ''|| latitu == ''){ //si faltan campos
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('')", 5000);
                    return false;
                }else{

                    document.registro.method = 'post';
                    document.registro.action = 'funciones/registroReporte.php'
                    document.registro.submit();
                    /**/
                }

            }
        </script>
        <style>
            #login{
                width: 80%;
                height: auto;
                margin: auto;
                background-color: #efefef;
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
              height: 50vh;
              width: 60vh;
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
            <div id="login">
                <br>
                <div class="columna"><label>Titulo: </label><input type="text" id="titulo" name="titulo" placeholder="Titulo del reporte."></div><br>
                <div id="google_canvas"  class="google_canvas"></div>
                <div class="columna"><label>Tipo: </label></div><br>
                <div class="columna"><select name="tipo" id="tipo">
                  <option value="0"> Selecciona</option>
                  <option value="1"> Evento</option>
                  <option value="2"> Crimen</option>
                </select></div><br><br>
                <div class="columna"><label>Descripci&oacute;n:</label><br>
                <textarea id="descripcion" class="descripcion" name="descripcion" rows="8" cols="25"></textarea></div><br>
                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
                <div class="columna"><input onClick="registrar(); return false;" type="submit" value="Enviar" name="enviar"></div>
                <div id="mensaje" class="error"></div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <br>
            </div>
        </form>
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

                var infoWindow = new google.maps.InfoWindow({
                  map: map,
                  position: geolocate,
                  content:
                  '<h1>Tu ubicaci&oacute;n:</h1>'+
                  '<h2>Latitud: '+ position.coords.latitude+'</h2>'+
                  '<h2>Longitud: '+ position.coords.longitude +'</h2>'
                });
                map.setCenter(geolocate);
              });
            }else {
              document.getElementById("google_canvas").innerHTML="No Soportado";
            }
          }());
        </script>

    </body>


    <?php require "footer.php" ?>
</html>
