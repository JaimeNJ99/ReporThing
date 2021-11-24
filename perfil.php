<?php 
    require "header.php";
  
    
    $sql = "SELECT * FROM reportes WHERE reportes.id_reporte IN 
        (SELECT reportes_realizados.id_reporte FROM reportes_realizados WHERE id_usuario = $idu)";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    
?>
<html>
    <head>
        <title>Mi perfil</title>
        <script src="javascript/jquery-3.6.0.min.js"></script>
        <script>
            function modificar(){
                window.location.href = 'modificar_perfil.php';
            }
        </script>
        <style>
            #base{
                margin-left: 10%;
                margin-right: 10%;
                width: 80%;
                height: auto;
                border: 1px solid #000;
                background-color: #efefef;
            }
            #imagenp{
                width: auto;
                height: auto;
                max-width: 300px;
                max-height: 160px;
                margin-top: 5%;
                margin-left: 20%;
                display: inline-block;
            }
            #imagenp a img{
                max-width: 200px;
                max-height: 110px;
            }
            #datos{
                margin-top: 5%;
                margin-left: 15%;
                text-align: center;
                display: inline-block;
            }
            #misreportes{
                width: 80%;
                height: auto;
                max-height: 500px;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid #000;
                background-color: #ffffff;
                display: block;
                overflow-y: scroll;
                
            }
            #reportes{
                width: 80%;
                height: 80px;
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid #000;
                position: relative;
                display: block;
                background-color: #87CEFB;
            }
            .caja{
                width: 100%;
                height: auto;
                min-height: 120px;
                text-align: center;
                border-bottom: 1px solid #000;
                display: block;
            }
            #modificar{
                width: 150px; 
                height: 30px; 
                background-color:floralwhite
            }
            #modificar:hover{
                background-color:lightsteelblue;
                color: #FFFFFF;
            }
        </style>
    </head>
    <body> 
        <br><br>
        <div id="base">
            <br>
            <h1 style="text-align: center; ">Mi perfil</h1>
            <div id="imagenp">
                <a><img src="imagenes/avatar/<?php echo $avataru; ?>"></a>
            </div>
            <div id="datos">
                <h1><?php echo $nameu ?></h1>
                <br>
                <h1><?php echo $correou ?></h1>
                <br>
            </div>
            <br><br>
            <div style="width: 100%; display: inline-block; text-align: center;">
                <input type="button" value="Modificar Perfil" id="modificar" onclick="modificar();">
            </div>
            <br><br>
            <div id="reportes">
                <br>
                <h1>Mis reportes</h1>
            </div>
            <div id="misreportes">
                <?php if($row == 0){ ?>
                <div class="caja">
                    <br><br>
                    <h1>Todavia no has realizado ningun reporte</h1>
                </div>

                <?php }else{ 
                    for($i=0;$i < $row; $i++){
                        $consulta = mysqli_fetch_row($res); //tomamos toda la fila
                        
                        $sql = "SELECT nombre FROM tipos WHERE id_tipos = $consulta[2]";
                        $tipores = mysqli_query($conn, $sql);
                        $tipoConsulta = mysqli_fetch_row($tipores);
                        ?>
                        <div class="caja">
                            <!--Se muestran todos los datos del reporte -->
                            <h1><?php echo $consulta[1]; ?></h1>
                            <h3>Tipo: <?php echo $tipoConsulta[0]; ?></h3>
                            <h3>Ubicacion: <?php echo $consulta[3]; echo $consulta[4]; ?></h3>
                            <h3>Descripcion: <?php echo $consulta[5]; ?></h3>
                            <?php 
                                if($consulta[6] == 1){
                                    $estatus = "activo";
                                }else{
                                    $estatus = "inactivo";
                                }

                            ?>
                            <h3>Estatus: <?php echo $estatus; ?> </h3>
                        </div>
                <?php }
                } ?>
            </div>
            <br><br>
        </div>
    </body>
    <?php require "footer.php";?>
</html>