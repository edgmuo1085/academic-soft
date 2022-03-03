<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$anioList = AnioEscolar::getListaEnObjetos(null, null);

foreach ($anioList as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getInicioAnio() }</td>";
    $lista .= "<td>{$item->getFinAnio() }</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/form-anio.php&accion=Modificar&id={$item->getId()}'><i class='fas fa-edit'></i></a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'><i class='fas fa-trash'></i></span>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">INFORMACION DEL AÑO ESCOLAR</h3>
    </div>
    <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/form-anio.php">Agregar año escolar</a>
    </div>
    <div>
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fin</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/form-anio-action.php&accion=Eliminar&id=" + id;
    }
</script>