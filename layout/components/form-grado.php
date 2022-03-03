<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameGrado = '';
$idGrado = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Grado('id', $_REQUEST['id']);
    $grado = Grado::getListaEnObjetos("id={$array->getId()}", null)[0];
    $nameGrado = $array->getNombreGrado();
    $idGrado = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-grado.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?= strtoupper($titulo) ?> GRADOS</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-grado-action.php" autocomplete="off">
    <table>
        <tr>
            <th>Nombre Del Grado</th>
            <td><input type="text" name="nombre_grado" id="nombre" value="<?php echo $nameGrado; ?>" required></td>
        </tr>
    </table>
    <p>
        <input type="submit" name="accion" value="<?= $titulo ?>">
        <input type="hidden" name="id" value="<?php echo $idGrado; ?>">
</form>