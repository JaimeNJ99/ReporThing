<?php

    require "conexion.php";
    $conn = conexion();

    //recibimos las variables
    $id           = $_REQUEST['id'];
    $titulo       = $_REQUEST['titulo'];
    $tipo         = $_REQUEST['tipo'];
    $descripcion  = $_REQUEST['descripcion'];
    $latitud      = $_REQUEST['latitud'];
    $longitud     = $_REQUEST['longitud'];
    $zona         = $_REQUEST['zona'];
    //define zona horaria local
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $hora  = date("H");
    $minuto = date("i");

    $sql = "INSERT INTO reportes VALUES(0,'$titulo','$tipo','$latitud','$longitud','$descripcion','1','$fecha','$hora','$zona','$minuto')";
    $res = mysqli_query($conn,$sql);

    $sql = "SELECT id_reporte FROM reportes
    WHERE titulo = '$titulo' AND tipo = '$tipo' AND latitud = '$latitud' AND longitud = '$longitud'
    AND descripcion = '$descripcion' AND estatus = 1 AND fecha = '$fecha' AND hora = '$hora' AND zona = '$zona' ";
    $res2 = mysqli_query($conn, $sql);
    $array = mysqli_fetch_row($res2);

    $sql = "INSERT INTO reportes_realizados VALUES('$id', $array[0])";
    $res2 = mysqli_query($conn, $sql);

    if(!$res || !$res2){
        echo "No se ha podido insertar " . mysqli_errno($conn); 
        return;
    }

    header("Location: ../index.php");
?>
