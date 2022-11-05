<?php
    function conexionR(){    //conexion a la base de datos

        if(!($conn = pg_connect("host=192.168.194.2 dbname=reporthing user=postgres password=root"))){
            echo "Error: No se pudo conectar a la bd Replica" ;
        }else{
            return $conn; //retorna la conexion
        }
    }
?>