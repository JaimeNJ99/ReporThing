<?php
    require "conexion.php";
    $conn = conexion();
    
    $id_rep = $_REQUEST['reporte'];
    $id_usr = $_REQUEST['usuario'];

    $sql = "SELECT usuario FROM reportados WHERE usuario = '$id_usr'";
    $res = pg_query($conn, $sql);
    $row = pg_num_rows($res);
    if($row != 0){
        echo 0;
    }else{
        $sql = "INSERT INTO reportados values ('$id_rep','$id_usr')";
        $res = pg_query($conn, $sql);

        $sql = "SELECT * FROM reportados WHERE id_reporte = '$id_rep";
        $res2 = pg_query($conn, $sql);
        $rows = pg_num_rows($res2);
    
        if($rows >= 10){
        $sql = "UPDATE reportes SET estatus = 0 WHERE id_reporte = '$id_rep";
        $res = pg_query($conn, $sql);
        }
        echo $rows;
    }
?>