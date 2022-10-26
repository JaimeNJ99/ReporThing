<?php

    require "conexion.php";
    $conn = conexion();   

    //recibimos las variables
    $correo     = $_REQUEST['correo'];
    $user       = $_REQUEST['user'];
    $pass       = $_REQUEST['password'];
    $avatar     = $_FILES['avatar']['name'];        //nombre del archivo
    $avatar_enc = $_FILES['avatar']['tmp_name'];    //ubicacion temporal del archivo
    $admin = 0;
    $fileName1 = '';
    //cifrar la contraseña
    $pass = md5($pass); 
    
    //si se subio un archivo
    if($avatar != ''){
        $cadena     = explode(".", $avatar);
	    $ext        = end($cadena);
	    $dir        = "../imagenes/avatar/";
        $enc        = md5_file($avatar_enc);
		$fileName1  = "$enc.$ext";

        //copiamos la imagen en la carpeta
        copy($avatar_enc ,$dir.$fileName1);
	}
    
    $sql = "SELECT id_usuarios FROM usuarios";
    $row = pg_query($conn,$sql);
    $id = pg_num_rows($row);
    $id_usr = $id + 1;
    $sql = "INSERT INTO usuarios VALUES('$id_usr','$user','$correo','$pass','$admin','$fileName1')";
    $res = pg_query($conn,$sql);

    if(!$res){
        echo "No se ha podido insertar ";
        return;
    }
    header("Location: ../login.php");
?>