<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location:../../index.php?mensaje=Acceso no autorizado');
$lista = '';
$count = 1;
$selectMenuAsignatura = '';
$consulta = '';
$bandera = false;
$txtResumido = 'as-texto-resumido';
$txtCompleto = 'as-texto-completo';
$arrayAsignatura = Asignatura::getListaEnObjetos(null, 'nombre_asignatura');
$listaInasistencias = Inasistencias::getListaEnObjetos(null, 'i.id_asignatura, i.fecha_creacion DESC');

if (!empty($_REQUEST['identificacion']) || !empty($_REQUEST['nombres']) || !empty($_REQUEST['id_asignatura']) || !empty($_REQUEST['fecha_creacion'])) {
    $listaGruposPorEstudiante = array();
    if (!empty($_REQUEST['identificacion'])) {
        $consulta .= " u.identificacion LIKE '%{$_REQUEST['identificacion']}%'";
        $bandera = true;
    }

    if (!empty($_REQUEST['nombres'])) {
        $consulta .=  $bandera ? " AND u.nombres LIKE '%{$_REQUEST['nombres']}%'" : " u.nombres LIKE '%{$_REQUEST['nombres']}%'";
        $bandera = true;
    }

    if (!empty($_REQUEST['id_asignatura'])) {
        $consulta .=  $bandera ? " AND i.id_asignatura = {$_REQUEST['id_asignatura']}" : " i.id_asignatura = {$_REQUEST['id_asignatura']}";
        $bandera = true;
    }

    if (!empty($_REQUEST['fecha_creacion'])) {
        $consulta .=  $bandera ? " AND i.fecha_creacion LIKE '%{$_REQUEST['fecha_creacion']}%'" : " i.fecha_creacion LIKE '%{$_REQUEST['fecha_creacion']}%'";
        $bandera = true;
    }
    
    if ($bandera) {
        $listaInasistencias = Inasistencias::getListaEnObjetos("{$consulta}", "i.id_asignatura, i.fecha_creacion");
    }
}

foreach ($listaInasistencias as $item) {
    $lista .= "<tr>";
    $lista .= '<th scope="row">' . $count . '</th>';
    $lista .= "<td class='as-text-uppercase as-text-left'><a href='principal.php?CONTENIDO=layout/components/estudiante/form-estudiante.php&accion=Modificar&id={$item->getIdUsuarioEstudiante()}'>{$item->getNombreEstudiante()}</a></td>";
    $lista .= "<td class='as-text-uppercase as-text-left'>{$item->getNombreAsignatura()}</td>";
    $lista .= "<td>" . Generalidades::convertDate($item->getFechaCreacion(), false) . "</td>";
    $lista .= "<td>{$item->getCantidad()}</td>";
    $lista .= "<td>";
    $lista .= "<div id='as-texto-resumido" . $count . "'>";
    $lista .= Generalidades::getReduceCharacters($item->getJustificacion()) . " ... <br>";
    $lista .= "<span class='as-leer-mas' onClick='leerMasHideShow(1, \"" . $txtResumido . $count . "\", \"" . $txtCompleto . $count . "\")'>Leer más</span>";
    $lista .= "</div>";
    $lista .= "<div id='as-texto-completo" . $count . "' class='as-block-hide'>";
    $lista .= $item->getJustificacion() . "<br>";
    $lista .= "<span class='as-leer-mas' onClick='leerMasHideShow(2, \"" . $txtResumido . $count . "\", \"" . $txtCompleto . $count . "\")'>Ocultar texto</span>";
    $lista .= "</div>";
    $lista .= "</td>";
    $lista .= "<td class='as-text-center'>";
    $lista .= "<a class='as-edit' href='principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-edit.php&accion=Modificar&id={$item->getId()}'>" . Generalidades::getTooltip(1, '') . "</a>";
    $lista .= "<span class='as-trash' onClick='eliminar({$item->getId()})'>" . Generalidades::getTooltip(2, '') . "</span>";
    $lista .= "<a class='as-add' href='principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-create.php&accion=crear&id={$item->getIdUsuarioEstudiante()}'>" . Generalidades::getTooltip(3, 'Registrar inasistencia') . "</a>";
    $lista .= "</td>";
    $lista .= "</tr>";
    $count++;
}

foreach ($arrayAsignatura as $paramA) {
    $selectMenuAsignatura .= '<option value="' . $paramA->getId() . '">' . $paramA->getNombreAsignatura() . '</option>';
}

?>

<div class="as-tab-content">
    <div class="as-tab-header" id="as-tab-header-click">
        <i class='fas fa-search'></i> Buscar estudiantes por filtros
    </div>
    <div class="as-tab-content-form">
        <div class="as-form-content">
            <form name="formulario" method="post" action="principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php" autocomplete="off">
                <div class="as-form-margin">
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="identificacion">Identificación</label>
                            <input type="number" name="identificacion" id="identificacion" placeholder="Identificación">
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" placeholder="Nombres">
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="label" for="id_asignatura">Asignaturas</label>
                            <select class="as-form-select" name="id_asignatura" id="id_asignatura">
                                <option value=""></option>
                                <?php
                                echo $selectMenuAsignatura;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="as-form-fields">
                        <div class="as-form-input">
                            <label class="hide-label" for="fecha_creacion">Fin</label>
                            <input type="text" name="fecha_creacion" id="fecha_creacion" placeholder="Fecha (aaaa-mm-dd)">
                        </div>
                    </div>
                    <div class="as-form-button">
                        <button class="as-color-btn-green" type="submit">
                            Buscar
                        </button>
                        <a class="as-color-btn-red" href="principal.php?CONTENIDO=layout/components/inasistencias/lista-inasistencias.php">
                            Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="as-layout-table">
    <div>
        <h3 class="as-title-table">GESTIONAR INASISTENCIAS</h3>
    </div>
    <div class="as-table-responsive">
        <table class="as-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Justificación</th>
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
    const eliminar = (id) => {
        let respuesta = confirm("Esta seguro de eliminar este registro?");
        if (respuesta) location = "principal.php?CONTENIDO=layout/components/inasistencias/form-inasistencias-action.php&accion=Eliminar&id=" + id;
    }

    const leerMasHideShow = (parametro, idResumido, idCompleto) => {
        let elementResumido = document.getElementById(idResumido);
        let elementCompleto = document.getElementById(idCompleto);
        if (parametro == 1) {
            elementResumido.classList.add("as-block-hide");
            elementCompleto.classList.remove("as-block-hide");
        } else {
            elementResumido.classList.remove("as-block-hide");
            elementCompleto.classList.add("as-block-hide");
        }
    }

    const clickTabShowHidden = document.querySelector("#as-tab-header-click");
    clickTabShowHidden.addEventListener("click", () => {
        const contentTab = clickTabShowHidden.nextElementSibling;

        if (contentTab.classList.contains("as-tab-content-form-show")) {
            contentTab.classList.remove("as-tab-content-form-show");
        } else {
            contentTab.classList.add("as-tab-content-form-show");
        }
    });
</script>