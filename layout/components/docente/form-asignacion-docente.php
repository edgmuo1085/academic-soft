<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$selectMenuAsignatura = '';
$selectMenuGrado = '';
$arrayAnioEscolar = AnioEscolar::getListaEnObjetos('estado=1', null)[0];
$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');
$arrayGrado = Grado::getListaEnObjetos(null, 'nombre_grado');

if (isset($_REQUEST['id'])) {
    $arrayUsuario = new Usuario('id', $_REQUEST['id']);
}

foreach ($arrayAsignatura as $paramA) {
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '">' . $paramA->getNombreAsignatura() . '</option>';
}
foreach ($arrayGrado as $paramG) {
    $selectMenuGrado .= '<option value="' . $paramG->getId() . '">' . $paramG->getNombreGrado() . '</option>';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/docente/lista-docente.php" class="as-btn-back">
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
                    <input type="text" name="link_clase_virtual" id="link_clase_virtual" required placeholder="Enlace Clases Virtuales">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="intensidad_horaria">Intensidad Horaria</label>
                    <input type="number" name="intensidad_horaria" id="intensidad_horaria" required placeholder="Intensidad Horaria">
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_grado">Grados</label>
                        <select class="as-form-select" name="id_grado" id="id_grado">
                            <option>Grados...</option>
                            <?php
                            echo $selectMenuGrado;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_asignatura">Asignaturas</label>
                        <select class="as-form-select" name="id_asignatura" id="id_asignatura">
                            <option>Asignaturas...</option>
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
        <input type="hidden" name="id" value="<?= $arrayUsuario->getId() ?>">
        <input type="hidden" name="id_usuario_docente" value="<?= $_REQUEST['id'] ?>">
        <input type="hidden" name="id_anio_escolar" value="<?= $arrayAnioEscolar->getId() ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>