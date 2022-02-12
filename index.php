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
        <title>SIDCA SISTEMA DE CONTROL ACADEMICO</title>
        
        <link rel="stylesheet" type="text/css" href="presentacion/css/master.css">
    </head>
    <body background="presentacion/imagenes/1.jpg">
    <center>
        <img class="foto1" src="presentacion/imagenes/pixlr-bg-result.png" align="left"/> 
        <div id="banner">
        <h3>COLEGIO LOS ANDES NUESTRA SEÑORA DE LAS MERCEDES</h3>
        Institución educativa con 35 años de trayectoria, basada en la educación integral
        y personalizada. Contamos con altos estándares en educación, donde hacemos énfasis a
        nuestro lema "NADA ES TAM IMPORTANTE COMO UN NIÑO".</p>
        </div>
     
        <p><font color='red'><?=$mensaje?></font></p>
       
        <form name="formulario" method="post" action="control/validar.php"> 
        <div class="login-box">
            <img class="avatar" src="presentacion/imagenes/candidato_1.png" alt="logo">
            <h3>SISTEMA DE CONTROL ACADEMICO</h3>
            <h3>LOGIN</h3>
                <label for="username">Usuario</label>
                <input type="text" name="usuario" placeholder="Enter Username">
                <!-- PASSWORD -->
                <label for="password">Clave</label>
                <input type="password" name="clave" placeholder="Enter Password">
                
        <input type="submit" value="Ingresar"/>
        </form>
        
        
        <p>
        </div>
            <img src="presentacion/imagenes/logo.png" width="600" height="400" border="0">
    </center>
    
</body>
</html>


    