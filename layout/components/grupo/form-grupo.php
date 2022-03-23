<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameGrupo = '';
$idGrupo = null;
$idGrado = '';
$selected = '';
$selectMenu = '';

if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Grupo('id', $_REQUEST['id']);
    $nameGrupo = $array->getNombreGrupo();
    $idGrado = $array->getIdGrado();
    $idGrupo = $array->getId();
}

$totalGrados = Grado::getListaEnObjetos(null, null);

foreach ($totalGrados as $param) {
    $selected = $param->getId() == $idGrado ? 'selected' : '';
    $selectMenu .= '<option value="' . $param->getId() . '" ' . $selected . ' >' . $param->getNombreGrado() . '</option>';
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
            
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="fin">Grado</label>
                    <select class="as-form-select" name="id_grado" id="id_grado" required>
                        <?php
                        echo $selectMenu;
                        ?>
                    </select>
                </div>
            </div>

            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="nombre_grupo">Nombre</label>
                    <input type="text" name="nombre_grupo" id="nombre_grupo" value="<?php echo $nameGrupo; ?>" required placeholder="Nombre del grupo">
                </div>
            </div>

            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $idGrupo; ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
    </form>
</div>