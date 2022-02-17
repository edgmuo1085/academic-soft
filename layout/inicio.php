<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$institucion = InstitucionEducativa::getListaEnObjetos(null, null)[0];
?>

<div class="as-institucion">
    <div class="as-institucion-title">
        <p>Nombres</p>
    </div>
    <div class="as-institucion-description">
        <p><?= $institucion->getNombre() ?></p>
    </div>
</div>
<div class="as-institucion">
    <div class="as-institucion-title">
        <p>Dirección</p>
    </div>
    <div class="as-institucion-description">
        <p><?= $institucion->getDireccion() ?></p>
    </div>
</div>
<div class="as-institucion">
    <div class="as-institucion-title">
        <p>Email</p>
    </div>
    <div class="as-institucion-description">
        <p><?= $institucion->getEmail() ?></p>
    </div>
</div>
<div class="as-institucion">
    <div class="as-institucion-title">
        <p>Directora</p>
    </div>
    <div class="as-institucion-description">
        <p><?= $institucion->getNombreDirectora() ?></p>
    </div>
</div>
<div class="as-institucion">
    <div class="as-institucion-title">
        <p>Pagina paginaWeb</p>
    </div>
    <div class="as-institucion-description">
        <p><?= $institucion->getPaginaWeb() ?></p>
    </div>
</div>