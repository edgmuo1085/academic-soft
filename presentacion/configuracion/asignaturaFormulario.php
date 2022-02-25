<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo='Adicionar';
if (isset($_REQUEST['id'])){
    $titulo='Modificar';
    $array = new Asignatura('id', $_REQUEST['id']);
    $asignatura = Asignatura::getListaEnObjetos("id={$array->getId()}", null)[0];
} 
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/inicio.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?= strtoupper($titulo)?> ASIGNATURA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/configuracion/asignaturaActualizar.php">
<table>
    <tr><th>Nombre Asignatura</th><td><input type="text" name="nombre_asignatura" size="30" maxlength="30" value="<?= $array->getNombreAsignatura() ?>" required></td></tr>
</table> 
<input type="submit" name="accion" value="<?=$titulo?>">
<input type="hidden" name="id" value="<?=$array->getId()?>">
</form>    


