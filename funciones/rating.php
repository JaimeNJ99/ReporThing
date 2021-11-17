<?php
    require "conexion.php";
    $conn = conexion();
    session_start();

    if($_SESSION["idu"]){
       $id_usuario = $_SESSION["idu"]; //si sesion iniciada
    }else{
        $id_usuario = time(); //si usuario anonimo
    }
    $calificacion = $_REQUEST['calificacion'];
    $id_reporte = $_REQUEST['id'];

    $sql = "INSERT INTO rating VALUES('$id_reporte','$calificacion','$id_usuario')";
    $res = mysqli_query($conn,$sql);

    $sql = "SELECT calificacion FROM rating WHERE id_reporte = '$id_reporte'";
    $res1 = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res1);

    $sql = "SELECT AVG(calificacion) FROM rating WHERE id_reporte = '$id_reporte'";
    $res2 = mysqli_query($conn,$sql);
    $promedio = mysqli_fetch_array($res2);

    if($row > 10 && $promedio[0] < 1.5 ){
        $sql = "UPDATE reportes SET estatus = 0 WHERE id_reporte = $id_reporte";
        $res3 = mysqli_query($conn, $sql);

    }

    if(!$res){
        echo 1;
    }
    echo 0;
    //return;
?>