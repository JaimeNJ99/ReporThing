<?php
    require "header.php";
    require "funciones/conexionReplica.php";
    $bandera=0;
    if(!isset($conn)){
      $bandera=1;
    }
?>
<html>
    <head>
        <title>
            Inicia Sesión
        </title>
        <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            function validar(){ //valida si el usuario y contraseña son correctos
                var correo = $('#correo').val();  //tomamos los valores actuales de los input
                var pass = $('#password').val();

                if(correo == '' || pass == ''){ //si faltan campos mandamos error
                    $('mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('')", 5000);
                    return false;
                }else{
                    $.ajax({
						url       : 'funciones/verifica_usuario.php?correo='+correo+'&pass='+pass, 
						type      : 'post',
						dataType  : 'text',
						success   : function(res){ //manda la consulta y recibe verdadero o falso
							if(res == 0){ //si falso
								$('#mensaje').html('El usuario o la contrasena no son validos');
								setTimeout("$('#mensaje').html('')", 5000);
							}
							else{ //si verdadero
								window.location.href = 'index.php';
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
                height:160px;
                margin: auto;
                border: 1px solid #010;
               
                
            }
            .columna{
                margin-right: auto;
                margin-left: auto;
                text-align: center;
            }
            .error{
                color: #FF0000;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                padding: 1px;
            }
        </style>
    </head>
    <body>
        <form>
            <br><br>
            <h2 style="text-align: center">Iniciar sesión</h2>
            <br>
            <div id="login">
                <br> 
                <div class="columna">
                    <label>Correo: </label><input type="text" id="correo" name="correo" placeholder="Escribe tu correo." onkeypress="return event.keyCode != 13;">
                </div><br>
                <div class="columna">
                    <label>Contraseña: </label><input type="password" id="password" name="password" placeholder="Escribe tu contraseña." onkeypress="return event.keyCode != 13;">
                </div><br>
                <div class="columna">
                    <input onClick="validar(); return false;" type="submit" value="Ingresar">
                </div>
                <?php if($bandera == 0){ ?>
                <div class="columna">¿No tienes una cuenta? <a href="register.php">Registrate</a></div>
                <?php } ?>
                <div id="mensaje" class="error"></div>
            </div>
            <br><br><br><br>
        </form>
    </body>
    <br><br><br>
    <?php require "footer.php" ?>
</html>
