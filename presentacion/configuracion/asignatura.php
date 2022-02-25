<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista='';
$asignatura = Asignatura::getListaEnObjetos('id=1', null)[0];

    $lista.='<tr>';
    $lista.="<td>{$asignatura->getNombreAsignatura()}</td>";
    $lista.='<td>';
    $lista.="<a href='principal.php?CONTENIDO=presentacion/configuracion/asignaturaFormulario.php&accion=Modificar&id={$asignatura->getId()}'>M</a>";
    $lista.="<label onClick='eliminar({$asignatura->getId()})'>E</label>";
    $lista.='</td>';
    $lista.='</tr>';
?>

<h3>LISTA DE ASIGNATURAS</h3>
<p></p>
<table border="1">
    <tr>
        <th>Nombre_Asignatura</th><th><a href="principal.php?CONTENIDO=presentacion/configuracion/asignaturaFormulario.php">+</a></th>
    </tr> 
</table>

<script type="text/javascript">
    function eliminar(id){
        var respuesta=confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location="principal.php?CONTENIDO=presentacion/configuracion/asignaturaActualizar.php&accion=Eliminar&id"+&id;
    }
</script>
