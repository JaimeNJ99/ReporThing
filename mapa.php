<?php

    require "header.php";

    $consulta = mysqli_query($conn,"SELECT titulo FROM reportes WHERE id_reporte = 4");
    //$row = mysqli_num_rows($sql);
    //$consulta = mysqli_fetch_array($sql);
    //$nombre = $consulta["titulo"];
?>
<style>
  #mapa{
    display: flex;
    justify-content: center;
    align-items: center
  }
</style>
<html>
    <head>
        <title>
            ReporThing || Mapa
        </title>
    </head>
    <body>
       <div><?php echo $row ?></div>

        <div><label> Mapa </label></div>
        <div id="mapa">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7466.634968392862!2d-103.32510549267577!3d20.656658667736377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1635376389953!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <?php require "footer.php"; ?>
    </body>
</html>
