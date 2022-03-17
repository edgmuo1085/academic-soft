<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');

$inasistencias = new Inasistencias(null, null);
switch ($_REQUEST['accion']) {
  case 'Adicionar':
    $inasistencias->setIdUsuarioEstudiante($_REQUEST['id_usuario_estudiante']);
    $inasistencias->setIdAsignatura($_REQUEST['id_asignatura']);
    $inasistencias->setCantidad($_REQUEST['cantidad']);
    $inasistencias->setJustificacion($_REQUEST['justificacion']);
    $inasistencias->guardar();
    break;
  case 'Modificar':
    $inasistencias->setIdUsuarioEstudiante($_REQUEST['id_usuario_estudiante']);
    $inasistencias->setIdAsignatura($_REQUEST['id_asignatura']);
    $inasistencias->setCantidad($_REQUEST['cantidad']);
    $inasistencias->setJustificacion($_REQUEST['justificacion']);
    $inasistencias->modificar($_REQUEST['id']);
    break;
  case 'Eliminar':
    $inasistencias->setId($_REQUEST['id']);
    $inasistencias->eliminar();
    break;
}

?>
<script>
  window.location = 'principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php';
</script>