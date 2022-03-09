<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$inicio = '';
$fin = '';
$idAnioEscolar = null;
$idInstitucion = '';
$selected = '';
$selectMenu = '';

if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new AnioEscolar('id', $_REQUEST['id']);
    $grado = AnioEscolar::getListaEnObjetos("id={$array->getId()}", null, null)[0];
    $inicio = Fecha::convertDate($array->getInicio(), false);
    $fin = Fecha::convertDate($array->getFin(), false);
    $idInstitucion = $array->getIdInstitucion();
    $idAnioEscolar = $array->getId();
}

$totalInstituciones = InstitucionEducativa::getListaEnObjetos(null, null);

foreach ($totalInstituciones as $param) {
    $selected = $param->getId() == $idInstitucion ? 'selected' : '';
    $selectMenu .= '<option value="' . $param->getId() . '" ' . $selected . ' >' . $param->getNombre() . '</option>';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-anio.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-anio-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Año escolar</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="inicio">Inicio</label>
                    <input type="text" name="inicio" id="inicio" value="<?php echo $inicio; ?>" required placeholder="Fecha inicial">
                </div>
            </div>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="fin">Fin</label>
                    <input type="text" name="fin" id="fin" value="<?php echo $fin; ?>" required placeholder="Fecha final">
                </div>
            </div>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="fin">Institución</label>
                    <select class="as-form-select" name="id_institucion" id="id_institucion">
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
        <input type="hidden" name="id" value="<?php echo $idAnioEscolar; ?>">
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