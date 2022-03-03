<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameGrado = '';
$idGrado = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Grado('id', $_REQUEST['id']);
    $grado = Grado::getListaEnObjetos("id={$array->getId()}", null)[0];
    $nameGrado = $array->getNombreGrado();
    $idGrado = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-grado.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-grado-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Nombre del grado</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="nombre_grado">Nombre</label>
                    <input type="text" name="nombre_grado" id="nombre_grado" value="<?php echo $nameGrado; ?>" required placeholder="Nombre del grado">
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $idGrado; ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
    </form>
</div>