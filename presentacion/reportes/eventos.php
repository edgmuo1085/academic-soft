<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$lista='';
$resultado= Evento::getListaEnObjetos(null, "inicio");
for ($i = 0; $i < count($resultado);$i++){
    $evento=$resultado[$i];
    
    $lista.='<tr>';
    $lista.="<td>{$evento->getNombre()}</td>";
    $lista.="<td>{$evento->getInicio()}</td>";
    $lista.="<td>{$evento->getFin()}</td>";
    $lista.="<td>{$evento->getEstado()}</td>";
    $lista.='<td>';
    $lista.="<a href='presentacion/reportes/certificado.php?"
            . "idEvento={$evento->getId()}&identificacion={$USUARIO->getIdentificacion()}' target='_blank'><img src='presentacion/imagenes/pdf.png' title='Obtener Certificacion de  participacion'></a>";
    if ($evento->getEstado()=='Terminado') $lista.="<a href='principal.php?CONTENIDO=presentacion/indicadores/resultados.php&"
            . "idEvento={$evento->getId()}'><img src='presentacion/imagenes/resultados.png' title='Resultados del evento'></a>";
    $lista.='</td>';
    $lista.='</tr>';
}

?>

<h3>LISTA DE EVENTOS</h3>
<P></P>
<table border="1">
    <tr>
        <th>Nombre</th><th>Inicio</th><th>Fin</th><th>Estado</th>
    </tr>
    <?=$lista?>
</table>

<script type="text/javascript">
    function eliminar(id) {
        var respuesta=confirm("Esta seguro de eliminar este registro?");
        if(respuesta) location="principal.php?CONTENIDO=presentacion/configuracion/eventosActualizar.php&accion=Eliminar&id="+id;
    }
</script>