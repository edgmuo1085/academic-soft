<!DOCTYPE html>
<?php
    session_start();
    session_unset();
    session_destroy();

    $mensaje='';
    if(isset($_REQUEST['mensaje'])) $mensaje=$_REQUEST['mensaje'];
?>
<html>
    <head>
        <meta charset="windows-1252">
        <title>PROYECTO DE VOTACIONES WEB</title>
        
        <link rel="stylesheet" type="text/css" href="presentacion/css/master.css">
    </head>
    <body background="presentacion/imagenes/fondovt.jpg"><center>
        
        
        <p><font color='red'><?=$mensaje?></font></p>
        <form name="formulario" method="post" action="control/validar.php">
            <div class="login-box">
            <img class="avatar" src="presentacion/imagenes/vota2.jpg" alt="logo">
            <h2>PROYECTO DE VOTACIONES WEB</h2>
            <h3>LOGIN</h3>
                <label for="username">Usuario</label>
                <input type="text" name="usuario" placeholder="Enter Username">
                <!-- PASSWORD -->
                <label for="password">Clave</label>
                <input type="password" name="clave" placeholder="Enter Password">
                
        <input type="submit" value="Ingresar"/>
        </form>
        <p>
        <form name="formularioCertificacion" method="post" action="presentacion/reportes/validarCertificado.php">
            Validar Certificacion <input type="text" name="idVoto" required> <input type="submit" name="Validar">
        </form>
        </p>
        </div>
    </center></body>
</html>


    