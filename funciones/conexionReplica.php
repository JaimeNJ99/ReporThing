<?php
    function conexionR(){    //conexion a la base de datos

        if(!($conn = pg_connect("host=169.254.253.107 dbname=reporthing user=postgres password=root"))){
            echo "Error: No se pudo conectar a la bd Replica" ;
        }else{
            return $conn; //retorna la conexion
        }
    }
?>