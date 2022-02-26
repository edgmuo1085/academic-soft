<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo='Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'modificar';
    $array = new Grado('id', $_REQUEST['id']);
    $grado = Grado::getListaEnObjetos("id={$array->getId()}", null)[0];
} else {
    echo 'nbada';
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/inicio.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?= strtoupper($titulo)?> GRADOS</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-update-institution-action.php" autocomplete="off">
    <table>
        <tr>
            <th>Nombre Del Grado</th><td><input type="text" name="nombre_grado" id="nombre" value="<?= $array->getNombreGrado() ?>" required></td>
        </tr>
    </table><p>
    <input type="submit" name="accion" value="<?=$titulo?>">
</form>

       