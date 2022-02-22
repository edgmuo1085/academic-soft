<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$institution = InstitucionEducativa::getListaEnObjetos('id=1', null)[0];
?>

<div class="as-layout-institucion">
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

    <div class="as-form-button">
        <a href="principal.php?CONTENIDO=layout/components/form-update-institution.php&id=1" class="as-color-btn-green">
            Editar información
        </a>
    </div>
</div>