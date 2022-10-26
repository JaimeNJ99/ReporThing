<?php
    require "conexion.php";
    $conn = conexion();

    $correo = $_REQUEST['correo'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $res = pg_query($conn, $sql);
    $rows = pg_num_rows($res);

    //comprueba si existe el correo 0 no existe >0 existe
    echo $rows;

?>