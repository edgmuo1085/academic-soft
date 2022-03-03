<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$namePeriodo = '';
$idPeriodo = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new PeriodoAcademico('id', $_REQUEST['id']);
    $periodo = PeriodoAcademico::getListaEnObjetos("id={$array->getId()}", null)[0];
    $namePeriodo = $array->getInicioPeriodo();
    $namePeriodo = $array->getFinalizacionPeriodo();
    $idPeriodo = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-periodo.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?= strtoupper($titulo) ?> PERIODOS ACADEMICOS</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-periodo-action.php" autocomplete="off">
    <table>
        <tr>
            <th>Inicio Periodo</th>
            <td><input type="datetime-local" name="periodo_academico" id="inicio" value="<?php echo $namePeriodo; ?>" required></td>
            <th>Finalizacion Periodo</th>
            <td><input type="datetime-local" name="periodo_academico" id="finalizacion" value="<?php echo $namePeriodo; ?>" required></td>
        </tr>
    </table>
    <p>
        <input type="submit" name="accion" value="<?= $titulo ?>">
        <input type="hidden" name="id" value="<?php echo $idPeriodo; ?>">
</form>