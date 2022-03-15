<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$grupoList = Grupo::getListaEnObjetos(null, 'id_grado');

foreach ($grupoList as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getNombreGrupo()}</td>";
    $lista .= "<td>{$item->getNombreGrado()}</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/grupo/form-grupo.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1) . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2) . "</span>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTADO DE GRUPOS</h3>
    </div>
    <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/grupo/form-grupo.php">Agregar grupo</a>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Grupo</th>
                    <th scope="col">Nombre Grado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php print_r($lista); ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id) {
        var respuesta = confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/grupo/form-grupo-action.php&accion=Eliminar&id=" + id;
    }
</script>