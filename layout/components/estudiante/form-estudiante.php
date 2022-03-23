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
$array = new Usuario(null, null);
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Usuario('id', $_REQUEST['id']);
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
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/estudiante/form-estudiante-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Estudiantes</h2>
            <div class="as-form-fields">
                <div class="as-form-input">
                    <label class="hide-label" for="identificacion">Identificación</label>
                    <input type="number" name="identificacion" id="identificacion" value="<?= $array->getIdentificacion() ?>" required placeholder="Identificación">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="nombres">Nombres</label>
                    <input type="text" name="nombres" id="nombres" value="<?= $array->getNombres() ?>" required placeholder="Nombres">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?= $array->getApellidos() ?>" required placeholder="Apellidos">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="telefono">Teléfono</label>
                    <input type="number" name="telefono" id="telefono" value="<?= $array->getTelefono() ?>" required placeholder="# telefónico">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="<?= $array->getEmail() ?>" required placeholder="Correo electrónico">
                </div>

                <div class="as-form-input">
                    <label class="hide-label" for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" value="<?= $array->getDireccion() ?>" required placeholder="Dirección">
                </div>

                <!-- <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_grado">Grados</label>
                        <select class="as-form-select" name="id_grado" id="id_grado">
                            <?php
                            echo $selectMenuGrado;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="id_grupo">Grupo</label>
                        <select class="as-form-select" name="id_grupo" id="id_grupo"></select>
                    </div>
                </div> -->

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

                <div class="as-form-fields">
                    <div class="as-form-input">
                        <label class="hide-label" for="estado">Estado</label>
                        <select class="as-form-select" name="estado" id="estado" required>
                            <?php
                            for ($i = 1; $i < 3; $i++) {
                                $selected = $array->getEstado() == $i ? 'selected' : '';
                                $selectMenu .= '<option value="' . $i . '" ' . $selected . ' >' . Generalidades::getEstadoUsuario($i) . ' </option>';
                            }
                            echo $selectMenu;
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
        <input type="hidden" name="id" value="<?= $array->getId() ?>">
        <input type="hidden" name="accion" value="<?php echo $titulo; ?>">
        <!-- <input type="hidden" name="id_anio_escolar" value="<?php echo $$arrayAnioEscolar->getId(); ?>"> -->
    </form>
</div>

<script language="javascript">
    /* $(document).ready(function() {
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
    }); */
</script>