<?php
    //creamos una nueva sesion
    session_start();

    require "conexion.php";
    require "conexionReplica.php";
    $conn = conexion();
    $bandera=0;
    if(!$conn){
      $bandera=1;
      $conn=conexionR();
    }

    //recibimos los datos del usuario
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    $pass = md5($pass);

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$pass' ";
    
    $result = pg_query($conn, $sql);
    $rows = pg_num_rows($result);
    $array = pg_fetch_array($result);
    
    if($rows == 1){
        //asignamos los datos del usuario
        //a las variables de sesion
        $idu       = $array["id_usuarios"];
		$nombre    = $array["username"];
		$correo    = $array["correo"];
        $admin     = $array["administrador"];
        $avatar    = $array["avatar"];
        
        //variables de sesion iniciada 
		$_SESSION['idu'] = $idu;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['correo'] = $correo;
        $_SESSION['admin'] = $admin;
        $_SESSION['avatar'] = $avatar;
    }
    echo $rows;
?>