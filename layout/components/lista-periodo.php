<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$periodoList = PeriodoAcademico::getListaEnObjetos(null, null);

foreach ($periodoList as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td>" . Fecha::convertDate($item->getInicioPeriodo(), false) . "</td>";
    $lista .= "<td>" . Fecha::convertDate($item->getFinalizacionPeriodo(), false) . "</td>";
    $lista .= "<td>" . $item->getAnioEscolar() . "</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/form-periodo.php&accion=Modificar&id={$item->getId()}'><i class='fas fa-edit'></i></a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'><i class='fas fa-trash'></i></span>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

?>
<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">PERIODOS ACADEMICOS</h3>
        <h4 class="as-title-table">Año escolar comprendido entre el 2022-02-05 23:59:59 y 2022-02-05 23:59:59</h4>
    </div>
    <div class="as-form-button-back">
        <a class="as-btn-back" href="principal.php?CONTENIDO=layout/components/form-periodo.php">Agregar Periodo</a>
    </div>
    <div>
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Inicio Periodo</th>
                    <th scope="col">Finalización Periodo</th>
                    <th scope="col">Año Escolar</th>
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
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/form-periodo-action.php&accion=Eliminar&id=" + id;
    }
</script>