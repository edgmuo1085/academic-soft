<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$periodo = new PeriodoAcademico(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $periodo->setInicioPeriodo($_REQUEST['inicio']);
        $periodo->setFinalizacionPeriodo($_REQUEST['fin']);
        $periodo->guardar();
        break;
    case 'Modificar':
        $periodo->setId($_REQUEST['id']);
        $periodo->setInicioPeriodo($_REQUEST['inicio']);
        $periodo->setFinalizacionPeriodo($_REQUEST['fin']);
        $periodo->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $periodo->setId($_REQUEST['id']);
        $periodo->eliminar();
        break;
}
?>
<script>
    window.location = 'principal.php?CONTENIDO=layout/components/lista-periodo.php';
</script>