<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
if(!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');//linea para que no se pueda acceder en otro navegador copiando la direccin de la barra
$eventos=Evento::getListaEnObjetos("now() between inicio and fin", null);

//validar
if(count($eventos)>0){
    $evento=$eventos[0];
    $votantes= Votante::getListaEnObjetos("persona.identificacion='{$USUARIO->getIdentificacion()}' and idEvento={$evento->getId()}", null);
    
    if(count($votantes)>0){
        $votante=$votantes[0];
        $idCandidato=$evento->consultarVoto($USUARIO->getIdentificacion());
        
        $candidatos= Candidato::getListaEnObjetos("idEvento={$evento->getId()}", 'nombres, apellidos');
        $lista='';
        
        for($i=0; $i<count($candidatos); $i++){
            $candidato=$candidatos[$i];
            
            if($idCandidato==$candidato->getId()) $color='red';
            else $color='';
            
            $lista.="<tr bgColor='$color'>";
            $lista.="<td><img src='presentacion/candidatos/fotos/{$candidato->getFoto()}' width='50' height='70' onClick='votar({$candidato->getId()},{$votante->getId()});'/></td>";    
            $lista.="<td>{$candidato->getIdentificacion()}</td>";
            $lista.="<td>{$candidato}</td>";
            $lista.='</tr>';
        }
        
    }
}
?>

<h3>BIENVENIDO</h3>

<?php
if(count($eventos)>0 && count($votantes)>0){
?>
<p><h3>TARJETÓN</h3></p>
<table border="1">
    <tr><th>Evento</th><td colspan="5"><?=$evento->getNombre()?></td></tr>
    <tr>
        <th>Inicio</th><td><?=$evento->getInicio()?></td>
        <th>Finalización</th><td><?=$evento->getFin()?></td>
        <th>Estado</th><td><?=$evento->getEstado()?></td>
    </tr>
</table><p>
<p>A continuación se presenta la lista de candidatos para que seleccione la foto del candidato por el cual desea votar</p>
<p>
<table border="1">
    <tr><th>Foto</th><th>Identificacion</th><th>Candidato</th></tr>
    <?=$lista?>
</table>

</p>
<script type="text/javascript">
    function votar(idCandidato, idVotante){
        if(<?=$idCandidato?> == 0) location='principal.php?CONTENIDO=presentacion/votaciones/tarjetonActualizar.php&idEvento=<?= $evento->getId() ?>&idCandidato=' + idCandidato + '&idVotante='+idVotante;
        else alert('Usted ya consignó su voto en este evento');
    }
</script>
<?php }?>