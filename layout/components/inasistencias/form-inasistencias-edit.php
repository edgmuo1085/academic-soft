<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Modificar';
$selected1 = '';
$selectMenuAsignatura = '';
if (isset($_REQUEST['id'])) {
    $arrayInasistencia = new Inasistencias('id', $_REQUEST['id']);
    $arrayUsuario = new Usuario('id', $arrayInasistencia->getIdUsuarioEstudiante());
}

$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');

foreach ($arrayAsignatura as $paramA) {
    $selected1 = $paramA->getId() == $arrayInasistencia->getIdAsignatura() ? 'selected' : '';
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '"' . $selected1 . '>' . $paramA->getNombreAsignatura() . '</option>';
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
                        <select class="as-form-select" name="id_asignatura" id="id_asignatura">
                            <option>Asignaturas...</option>
                            <?php
                            echo $selectMenuAsignatura;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" value="<?= $arrayInasistencia->getCantidad() ?>" required placeholder="Número de inasistencias">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="justificacion">Justificación</label>
                    <textarea class="as-form-textarea" name="justificacion" id="justificacion" cols="30" rows="10" required placeholder="Describa la justificación..."><?= $arrayInasistencia->getJustificacion() ?></textarea>
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $arrayInasistencia->getId() ?>">
        <input type="hidden" name="id_usuario_estudiante" value="<?= $arrayInasistencia->getIdUsuarioEstudiante() ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>