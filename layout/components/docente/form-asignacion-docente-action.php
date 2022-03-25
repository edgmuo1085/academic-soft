<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');

$asignacionDocente = new AsignacionDocente(null, null);
switch ($_REQUEST['accion']) {
  case 'Adicionar':
    $asignacionDocente->setIdUsuarioDocente($_REQUEST['id_usuario_docente']);
    $asignacionDocente->setIdAnioEscolar($_REQUEST['id_anio_escolar']);
    $asignacionDocente->setIdAsignatura($_REQUEST['id_asignatura']);
    $asignacionDocente->setIdGrupo($_REQUEST['id_grupo']);
    $asignacionDocente->setLinkClaseVirtual($_REQUEST['link_clase_virtual']);
    $asignacionDocente->setIntensidadHoraria($_REQUEST['intensidad_horaria']);
    $asignacionDocente->guardar();
    break;
  case 'Modificar':
    $asignacionDocente->setIdUsuarioDocente($_REQUEST['id_usuario_docente']);
    $asignacionDocente->setIdAnioEscolar($_REQUEST['id_anio_escolar']);
    $asignacionDocente->setIdAsignatura($_REQUEST['id_asignatura']);
    $asignacionDocente->setIdGrupo($_REQUEST['id_grupo']);
    $asignacionDocente->setLinkClaseVirtual($_REQUEST['link_clase_virtual']);
    $asignacionDocente->setIntensidadHoraria($_REQUEST['intensidad_horaria']);
    $asignacionDocente->modificar($_REQUEST['id']);
    break;
  case 'Eliminar':
    $asignacionDocente->setId($_REQUEST['id']);
    $asignacionDocente->eliminar();
    break;
}

?>
<script>
  window.location = 'principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php';
</script>