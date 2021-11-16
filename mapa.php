<?php
    require "header.php";

    if(!$idu){
      $id = time();
    }else{
      $id = $idu;
    }
?>
<html>
    <head>
    <title>
        Mapa
    </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly"></script>>

    </script>
        <script>
            function registrar(){
                //tomamos las variables del formulario
                var titulo = registro.title.value;
                var tipo = registro.tipo.value;
                var descripcion = registro.descripcion.value;
                var longitud = registro.longitud.value;
                var latitud= registro.latitud.value;

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
                height: 70%;
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
              height: 400px;
              width: 90%;
              margin-left: 5%;
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
            <h2 style="text-align: center">Mapa</h2>
            <br>
            <div id="login">
              <div class="columna">
                <div id="google_canvas"  class="google_canvas"></div>
              </div>
                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
            </div>
        </form>
        <script type="text/javascript">
        var map;
          (function iniGmap(){
            if(!!navigator.geolocation){
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
                        map.setCenter(geolocate);

                      <?php
                          $sql = "SELECT * FROM reportes ORDER BY id_reporte DESC LIMIT 10";
                          $res = mysqli_query($conn, $sql);
                          $row = mysqli_num_rows($res);
                          if($row == 0){?>

                          <?php
                        }else{
                            for($i = 0; $i < $row; $i++){
                                  $consulta = mysqli_fetch_row($res);?>

                                  var nombrereporte="<?php echo $consulta[1]; ?>";
                                  var latitudreporte=<?php echo $consulta[3]; ?>;
                                  var longitudreporte=<?php echo $consulta[4]; ?>;
                                  var descripcion="<?php echo $consulta[5]; ?>";
                                  var posicion=new google.maps.LatLng(latitudreporte,longitudreporte);
                                  var contenido='<h1>Nombre: '+ nombrereporte +'</h1>'+
                                  '<h2>Descripci&oacute;n: '+ descripcion +'</h2>';

                                  var geolocateReports = new google.maps.Marker({
                                    position:posicion,
                                    map: map,
                                    info: contenido
                                  });

                                  var infoWindow = new google.maps.InfoWindow({
                                    content:contenido
                                  });

                                  google.maps.event.addListener(geolocateReports, 'click', function(){
                                    infoWindow.setContent( this.info );
                                    infoWindow.open( map, this );
                                  });
                                <?php
                              } }
                              mysqli_free_result($res);
                              ?>

                      });
                    }else {
                      document.getElementById("google_canvas").innerHTML="No Soportado";
                    }
                  }());;


        </script>

    </body>


    <?php require "footer.php" ?>
</html>
