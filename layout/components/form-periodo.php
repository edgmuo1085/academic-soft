<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$iniciaPeriodo = '';
$finPeriodo = '';
$idPeriodo = null;
$idPeriodoAca = '';
$selected = '';
$selectMenu = '';

if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new PeriodoAcademico('id', $_REQUEST['id']);
    $periodo = PeriodoAcademico::getListaEnObjetos("id={$array->getId()}", null)[0];
    $iniciaPeriodo = Fecha::convertDate($array->getInicioPeriodo(), false);
    $finPeriodo = Fecha::convertDate($array->getFinalizacionPeriodo(), false);
    $idPeriodoAca = $array->getIdAnioEscolar();
    $idPeriodo = $array->getId();
}

$totalAnioEscolar = AnioEscolar::getListaEnObjetos(null, null);

foreach ($totalAnioEscolar as $param) {
    $selected = $param->getId() == $idPeriodoAca ? 'selected' : '';
    $selectMenu .= '<option value="' . $param->getId() . '" ' . $selected . ' > Inicia: [' . Fecha::convertDate($param->getInicio(), false).'] - Finaliza: ['. Fecha::convertDate($param->getFin(), false)  . ']</option>';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-periodo.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-periodo-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Periodo Académico</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="inicio">Inicio del periodo</label>
                    <input type="text" name="inicio" id="inicio" value="<?php echo $iniciaPeriodo; ?>" required placeholder="Inicio del periodo">
                </div>
            </div>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="fin">Finalización del periodo</label>
                    <input type="text" name="fin" id="fin" value="<?php echo $finPeriodo; ?>" required placeholder="Finalización del periodo">
                </div>
            </div>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="fin">Periodo Académico</label>
                    <select class="as-form-select" name="id_anio_escolar" id="id_anio_escolar">
                        <?php
                        echo $selectMenu;
                        ?>
                    </select>
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $idPeriodo; ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
    </form>
</div>


<script>
    $(function() {
        $("#inicio").datepicker({
            dateFormat: "dd-mm-yy"
        });
        $("#fin").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>