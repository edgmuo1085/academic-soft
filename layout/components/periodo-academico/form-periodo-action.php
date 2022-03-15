<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$periodo = new PeriodoAcademico(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $periodo->setInicioPeriodo(Fecha::convertDate($_REQUEST['inicio'], true));
        $periodo->setFinalizacionPeriodo(Fecha::convertDate($_REQUEST['fin'], true));
        $periodo->setIdAnioEscolar($_REQUEST['id_anio_escolar']);
        $periodo->guardar();
        break;
    case 'Modificar':
        $periodo->setInicioPeriodo(Fecha::convertDate($_REQUEST['inicio'], true));
        $periodo->setFinalizacionPeriodo(Fecha::convertDate($_REQUEST['fin'], true));
        $periodo->setIdAnioEscolar($_REQUEST['id_anio_escolar']);
        $periodo->modificar($_REQUEST['id']);
        break;
    case 'Eliminar':
        $periodo->setId($_REQUEST['id']);
        $periodo->eliminar();
        break;
}
?>
<script>
    window.location = 'principal.php?CONTENIDO=layout/components/periodo-academico/lista-periodo.php';
</script>