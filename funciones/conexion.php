<?php
    function conexion(){    //conexion a la base de datos
        #error_reporting(E_ERROR);

        if($conn = pg_connect("host=localhost dbname=reporthing user=postgres password=root")){
            return $conn; //retorna la conexion
        }else{
            error_reporting(E_ERROR);
        }
        
    }
?>