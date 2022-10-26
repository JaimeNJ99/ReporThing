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

    $sql = "SELECT id_reporte FROM reportes";
    $row = pg_query($conn,$sql);
    $id_rep = pg_num_rows($row);
    $id_rep = $id_rep + 1;
    echo $id_rep;
    
    $sql = "INSERT INTO reportes VALUES('$id_rep','$titulo','$tipo','$latitud','$longitud','$descripcion','1','$fecha','$hora','$zona','$minuto')";
    $res = pg_query($conn,$sql);

    $sql = "INSERT INTO reportes_realizados VALUES('$id', '$id_rep')";
    $res2 = pg_query($conn, $sql);

    if(!$res || !$res2){
        echo "No se ha podido insertar "; 
        return;
    }

    header("Location: ../index.php");
?>
