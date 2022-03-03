<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameGrupo = '';
$idGrupo = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new Grupo('id', $_REQUEST['id']);
    $grupo = Grupo::getListaEnObjetos("id={$array->getId()}", null)[0];
    $nameGrupo = $array->getNombreGrupo();
    $idGrupo = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-grupo.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?= strtoupper($titulo) ?> GRUPOS</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-grupo-action.php" autocomplete="off">
    <table>
        <tr>
            <th>Nombre Del Grupo</th>
            <td><input type="text" name="nombre_grupo" id="nombre" value="<?php echo $nameGrupo; ?>" required></td>
        </tr>
    </table>
    <p>
        <input type="submit" name="accion" value="<?= $titulo ?>">
        <input type="hidden" name="id" value="<?php echo $idGrupo; ?>">
</form>