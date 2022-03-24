<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$selected = '';
$selectMenu = '';
$selectMenuGrado = '';
$selectMenuGrupo = '';
$arrayAnioEscolar = AnioEscolar::getListaEnObjetos('estado=1', null)[0];
$arrayGrado = Grado::getListaEnObjetos(null, 'id');
$arrayUsuario = new Usuario(null, null);
$arrayGrupoEstudiante = new GrupoEstudiante(null, null);

if (isset($_REQUEST['id'])) {
    $arrayUsuario = new Usuario('id', $_REQUEST['id']);
}

if (isset($_REQUEST['id_grupo_estudiante'])) {
    $titulo = 'Modificar';
    $arrayUsuario = new GrupoEstudiante('grupo_estudiante.id', $_REQUEST['id_grupo_estudiante']);
}

foreach ($arrayGrado as $paramG) {
    $selectMenuGrado .= '<option value="' . $paramG->getId() . '">' . $paramG->getNombreGrado() . '</option>';
}

?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/estudiante/lista-estudiante.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/estudiante/form-estudiante-grupo-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Estudiantes</h2>
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

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="label" for="id_grado">Grados</label>
                        <select class="as-form-select" name="id_grado" id="id_grado">
                            <option></option>
                            <?php
                            echo $selectMenuGrado;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="label" for="id_grupo">Grupo</label>
                        <select class="as-form-select" name="id_grupo" id="id_grupo"></select>
                    </div>
                </div>

                <?php
                if ($titulo == 'Modificar') {
                ?>
                    <div class="as-form-input">
                        <label class="hide-label" for="pass">Contraseña</label>
                        <input type="text" name="pass" id="pass" placeholder="Actualizar contraseña">
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="as-form-button">
                <button class="as-color-btn-green" type="submit">
                    <?php echo $titulo; ?>
                </button>
            </div>
        </div>
        <input type="hidden" name="id_usuario_estudiante" value="<?= $arrayUsuario->getId() ?>">
        <input type="hidden" name="accion" value="<?= $titulo ?>">
        <input type="hidden" name="id_anio_escolar" value="<?= $arrayAnioEscolar->getId() ?>">
    </form>
</div>

<script language="javascript">
    $(document).ready(function() {
        $("#id_grado").on('change', function() {
            $("#id_grado option:selected").each(function() {
                id = $(this).val();
                $.post("layout/components/estudiante/lista-combo.php", {
                    id: id
                }, function(data) {
                    $("#id_grupo").html(data);
                });
            });
        });
    });
</script>