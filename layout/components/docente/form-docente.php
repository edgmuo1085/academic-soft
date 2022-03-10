<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$array = new Usuario(null, null);
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Usuario('id', $_REQUEST['id']);
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/docente/lista-docente.php" class="as-btn-back">
        Regresar
    </a>
</div>

<div class="as-form-content">
    <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/docente/form-docente-action.php" autocomplete="off">
        <div class="as-form-margin">
            <h2>Docentes</h2>
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
                        <select class="as-form-select" name="estado" id="estado">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
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
        <input type="hidden" name="accion" value="<?php echo $titulo ?>">
    </form>
</div>