<?php
    require "header.php";
    require "funciones/conexionReplica.php";
    $bandera=0;
    if(!isset($conn)){
      $bandera=1;
      $conn=conexionR();
    }
?>
<html> 
    <head>
    <title>
        Mapa
    </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
    
    <script> function initMap(){} </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUkFLr3FhXywsglhyFSpg1CitJHWRh_dQ&callback=initMap&libraries=&v=weekly&libraries=geometry"></script>
    <!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script> -->
        
        <style>
            #base{
                width: 80%;
                height: 440px;
                margin: auto;
                background-color: #efefef;
                
            }
            .google_canvas{
              height: 400px;
              width: 90%;
              margin: auto;
            }
        </style>
    </head>
    <body>
            <br>
            <h2 style="text-align: center">Mapa</h2>
            <br>
            <div id="base"> 
              <br>
              <?php if($bandera == 1){
                echo "No disponible";
              }else{ ?>
              <div id="google_canvas"  class="google_canvas"></div>   
              <input type="hidden" id="latitud" name="latitud">
              <input type="hidden" id="longitud" name="longitud">
              <?php } ?>
            </div>
        <script type="text/javascript">
        var map;
          (function iniGmap(){
            if(!!navigator.geolocation){
              var mapOptions={
                zoom: 13,
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
                          $sql = "SELECT * FROM reportes WHERE estatus = '1' ORDER BY id_reporte DESC LIMIT 30";
                          $res = pg_query($conn, $sql);
                          $row = pg_num_rows($res);
                          if($row == 0){?>

                          <?php
                        }else{
                            for($i = 0; $i < $row; $i++){
                                  $consulta = pg_fetch_row($res);?>

                                  var nombrereporte="<?php echo $consulta[1]; ?>";
                                  var latitudreporte="<?php echo $consulta[3]; ?>";
                                  var longitudreporte="<?php echo $consulta[4]; ?>";
                                  var descripcion="<?php echo $consulta[5]; ?>";
                                  var fecha="<?php echo $consulta[7]; ?>";
                                  var hora="<?php echo $consulta[8]; ?>";
                                  var minuto="<?php echo $consulta[10]; ?>";
                                  var posicion=new google.maps.LatLng(latitudreporte,longitudreporte);
                                  var contenido='<h1>'+ nombrereporte +'</h1>'+
                                  '<h3>Fecha: '+ fecha +'</h3>'+
                                  '<h3>Hora: '+ hora + ':'+ minuto +'</h3><br>'+
                                  '<h2>'+ descripcion +'</h2>';

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
                              pg_free_result($res);
                              ?>
                          //////////////// geometrias
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
                          {lat: 20.553967, lng: -103.350489},
                          {lat: 20.579684, lng: -103.226229},
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
                        
                      });
                    }else {
                      document.getElementById("google_canvas").innerHTML="No Soportado";
                    }
                  }());;
        </script>
    </body>
    <?php require "footer.php" ?>
</html>
