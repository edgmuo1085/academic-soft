<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');

$docente = new Usuario(null, null);
switch ($_REQUEST['accion']) {
  case 'Adicionar':
    $docente->setIdentificacion($_REQUEST['identificacion']);
    $docente->setNombres($_REQUEST['nombres']);
    $docente->setApellidos($_REQUEST['apellidos']);
    $docente->setTelefono($_REQUEST['telefono']);
    $docente->setEmail($_REQUEST['email']);
    $docente->setDireccion($_REQUEST['direccion']);
    $docente->setEstado($_REQUEST['estado']);
    $docente->setRolId(2);
    $docente->guardar();
    break;
  case 'Modificar':
    $docente->setIdentificacion($_REQUEST['identificacion']);
    $docente->setNombres($_REQUEST['nombres']);
    $docente->setApellidos($_REQUEST['apellidos']);
    $docente->setTelefono($_REQUEST['telefono']);
    $docente->setEmail($_REQUEST['email']);
    $docente->setClave($_REQUEST['pass']);
    $docente->setDireccion($_REQUEST['direccion']);
    $docente->setEstado($_REQUEST['estado']);
    $docente->setRolId(2);
    $docente->modificar($_REQUEST['id']);
    break;
  case 'Eliminar':
    $docente->setId($_REQUEST['id']);
    $docente->eliminar();
    break;
}

?>
<script>
  window.location = 'principal.php?CONTENIDO=layout/components/docente/lista-docente.php';
</script>