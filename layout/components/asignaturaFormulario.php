<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameCourse = '';
$idCouse = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Asignatura('id', $_REQUEST['id']);
    $asignatura = Asignatura::getListaEnObjetos("id={$array->getId()}", null)[0];
    $nameCourse = $array->getNombreAsignatura();
    $idCouse = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/asignatura.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?php strtoupper($titulo) ?> ASIGNATURA</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/asignaturaActualizar.php">
    <table>
        <tr>
            <th>Nombre Asignatura</th>
            <td><input type="text" name="nombre_asignatura" size="30" maxlength="30" value="<?php echo $nameCourse; ?>" required></td>
        </tr>
    </table>
    <input type="submit" name="accion" value="<?= $titulo ?>">
    <input type="hidden" name="id" value="<?php echo $idCouse; ?>">
</form>