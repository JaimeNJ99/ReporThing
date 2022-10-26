<?php
    function conexion(){    //conexion a la base de datos

        if(!($conn = pg_connect("host=localhost dbname=reporthing user=postgres password=root"))){
            echo "Error: No se pudo conectar a la bd" ;
        }else{
            return $conn; //retorna la conexion
        }
    }
?>