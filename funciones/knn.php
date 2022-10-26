<?php
    require "conexion.php";
    $conn = conexion();

    
    $zona = $_SESSION["zona"];
    $sql = "SELECT * FROM reportes WHERE zona = '$zona'; ";

?>