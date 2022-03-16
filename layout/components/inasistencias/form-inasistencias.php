<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$array = new Inasistencias(null, null);
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Inasistencias('id', $_REQUEST['id']);
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Inasistencias</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" value="<?= $array->getCantidad() ?>" required placeholder="Cantidad">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="justificacion">Justificación</label>
                    <input type="text" name="Justificacion" id="justificacion" value="<?= $array->getJustificacion() ?>" required placeholder="Justificacion">
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $array->getId() ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>