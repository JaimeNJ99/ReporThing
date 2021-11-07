<?php
    require "header.php";
    $zona = 0;
    $tipo = 0;
?>
<html>
    <head>
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
                max-height: 500px;
                height: auto;
                width: 25%;
                margin-right: 20px;
                display: inline-block;
                overflow-y: scroll;
            }
            .categorias{
                border: 1px solid #000;
                height: auto;
                max-height:500px;
                width: 200px;
                margin-right: 10px;
                display: inline-block;
                overflow-y: scroll;
            }
            .entrada{
                text-align: center;
                width: 98%;
                height: 100px;
                border: 1px solid #000;
            }
        </style>
    </head>

    <body>
        <div><h1 style="text-align:center">Reportes</h1></div>
        <div class="centro">
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Reportes recientes</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Más votados</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE id_reporte =
                    (SELECT id_reporte FROM rating ORDER BY calificacion DESC LIMIT 10)";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no se ha calificado algun reporte</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="tabla">
                <div class="entrada" style="background-color:steelblue"><h1>Cerca a tu zona</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes WHERE id_reporte = 
                    (SELECT id_reporte FROM zona WHERE id_zona = $zona 
                    ORDER BY id_reporte DESC LIMIT 10)";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes cerca de ti</b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
        </div>

            <div><h1 style="text-align:center">Categorias</h1></div>

        <div class="centro">
        <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
            <div class="categorias">
                <div class="entrada" style="background-color:steelblue"><h1>categoria</h1></div>
                <?php 
                    $sql = "SELECT * FROM reportes
                    WHERE tipo = $tipo 
                    ORDER BY id_reporte DESC LIMIT 10";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == 0){ ?>
                        <div class="entrada">
                            <b>Todavia no hay reportes </b>
                        </div>
                    <?php }else{
                        for($i = 0; $i < $row; $i++){
                            $consulta = mysqli_fetch_row($res);
                ?>
                <div class="entrada">
                    <b>Nombre del reporte <?php echo $consulta[1]; ?>
                    <br>Ubicación <?php echo $consulta[3]; ?>
                    <br>Descripción <?php echo $consulta[4]; ?>
                    </b>
                </div>
                <?php     
                } }
                mysqli_free_result($res);
                ?>
            </div>
        </div>
        <?php require "footer.php" ?>
    </body>
</html>
