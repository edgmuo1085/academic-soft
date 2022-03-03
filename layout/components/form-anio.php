<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$inicio = '';
$fin = '';
$idAnioEscolar = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new AnioEscolar('id', $_REQUEST['id']);
    $grado = AnioEscolar::getListaEnObjetos("id={$array->getId()}", null, null)[0];
    $inicio = $array->getInicio();
    $fin = $array->getFin();
    $idAnioEscolar = $array->getId();
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