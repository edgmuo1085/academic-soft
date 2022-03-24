<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$selectMenuAsignatura = '';
$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');

if (isset($_REQUEST['id'])) {
    $arrayUsuario = new Usuario('id', $_REQUEST['id']);
}

foreach ($arrayAsignatura as $paramA) {
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '">' . $paramA->getNombreAsignatura() . '</option>';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante-grupo.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Registrar inasistencia</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="show-label"><span>Identificación: </span><?= $arrayUsuario->getIdentificacion() ?></label>
                </div>

                <div class="as-form-input">
                    <label class="show-label"><span>Nombres: </span><?= $arrayUsuario->__toString() ?></label>
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="label" for="id_asignatura">Asignaturas</label>
                        <select class="as-form-select" name="id_asignatura" id="id_asignatura" required>
                            <?php
                            echo $selectMenuAsignatura;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" required placeholder="Número de inasistencias">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="justificacion">Justificación</label>
                    <textarea class="as-form-textarea" name="justificacion" id="justificacion" cols="30" rows="10" required placeholder="Describa la justificación..."></textarea>
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $arrayUsuario->getId() ?>">
        <input type="hidden" name="id_usuario_estudiante" value="<?= $_REQUEST['id'] ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>