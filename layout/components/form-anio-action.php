<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$anioEscolar = new AnioEscolar(null, null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $anioEscolar->setInicio($_REQUEST['inicio']);
        $anioEscolar->setFin($_REQUEST['fin']);
        $anioEscolar->guardar();
        break;
    case 'Modificar':
        $anioEscolar->setId($_REQUEST['id']);
        $anioEscolar->setInicio($_REQUEST['inicio']);
        $anioEscolar->setFin($_REQUEST['fin']);
        $anioEscolar->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $anioEscolar->setId($_REQUEST['id']);
        $anioEscolar->eliminar();
        break;
}
?>
<script>
    window.location = 'principal.php?CONTENIDO=layout/components/lista-anio.php';
</script>