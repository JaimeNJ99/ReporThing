<?php
    require "header.php";
?>
<html>
    <head>
    <script src="JavaScript/jquery-3.6.0.min.js"></script>
        <script>
            
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
        <form>
            <h2 style="text-align: center">Registrate</h2>
            <div id="login">
                <br>
                <div class="columna"><label>Nombre: </label><input type="text" id="user" name="user" placeholder="Escribe tu nombre."></div><br> 
                <div class="columna"><label>Correo: </label><input type="text" id="correo" name="correo" placeholder="Escribe tu correo."></div><br>
                <div class="columna"><label>Contraseña: </label><input type="text" id="password" name="password" placeholder="Escribe tu contraseña."></div><br>
                <div class="columna"><label>Avatar:</label><br>
                <input type="file"  name="archivo"></div><br>
                <div class="columna"><input onClick="registrar(); return false;" type="submit" value="Registrarse"></div>
                <div class="columna">¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></div>
                <div id="mensaje" class="error"></div>
            </div>
        </form>
    </body>
    <?php require "footer.php" ?>
</html>
