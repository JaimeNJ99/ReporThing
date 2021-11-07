<?php
    require "header.php";
?>
<html>
    <head>
        <title>
            Modificar perfil
        </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            function registrar(){
                //tomamos las variables del formulario
                var user = registro.user.value;
                var pass = registro.password.value;
                var avatar = registro.avatar.value;

                if(user == '' && pass == '' && avatar == ''){ //si faltan campos
                    $('#mensaje').html('No has realizado cambios.');
                    setTimeout("$('#mensaje').html('')", 5000);
                    return false;
                }else{

                    document.registro.method = 'post';
                    document.registro.action = 'funciones/modificar.php'
                    document.registro.submit();
                    /**/
                }

            }
        </script>
        <style>
            #base{
                width: 350px;
                height:auto;
                margin: auto;
                border: 1px solid #010;
            }
            .columna{
                margin-right: auto;
                margin-left: auto;
                text-align: center;
            }
            .error{
                color: FF0000;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                padding: 1px;
            }
        </style>
    </head>
    <body>
        <form  name="registro" action="funciones/registro.php" method="post" enctype="multipart/form-data">
            <br>
            <h2 style="text-align: center">Modificar Perfil</h2>
            <br>
            <div id="base">
                <br>
                <div class="columna"><label>Nombre: </label><input type="text" id="user" name="user" placeholder="Escribe tu nuevo nombre."></div><br> 
                <div class="columna"><label>Contraseña: </label><input type="text" id="password" name="password" placeholder="Escribe tu nueva contraseña."></div><br>
                <div class="columna"><label>Avatar nuevo:</label><br>
                <input type="file"  name="avatar"></div><br>
                <div class="columna"><input onClick="registrar(); return false;" type="submit" value="Aplicar cambios"></div>
                <br>
                <div id="mensaje" class="error"></div>
            </div>
        </form>
        <br><br><br>
        </body>
    <?php require "footer.php" ?>
</html>
