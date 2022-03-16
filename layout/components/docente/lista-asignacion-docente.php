<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$listaAsignacionesDocente = AsignacionDocente::getListaEnObjetos('', 'id_usuario_docente, id_grado, id_asignatura');

foreach ($listaAsignacionesDocente as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td><a href='principal.php?CONTENIDO=layout/components/docente/form-docente.php&accion=Modificar&id={$item->getIdUsuarioDocente()}'>{$item->getNombreDocente()}</a></td>";
    $lista .= "<td>{$item->getAnioEscolar()}</td>";
    $lista .= "<td>{$item->getNombreGrado()}</td>";
    $lista .= "<td>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td> <a href='{$item->getLinkClaseVirtual()}' target='blank'> Enlace </a></td>";
    $lista .= "<td>{$item->getIntensidadHoraria()}</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1) . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2) . "</span>";
    $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente.php&accion=crear&id={$item->getIdUsuarioDocente()}'>" . Generalidades::getTooltip(3) . "</a>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">LISTA DE ASIGNACIONES</h3>
    </div>
    <!-- <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/docente/form-docente.php">Agregar docente</a>
    </div> -->
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Año escolar</th>
                    <th scope="col">Grado</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Clase virtual</th>
                    <th scope="col">Intensidad horaria</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php print_r($lista); ?>
            </tbody>
        </table>

        <!-- <div class="as-tooltip">Hover over me <span class="as-tooltiptext">Tooltip text</span> </div> -->
    </div>
</div>

<script type="text/javascript">
    function eliminar(id) {
        var respuesta = confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/docente/form-asignacion-docente-action.php&accion=Eliminar&id=" + id;
    }
</script>