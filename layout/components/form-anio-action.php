<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');

$anio = new AnioEscolar(null, null);
switch ($_REQUEST['accion']) {
  case 'Adicionar':
    $anio->setInicioAnio($_REQUEST['inicio']);
    $anio->setFinAnio($_REQUEST['fin']);
    $anio->guardar();
    break;
  case 'Modificar':
    $anio->setId($_REQUEST['id']);
    $anio->setInicioAnio($_REQUEST['inicio']);
    $anio->setFinAnio($_REQUEST['fin']);
    $anio->modificar($_REQUEST['id']);
    break;
  case 'Eliminar':
    $anio->setId($_REQUEST['id']);
    $anio->eliminar();
    break;
}

?>
<script>
  window.location = 'principal.php?CONTENIDO=layout/components/lista-anio.php';
</script>