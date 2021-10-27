<?php
    define("HOST","localhost");
    define("BD",'reporthing');
	define("USER_BD",'root');
	define("PASS_BD",'root');

    function conexion(){    //conexion a la base de datos
        if (!($conn = mysqli_connect(HOST,USER_BD,PASS_BD,BD))) {    
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{
            return $conn; //retorna la conexion
        }
    }
?>