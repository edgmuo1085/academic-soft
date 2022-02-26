<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$grado = Grado::getListaEnObjetos('id=1', null)[0];

$lista .= '<tr>';
$lista .= "<td>{$grado->getNombreGrado()}</td>";
$lista .= '<td>';
$lista .= "<a href='principal.php?CONTENIDO=layout/components/form-update-grado.php&accion=Modificar&id={$grado->getId()}'>M</a>";
$lista .= "<label onClick='eliminar({$grado->getId()})'>X</label>";
$lista .= '</td>';
$lista .= '</tr>';
?>

<h3>LISTA DE GRADOS</h3>
<table>
    <tr>
        <th>Nombre Del Grado</th>
        <th><a href="principal.php?CONTENIDO=layout/components/form-update-grado.php">+</a></th>
    </tr>
</table>

<script type="text/javascript">
    function eliminar(id) {
        var respuesta = confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/form-update-grado-action.php&accion=Eliminar&id=" + id;
    }
</script>