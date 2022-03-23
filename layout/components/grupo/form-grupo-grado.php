<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$arrayGrupo = '';

if (isset($_REQUEST['id'])) {
    $arrayGrupo = Grado::getListaEnObjetos("id={$_REQUEST['id']}", null)[0];
}

?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/grupo/lista-grupo.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/grupo/form-grupo-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Nombre del grupo</h2>
            <div class="as-form-input">
                <label class="show-label"><span>Grado: </span><?= $arrayGrupo->getNombreGrado(); ?></label>
            </div>

            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="nombre_grupo">Nombre</label>
                    <input type="text" name="nombre_grupo" id="nombre_grupo" required placeholder="Nombre del grupo">
                </div>
            </div>

            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id_grado" value="<?= $arrayGrupo->getId(); ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
    </form>
</div>