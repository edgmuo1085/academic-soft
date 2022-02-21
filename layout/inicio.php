<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$institution = InstitucionEducativa::getListaEnObjetos(null, null)[0];
?>

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
        <h4>Email</h4>
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