<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$listaInasistencias = Inasistencias::getListaEnObjetos(null, null);

foreach ($listaInasistencias as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>{$item->getIdentificacion()}</td>";
    $lista .= "<td>{$item->getNombres()}</td>";
    $lista .= "<td>{$item->getApellidos()}</td>";
    $lista .= "<td>{$item->getCantidad ()}</td>";
    $lista .= "<td>{$item->getJustificacion()}</td>";
    $lista .= "<td>{$item->getFecha()}</td>";
    $lista .= "<td>{$item->getIdUsuarioEstudiante ()}</td>";
    $lista .= "<td>{$item->getIdAsignatura ()}</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias.php&accion=Modificar&id={$item->getId()}'><i class='fas fa-edit'></i></a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'><i class='fas fa-trash'></i></span>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">GESTIONAR INASISTENCIAS</h3>
    </div>
    <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/estudiante/form-estudiante.php">Agregar inasistencia</a>
    </div>
    <div>
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Justificacion</th>
                    <th scope="col">Fecha</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-action.php&accion=Eliminar&id=" + id;
    }
</script>