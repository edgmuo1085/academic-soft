<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
 require_once '../../logica/clases/Usuario.php';
 require_once '../../logica/clasesGenericas/ConectorBD.php';
 require_once '../../logica/clases/TipoUsuario.php';
 require_once '../../logica/clases/Evento.php';
 require_once '../../logica/clasesGenericas/Fecha.php';
 require_once '../../logica/clases/Candidato.php';
 require_once '../../logica/clases/Votante.php';
 
 $evento=new Evento('id', $_REQUEST['idEvento']);
 $votante=new Usuario('identificacion', $_REQUEST['identificacion']);
 $estadoVotacion=$evento->consultarVoto($votante->getIdentificacion());//0 si no voto
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../../librerias/JsBarcode.all.min.js"></script>
    </head>
    <body>
        <h3>CERTIFICADO DE ASISTENCIA A VOTACION</h3>
        <?php
        if ($estadoVotacion==0) echo 'No es posible generar el certificado porque la persona ingresada no ha participado de la votacion del evento seleccionado';
        else {
        ?>
        <table border="0">
            <tr><th>Evento</th><td colspan="5"><?=$evento->getNombre()?></td></tr>
            <tr>
                <th>Inicio</th><td><?=$evento->getInicio()?></td>
                <th>Finalizacion</th><td><?=$evento->getFin()?></td>
                <th>Estado</th><td><?=$evento->getEstado()?></td>
            </tr>
        </table><p>
        
        DATOS DEL VOTANTE
        <table border="0">
            <tr><th>Evento</th><td colspan="5"><?=$evento->getNombre()?></td></tr>
            <tr><th>Identificacion</th><td><?=$votante->getIdentificacion()?></td></tr>
            <tr><th>Nombres</th><td><?=$votante->getNombres()?></td></tr>
            <tr><th>Apellidos</th><td><?=$votante->getApellidos()?></td></tr>
        </table><p>
        como certificacion se expide a las <?= date('d') ?> dias del mes <?= date('m') ?> de <?= date('Y') ?><p>
            <img id="codigoBarras"/>
            <script>JsBarcode("#codigoBarras", <?= $estadoVotacion ?>);</script> 
        <?php
        }
        ?>
    </body>
</html>
