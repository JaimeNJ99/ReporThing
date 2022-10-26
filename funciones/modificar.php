<?php
    session_start();

    require "conexion.php";
    $conn = conexion();

    $id         = $_SESSION['idu'];
    $nombre     = $_REQUEST['user'];
    $pass       = $_REQUEST['password'];
    $avatar     = $_FILES['avatar']['name'];        
    $avatar_enc = $_FILES['avatar']['tmp_name'];
    $fileName1 = '';

    $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
    $res = pg_query($conn,$sql);
    $array = pg_fetch_array($res);

    $pass = md5($pass);

    if($pass == ''){
        $pass = $array['contraseña'];

    }

    if($nombre == ''){
        $nombre = $array['username'];
    }

    



    if($avatar != ''){
        $cadena     = explode(".", $avatar);
        $ext        = end($cadena);
        $dir        = "../imagenes/avatar/";
        $enc        = md5_file($avatar_enc);
		$fileName1 = "$enc.$ext";
        copy($avatar_enc ,$dir.$fileName1);    
	}else{
        $avatar = $array['avatar'];
    }

    $sql = "UPDATE usuarios SET 
    username = '$nombre', contrasena = '$pass', avatar = '$avatar' 
    WHERE id_usuarios = $id";
    $res = pg_query($conn, $sql);

    header("Location: ../modificar_perfil.php");

?>