<?php
    require "header.php";
    if(isset($idu)){
        $admin = $_SESSION['admin'];
    }
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
                window.location.href =  "reportes_categoria.php?tipo="+tipo; 
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
                width: 24%;
                height: auto;
                margin-bottom: 2px;
                margin: 2px;
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
        </style>
    </head>
    <body>
        <br>
        <div class="centro">
        <div class="tabla">
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
            <?php 
                    
                $sql = "SELECT * FROM reportes WHERE tipo = $tipo AND estatus = 1 ORDER BY id_reporte DESC LIMIT 100";
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
                    <div class="texto">
                        <input class= "admin" type="submit" value="Eliminar" onclick="eliminaAdmin(<?php echo $consulta[0]; ?>)">
                    </div><br>
                </div>
                <?php     
                    } mysqli_free_result($tipores); 
                }
                
                mysqli_free_result($res);
                ?>
        </div>
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
