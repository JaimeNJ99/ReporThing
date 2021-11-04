<?php

    require "conexion.php";
    $conn = conexion();

    //recibimos las variables
    $titulo       = $_REQUEST['titulo'];
    $tipo         = $_REQUEST['tipo'];
    $descripcion  = $_REQUEST['descripcion'];
    $longitud     = $_REQUEST['longitud'];
    $latitud      = $_REQUEST['latitud'];

    $coma=',';
    $ubicacion  =$longitud.$coma.$latitud;


    $sql = "INSERT INTO reportes VALUES(0,'$titulo','$tipo','$descripcion','$ubicacion','1')";
    $res = mysqli_query($conn,$sql);

    if(!$res){
        echo "No se ha podido insertar " . mysqli_errno($conn);
        return;
    }

    header("Location: ../index.php");
?>
