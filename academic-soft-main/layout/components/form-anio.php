<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
$nameAnio = '';
$idAnio = null;
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $array = new AnioEscolar('id', $_REQUEST['id']);
    $anio = AnioEscolar::getListaEnObjetos("id={$array->getId()}", null)[0];
    $nameAnio = $array->getInicioAnio();
    $nameAnio = $array->getFinAnio();
    $idAnio = $array->getId();
}
?>

<div class="as-form-button-back">
    <a href="principal.php?CONTENIDO=layout/components/lista-anio.php" class="as-btn-back">
        Regresar
    </a>
</div>
<h3><?php strtoupper($titulo) ?> AÑO ESCOLAR</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/form-anio-action.php">
    <table>
        <tr>
            <th>Inicio</th>
            <td><input type="datetime-local" name="fechahora" size="30" maxlength="30" value="<?php echo $nameAnio; ?>" required></td>
             <th>Fin</th>
            <td><input type="datetime-local" name="fechahora" size="30" maxlength="30" value="<?php echo $nameAnio; ?>" required></td>

        </tr>
    </table>
    <input type="submit" name="accion" value="<?= $titulo ?>">
    <input type="hidden" name="id" value="<?php echo $idAnio; ?>">
</form>