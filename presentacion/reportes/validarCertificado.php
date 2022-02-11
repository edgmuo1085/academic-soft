<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../logica/clasesGenericas/ConectorBD.php';
require_once '../../logica/clasesGenericas/Fecha.php';
require_once '../../logica/clases/Persona.php'; 
require_once '../../logica/clases/TipoPersona.php';
require_once '../../logica/clases/Evento.php';
require_once '../../logica/clases/Candidato.php';
require_once '../../logica/clases/Votante.php';


$idVotante= Evento::consultarCodigoBarras($_REQUEST['codigoB']);

if($idVotante!=0){
    $votante=new Votante('id', $idVotante);
    $evento=new Evento('id', $votante->getIdEvento());
    $persona=new Persona('identificacion', $votante->getIdentificacion());
}else {
    $mensaje='No se encontro un certificado válido';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Validación certificado de votación</title>
    </head>
    <body>
        <h3>VERIFICACION CERTIFICACION </h3>
        <?php
        
        
        if($idVotante==0) 
            echo $mensaje;
        else{
            echo "El número de documento '{$persona->getIdentificacion()}' ingresado, "
            . "correspondiente a '{$persona->getNombres()}' '{$persona->getApellidos()}' es válido para el evento "
            . "'{$evento->getNombre()}' ";
        }
        ?>
    </body>
</html>
