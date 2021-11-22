<?php
    require "conexion.php";

    $conn = conexion();

    $id = $_REQUEST['id'];

    $sql = "UPDATE reportes SET estatus = 0 WHERE id_reporte = $id";
    $res = mysqli_query($conn, $sql);

    if(!$res){
        echo 0;
    }
    echo 1;
?>