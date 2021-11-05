<?php
    //creamos una nueva sesion
    session_start();

    require "conexion.php";
    $conn = conexion();

    //recibimos los datos del usuario
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    $pass = md5($pass);

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$pass' ";
    
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $array = mysqli_fetch_array($result);
    
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