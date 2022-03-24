<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$arrayGrado = '';
$arrayGrupo = array();
$nombresGrupo = '';

if (isset($_REQUEST['id'])) {
    $arrayGrado = Grado::getListaEnObjetos("id={$_REQUEST['id']}", null)[0];
    $arrayGrupo = Grupo::getListaEnObjetos("id_grado={$_REQUEST['id']}", null);

    foreach ($arrayGrupo as $item) {
        $nombresGrupo .= " [ ". $item->getNombreGrupo()." ] ";
    }
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
                <label class="show-label"><span>Grado: </span><?= $arrayGrado->getNombreGrado(); ?></label>
            </div>

            <div class="as-form-input">
                <label class="show-label"><span>Grupos actuales: </span><?= $nombresGrupo; ?></label>
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
        <input type="hidden" name="id_grado" value="<?= $arrayGrado->getId(); ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
    </form>
</div>