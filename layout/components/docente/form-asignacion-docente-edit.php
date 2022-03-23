<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Modificar';
$selected1 = '';
$selected2 = '';
$selectMenuAsignatura = '';
$selectMenuGrado = '';
if (isset($_REQUEST['id'])) {
    $arrayAsignacionDocente = new AsignacionDocente('id', $_REQUEST['id']);
    $arrayUsuario = new Usuario('id', $arrayAsignacionDocente->getIdUsuarioDocente());
}

$arrayAnioEscolar = AnioEscolar::getListaEnObjetos('estado=1', null)[0];
$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');
$arrayGrado = Grado::getListaEnObjetos(null, 'nombre_grado');

foreach ($arrayAsignatura as $paramA) {
    $selected1 = $paramA->getId() == $arrayAsignacionDocente->getIdAsignatura() ? 'selected' : '';
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '"' . $selected1 . '>' . $paramA->getNombreAsignatura() . '</option>';
}
foreach ($arrayGrado as $paramG) {
    $selected2 = $paramG->getId() == $arrayAsignacionDocente->getIdGrado() ? 'selected' : '';
    $selectMenuGrado .= '<option value="' . $paramG->getId() . '"' . $selected2 . '>' . $paramG->getNombreGrado() . '</option>';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/docente/lista-asignacion-docente.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Asignación Docente</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="show-label"><span>Identificación: </span><?= $arrayUsuario->getIdentificacion() ?></label>
                </div>

                <div class="as-form-input">
                    <label class="show-label"><span>Nombres: </span><?= $arrayUsuario->__toString() ?></label>
                </div>

                <div class="as-form-input">
                    <label class="show-label"><span>Año Escolar: </span><?= $arrayAnioEscolar->__toString() ?></label>
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="link_clase_virtual">Enlace Clases Virtuales</label>
                    <input type="text" name="link_clase_virtual" id="link_clase_virtual" value="<?= $arrayAsignacionDocente->getLinkClaseVirtual() ?>" required placeholder="Enlace Clases Virtuales">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="intensidad_horaria">Intensidad Horaria</label>
                    <input type="number" name="intensidad_horaria" id="intensidad_horaria" value="<?= $arrayAsignacionDocente->getIntensidadHoraria() ?>" required placeholder="Intensidad Horaria">
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_grado">Grados</label>
                        <select class="as-form-select" name="id_grado" id="id_grado" required>
                            <?php
                            echo $selectMenuGrado;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_asignatura">Asignaturas</label>
                        <select class="as-form-select" name="id_asignatura" id="id_asignatura" required>
                            <?php
                            echo $selectMenuAsignatura;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $arrayAsignacionDocente->getId() ?>">
        <input type="hidden" name="id_usuario_docente" value="<?= $arrayAsignacionDocente->getIdUsuarioDocente() ?>">
        <input type="hidden" name="id_anio_escolar" value="<?= $arrayAsignacionDocente->getIdAnioEscolar() ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>