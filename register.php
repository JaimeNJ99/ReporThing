<?php
    require "header.php";
?>
<html>
    <head>
        <title>
            Registrate
        </title>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            function registrar(){
                //tomamos las variables del formulario
                var correo = registro.correo.value;
                var user = registro.user.value;
                var pass = registro.password.value;
                var avatar = registro.avatar.value;

                if(correo == '' || user == '' || pass == ''){ //si faltan campos
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('')", 5000);
                    return false;
                }else{

                    document.registro.method = 'post';
                    document.registro.action = 'funciones/registro.php'
                    document.registro.submit();
                    /**/
                }

            }

            function verificaCorreo(){
                var correo = $('#correo').val();
                if(correo != ''){
                    $.ajax({
					    url       : 'funciones/verificaCorreo.php', 
						type      : 'post',
						dataType  : 'text',
                        data      : 'correo='+correo,
						success   : function(res){ //manda la consulta y recibe verdadero o falso
						    if(res != 0){ //si se encontraron registros con datos iguales
						    	$('#mensaje').html('El correo ya esta registrado');
						    	setTimeout("$('#mensaje').html('')", 5000);
						    }
						},error: function(){
						    alert('Error al conectar al servidor...');
						}
					});
                }
            }
        </script>
        <style>
            #login{
                width: 350px;
                height:260px;
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
            <br><br>
            <h2 style="text-align: center">Registrate</h2>
            <br>
            <div id="login">
                <br>
                <div class="columna"><label>Nombre: </label><input type="text" id="user" name="user" placeholder="Escribe tu nombre."></div><br> 
                <div class="columna"><label>Correo: </label><input type="text" id="correo" name="correo" placeholder="Escribe tu correo." onblur="verificaCorreo();"></div><br>
                <div class="columna"><label>Contraseña: </label><input type="text" id="password" name="password" placeholder="Escribe tu contraseña."></div><br>
                <div class="columna"><label>Avatar:</label><br>
                <input type="file"  name="avatar"></div><br>
                <div class="columna"><input onClick="registrar(); return false;" type="submit" value="Registrarse"></div>
                <div class="columna">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></div>
                <div id="mensaje" class="error"></div>
            </div>
        </form>
    </body>
    <?php require "footer.php" ?>
</html>
