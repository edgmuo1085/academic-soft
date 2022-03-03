<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$grado = new Grado(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $grado->setNombreGrado($_REQUEST['nombre_grado']);
        $grado->guardar();
        break;
    case 'Modificar':
        $grado->setId($_REQUEST['id']);
        $grado->setNombreGrado($_REQUEST['nombre_grado']);
        $grado->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $grado->setId($_REQUEST['id']);
        $grado->eliminar();
        break;
}
?>
<script>
    window.location = 'principal.php?CONTENIDO=layout/components/lista-grado.php';
</script>