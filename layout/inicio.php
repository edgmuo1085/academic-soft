<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$institution = InstitucionEducativa::getListaEnObjetos('id=1', null)[0];
$anioEscolar = AnioEscolar::getListaEnObjetos('estado=1', null)[0];
$USUARIO = unserialize($_SESSION['usuario']);
?>

<div class="as-layout-institucion">
    <div class="as-card-institucion">
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Nombres</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getNombre() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Dirección</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getDireccion() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Correo electrónico</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getEmail() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Teléfono</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getTelefono() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Directora</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getNombreDirectora() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Página Web</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $institution->getPaginaWeb() ?></p>
            </div>
        </div>
        <div class="as-institution">
            <div class="as-institution-title">
                <h4>Año Escolar</h4>
            </div>
            <div class="as-institution-description">
                <p><?= $anioEscolar->__toString() ?></p>
            </div>
        </div>
    </div>

    <?php
    $editar = $USUARIO->getRolId();
    if ($editar == 1 || $editar == 6) {
    ?>
        <div class="as-form-button">
            <a href="principal.php?CONTENIDO=layout/components/institucion/form-institution.php&id=<?= $institution->getId(); ?>" class="as-color-btn-green">
                Editar información
            </a>
        </div>
    <?php
    }
    ?>
</div>